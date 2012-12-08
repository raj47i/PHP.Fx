<?php
namespace System;

class Application extends \aSingleton implements \iSingleton{
	static
		private $self				= NULL;
	static
		public function Get(){
			if(is_null(self::$self)){
				$class				= __CLASS__;
				self::$self			= new $class;
			}
			return self::$self;
		}

	private
		$__get						= array(),
		$__queue					= array(),
		$__response					= NULL
	;

	private function __construct(){
		#~ Complete Booting: Set Error Handler and Load Other Core modules 
		##set_error_handler( '\error_handler' );
		##set_exception_handler( '\exception_handler' );
		#~ Enforce E_ALL, but allow users to set levels not part of E_ALL.
		error_reporting(E_ALL | error_reporting());
		
		if (!isset($_SERVER['HTTP_REFERER'])) {
			$_SERVER['HTTP_REFERER'] = '';
		}
		if (!isset($_SERVER['SERVER_PROTOCOL']) || ($_SERVER['SERVER_PROTOCOL'] != 'HTTP/1.0' && $_SERVER['SERVER_PROTOCOL'] != 'HTTP/1.1')) {
			$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.0';
		}
		if (isset($_SERVER['HTTP_HOST'])){
			$_SERVER['HTTP_HOST']	= strtolower($_SERVER['HTTP_HOST']);
		    #~ As HTTP_HOST is user input, ensure it only contains characters allowed in hostnames. See RFC 952 (and RFC 2181).
			if(!preg_match('/^\[?(?:[a-z0-9-:\]_]+\.?)+$/', $_SERVER['HTTP_HOST'])){
				#~ HTTP_HOST is invalid, e.g. if containing slashes it may be an attack.
				header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
				exit;
			}
		}else{
			#~ Some pre-HTTP/1.1 clients will not send a Host header. Ensure the key is defined for E_ALL compliance.
			$_SERVER['HTTP_HOST']	= '';
		}
		#~ Initialize Current Request Path
		$this->RequestPath;
		
		#~ Prevent PHP from generating HTML error messages.
		ini_set('html_errors', 0);
		#~ Don't escape quotes when reading files from the database, disk, etc.
		ini_set('magic_quotes_runtime', '0');
		#~ Use session cookies, not transparent sessions that puts the session id in the query string.
		ini_set('session.use_cookies', '1');
		ini_set('session.use_only_cookies', '1');
		ini_set('session.use_trans_sid', '0');
		#~ Don't send HTTP headers using PHP's session handler.
		ini_set('session.cache_limiter', 'none');
		#~ Use httponly session cookies.
		ini_set('session.cookie_httponly', '1');

		#~ Start a Timer
		\Clock::Get()->Start('Global');

		#~ Load global settings.
		require_once( DocRoot . '/sites/sites.php' );
		#~ Decide Site Directory
		define( 'ConfPath',  $this->ConfPath);
		#~ Load the settings for active domain
		require_once( DocRoot . $this->ConfPath . '/settings.php' );

		global $settings;
		#~ Initialize the Session
		if (count(explode('.', $settings['cookie_domain'])) > 2 && !is_numeric(str_replace('.', '', $settings['cookie_domain']))) {
			ini_set('session.cookie_domain', $settings['cookie_domain']);
		}
		if ($this->HTTPS) {
			ini_set('session.cookie_secure', TRUE);
			session_name('SSES' . md5($settings['cookie_domain']));
		}else{
			session_name('SESS' . md5($settings['cookie_domain']));
		}
	}
	
	public function &Modules(){
		static
			$modules 							= array(),
			$load								= true
		;
		#~ user, 
		if( $load ){
			echo 1;
			$load								= false;
			$rs									= db_get()->Execute( 'system_application_queue', $this->Path );
			while( $r = $rs->Fetch() ){
				$this->__queue[$r['Event']][]	= $r['Module'];
				$modules[$r['Module']]		= $r['Namespace'];
			}
		}
		return $modules;
	}
	
	#~Find the appropriate configuration directory in Drupal 6 style
	private function _initConf(){
		#~ Load Application wide settings
		@include_once( DocRoot . '/sites/settings.php' );

		#~ Load Site specific settings
		$uri = explode('/', $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['SCRIPT_FILENAME']);
		$server = explode('.', implode('.', array_reverse(explode(':', rtrim($_SERVER['HTTP_HOST'], '.')))));
		for ($i = count($uri) - 1; $i > 0; $i--) {
			for ($j = count($server); $j > 0; $j--) {
				$dir = implode('.', array_slice($server, -$j)) . implode('.', array_slice($uri, 0, $i));
				if (file_exists( DocRoot . "/sites/{$dir}/settings.php" )) {
					return $dir;
				}
			}
		}
		#~ If no site loaded, Load default Site
		return 'default';
	}
	
	public function IsDenied($type, $mask){
		return db_get()->Call( 'system_application_isdenied', $type, $mask );
	}
	
