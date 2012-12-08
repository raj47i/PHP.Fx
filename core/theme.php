<?php
namespace System;

require_once( DocRoot . "/includes/smarty/Smarty.class.php" );
#~ Tested with Smarty @version 2.6.26

class Theme extends \Smarty{
	static
		private $theme			= NULL
	;
	static public function Init( $theme = NULL , $default = false){
		global
			$app,
			$settings
		;
		if($default){
			self::$theme		= isset( $settings['themes'][$theme] )
									? $theme
									: config_get( 'system.theme_default', 'default' )
								;
		}elseif( isset( $settings['themes'][$theme] ) ){
			self::$theme		= $theme;
		}
		return ( $theme == self::$theme );
	}

	private
		$_template,
		$_css,
		$_js
	;

	public function __construct($moduleDir, $template, $cache = 2){
		global $app;
		$theme					= self::$theme;
		$this->_css				= array();
		$this->_js				= array( '/includes/jquery/jquery.js' );

		#~ Setup Debug mode & Template Caching
		$this->debugging		= !Live;
		$this->caching			= Live ? $cache : false;

		#~ Set the tpl file to display
		$this->_template		= $template;

		#~ Set Theme directories
		$this->config_dir		= DocRoot . $app->ConfPath;
		$this->template_dir		= array(
									DocRoot . "/themes/{$theme}/templates/{$moduleDir}",
									DocRoot . "/modules/{$moduleDir}/templates"									
								);
		$this->plugins_dir[]	= DocRoot . "/themes/{$theme}/plugins";

		#~ Set Writable Theme directories / Create if necessory
		$this->compile_dir		= DocRoot . $app->ConfPath . "/tmp/{$theme}_c";
		$this->cache_dir		= DocRoot . $app->ConfPath . "/tmp/{$theme}_cache";
		if(!is_dir($this->compile_dir)){
			mkdir($this->compile_dir);
		}
		if(!is_dir($this->cache_dir)){
			mkdir($this->cache_dir);
		}
		
		#~ Every Assignments, if any.
		$this->assign( 'BaseURL', BaseURL );
		$this->assign( 'BasePath', BasePath );
		$this->assign( 'Theme', BasePath . '/themes/' . $theme );
	}

	#~ Include Stylesheets and Javascripts to current Template!
	public function AddRef($fileName, $type = 'js'){
		switch($type){
			case 'js':
				$this->js[$fileName]	= 9;
			break;
			case 'css':
				$this->css[$fileName]	= 9;
			break;
			default:
		}		
	}

	public function IsCached($cache_id = null, $compile_id = null){
		return parent::is_cached($this->_template, $cache_id, $compile_id);
	}

	public function ClearCacheAll($exp_time = null){
		return parent::clear_all_cache($exp_time);
	}

	public function ClearCache($cache_id = null, $compile_id = null, $exp_time = null){
		return parent::clear_cache($this->_template, $cache_id, $compile_id, $exp_time);
	}

	public function Display($cache_id = null, $compile_id = null){
		return parent::_fetch($this->_template, $cache_id, $compile_id, true);
	}

	public function Fetch( $cache_id = null, $compile_id = null ){
		return parent::_fetch($this->_template, $cache_id, $compile_id, false);
	}

	public function Assign($tpl_var, $value = null){
		return parent::assign($tpl_var, $value);
	}

	public function Append($tpl_var, $value=null, $merge=false){
		return parent::append($tpl_var, $value, $merge);
	}

	public function Clear($tpl_var = NULL){
		if( is_null($tpl_var) ){
			return parent::clear_all_assign();
		}
		return parent::clear_assign($tpl_var);
	}

	public function ClearCompiled( $compile_id = null, $exp_time = null ){
		return parent::clear_compiled_tpl($this->_template, $compile_id, $exp_time);
	}

	public function Exists($template = NULL){
		$p		= array(
					'resource_name' => empty($template)
										? $this->_template
										: $template,
					'quiet' => true,
					'get_source' => false
				);
		return $this->_fetch_resource_info( $p );
	}

	public function LoadConfig($file, $section = null, $scope = 'global'){
		return parent::config_load($file, $section, $scope);
	}

	public function ClearConfig($var = null){
		return parent::clear_config($var);
	}
}
?>