	public function Invoke($event){
		$results				= array();
		$mods					= $this->Modules();
		foreach( $mods as $name => &$obj ){
			if(is_string($obj)){
				$modules[$name]	= $obj = new $obj;
			}
			if($obj instanceOf Module){
				$results[$name]	= $obj->Invoke( $event, $args );
			}
		}
		return $results;
	}

	public function __get($name){
		if(isset($this->__get[$name])){
			return $this->__get[$name];
		}
		switch($name){
			case 'IsMultiLingual':
				$value				= false;
				##if (!isset($multilingual)) {
   				##	 $value = variable_get('language_count', 1) > 1;
  				##}
			break;
			case 'IsCLI':
				$value				= (!isset($_SERVER['SERVER_SOFTWARE']) && (php_sapi_name() == 'cli' || (is_numeric($_SERVER['argc']) && $_SERVER['argc'] > 0)));
			break;
			case 'RequestPath':
				$value				= isset($_GET['q']) ? $_GET['q'] : '' ;
			break;
			case 'ConfPath':
				global $sites;
				$uri				= explode('/', $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['SCRIPT_FILENAME']);
				$server				= explode('.', implode('.', array_reverse(explode(':', rtrim($_SERVER['HTTP_HOST'], '.')))));
				$value				= '';
				for ($i = count($uri) - 1; $i > 0; $i--) {
					for ($j = count($server); $j > 0; $j--) {
						$dir = implode('.', array_slice($server, -$j)) . implode('.', array_slice($uri, 0, $i));
						if( isset($sites[$dir]) && file_exists( DocRoot . '/sites/' . $sites[$dir] ) ){
							$value	= $sites[$dir];
							break 2;
						}
						if( file_exists( DocRoot . '/sites/' . $dir ) ){
							$value	= $dir;
							break 2;
						}
					}
				}
				$value				= empty($value) ? '/sites/default' : '/sites/' . $value;
			break;
			case 'DataPath':
				echo 'due';
			break;
			case 'HTTPS':
			    $parts				= parse_url(BaseURL);
				$value				= ('https' == $parts['scheme']);
				global $settings;
				if(empty($settings['cookie_domain'])){
					$settings['cookie_domain'] = $_SERVER['HTTP_HOST'];
				}
			break;
			
			
						
			case 'RemoteIP'	:
				$value				= $_SERVER['REMOTE_ADDR'];
				if( config_get('system.reverse_proxy', false) && array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER ) ){
					#~ If an array of known reverse proxy IPs is provided, then trust the XFF header if request really comes from one of them.
					$reverse_proxy_addresses = conig_get('system.reverse_proxy_addresses', array());
					if( !empty($reverse_proxy_addresses) && in_array($value, $reverse_proxy_addresses, TRUE) ){
						#~ If there are several arguments, we need to check the most recently added one, i.e. the last one.
						$value		= array_pop( explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
					}
				}
			break;
			case 'User'		:
				$value				= new \System\User;
			break;
			case 'Language'	:
				$value				= (object) array('language' => 'en', 'name' => 'English', 'native' => 'English', 'direction' => 0, 'enabled' => 1, 'plurals' => 0, 'formula' => '', 'domain' => '', 'prefix' => '', 'weight' => 0, 'javascript' => '');
			break;
			case 'Request'	:
				$value				= empty( $_GET['q'] ) ? config_get( 'system.page-front', 'index' ) : trim($_GET['q'], '/');
			break;
			case 'Path'		:
				$value				= $this->LookUp( 'source', $this->Request );
			break;
			case 'Router'	:
				$value				= $this->InitRouter( $this->Path );
			break;
			case 'Args'		:
				$value				= explode( '/', $this->Path );
				$value[0]			= strtolower( str_replace( '-', '_', $value[0] ) );
			break;
			case 'Response':
			default:
		}
		$this->__get[$name]			= $value;
		unset($value);
		return $this->__get[$name];
	}
	
	public function IsOffline(){
		return config_get('system.offline', false);
	}
	
	public function Boot(){

		#~ Initialize a responce object!
		$this->__response			= new \System\Theme( 'system', 'page.tpl' );
		global
			$settings,
			$user
		;
		##Bootstrap Early Cache

		#~ Initialize Database
		db_get( 'default' )->Connect();

		## Variable Initialize

		#~ Initialize Session Handlers, User(if there is a session);
		\System\Session::Get()->Init();
		
		#~ Invoke Modules: Boot
		## Invoke module hooks!!
		##if (!drupal_page_get_cache(TRUE) && drupal_page_is_cacheable()) {
		##	header('X-Drupal-Cache: MISS');
		##}
		
		## Locks
		if( !$this->IsCLI ){
			## ob_start();
			## Header System?
			#~ Send default page headers
			header( 'Expires: Sun, 19 Nov 1978 05:00:00 GMT' );
			header( 'Last-Modified: ' . gmdate(DATE_RFC1123, $_SERVER['REQUEST_TIME']) );
			header( 'Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0' );
			header( 'ETag: ' . $_SERVER['REQUEST_TIME'] );
		}
		
		#~ Language (Unicode) initialize
		/*if( $this->IsMultiLingual ){
			## Langu Multi Lingual
				##include_once DRUPAL_ROOT . '/includes/language.inc';
			    ##foreach ($types as $type) {
			    ##  $GLOBALS[$type] = language_initialize($type);
			    ##}
			    // Allow modules to react on language system initialization in multilingual
			    // environments.
			    ##module_invoke_all('language_init', $types);
		}else{
			$default = language_default();
			foreach ($types as $type) {
				$GLOBALS[$type] = $default;
			}
		}
		/*
		require_once DRUPAL_ROOT . '/' . variable_get('path_inc', 'includes/path.inc');
  require_once DRUPAL_ROOT . '/includes/theme.inc';
  require_once DRUPAL_ROOT . '/includes/pager.inc';
  require_once DRUPAL_ROOT . '/' . variable_get('menu_inc', '/includes/menu.inc');
  require_once DRUPAL_ROOT . '/includes/tablesort.inc';
  require_once DRUPAL_ROOT . '/includes/file.inc';
  require_once DRUPAL_ROOT . '/includes/unicode.inc';
  require_once DRUPAL_ROOT . '/includes/image.inc';
  require_once DRUPAL_ROOT . '/includes/form.inc';
  require_once DRUPAL_ROOT . '/includes/mail.inc';
  require_once DRUPAL_ROOT . '/includes/actions.inc';
  require_once DRUPAL_ROOT . '/includes/ajax.inc';
  require_once DRUPAL_ROOT . '/includes/token.inc';
  require_once DRUPAL_ROOT . '/includes/errors.inc';

  // Detect string handling method
  unicode_check();
  // Undo magic quotes
  fix_gpc_magic();
  // Load all enabled modules
  module_load_all();
  // Make sure all stream wrappers are registered.
  file_get_stream_wrappers();
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'simpletest') !== FALSE) {
    // Valid SimpleTest user-agent, log fatal errors to test specific file
    // directory. The user-agent is validated in DRUPAL_BOOTSTRAP_DATABASE
    // phase so as long as it is a SimpleTest user-agent it is valid.
    ini_set('log_errors', 1);
    ini_set('error_log', file_directory_path() . '/error.log');
  }
  // Initialize $_GET['q'] prior to invoking hook_init().
  drupal_path_initialize();
  // Set a custom theme for the current page, if there is one. We need to run
  // this before invoking hook_init(), since any modules which initialize the
  // theme system will prevent a custom theme from being correctly set later.
  menu_set_custom_theme();
  // Let all modules take action before menu system handles the request
  // We do not want this while running update.php.
  if (!defined('MAINTENANCE_MODE') || MAINTENANCE_MODE != 'update') {
    module_invoke_all('init');
  }
		*/
	}

	public function TurnOff(){
		$r							= $this->Response;
		if(is_string($r)){
			echo $r;
			exit;
		}
		$tpl						= new \System\Theme( 'system', 'page.tpl' );
		if( is_object( $r ) ){
			$tpl->Assign('Content', $r->Fetch());
		}
		
		$system						= array();
		#~ System.Status
		$op							= new \System\Theme( 'system', 'status_messages.tpl' );
		$op->Assign( 'Status', message_get() );
		$system['Status']			= $op->Fetch();
		unset($op);
		#~ System.User
		
		#~ Negotiate for Regions & Blocks
		
		#~ Assign System Outputs
		$tpl->Assign( 'System', $system );
		return $tpl;
	}

	private function InitRouter($path = ''){
		$db								= db_get();
		$router							= utils_unpack( $db->Call( 'system_application_loadrouter', $path ), 'access_args', 'callback_args' );
		if(empty($router)){
			$router						= utils_unpack( $db->Call( 'system_application_loadrouter', config_get( 'system.page-404', 'index' ) ), 'access_args', 'callback_args' );
			if(empty($router)){
				return array(
					'callback_class'	=> '\\System\\Defaults',
					'callback_method'	=> 'GetPage',
					'callback_args'		=> array( 404 )
				);
			}
			return $router;
		}
		if(empty($router['access_class'])){
			return $router;
		}
		$accessObject				= new $router['access_class'];
		if($modObject->$router['access_method']($router['access_args'], $this->Args)){
			return $router;
		}
		return array(
			'callback_class'	=> '\\System\\Defaults',
			'callback_method'	=> 'GetPage',
			'callback_args'		=> array( 401 )
		);
	}

	public function LookUp($action, $path = ''){
		return $path;
		#TODO Complete the language and complete the algorithm!
		if (empty($path) || empty($count)) {
			return;
  		}elseif ('alias' == $action) {
		}elseif ('source' == $action) {	
		}
	}

	public function Execute(){
		$router						= $this->Router;
		$this->__get['Response']	= call_user_method_array( $router['callback_method'], new $router['callback_class'], array_merge( $router['callback_args'], $this->Args ) );
	}
}
?>