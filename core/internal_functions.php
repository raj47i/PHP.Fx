<?php

#~ Load Classes according to their namespace!
function __autoload($class){
	$file	= '/modules/' . strtolower(str_replace("\\", "/", $class)) . '.php';
	require_once(DocRoot . $file);
}

/**
 * Gets the last caller from a backtrace.
 *
 * @param $backtrace
 *   A standard PHP backtrace.
 * @return
 *   An associative array with keys 'file', 'line' and 'function'.
 */
function error_locate($backtrace){
	#~ Errors that occur inside PHP internal functions do not generate information about file and line. Ignore black listed functions.
	$blacklist					= array('debug', 'exception_handler', 'error_handler');
	while (($backtrace && !isset($backtrace[0]['line'])) || (isset($backtrace[1]['function']) && in_array($backtrace[1]['function'], $blacklist))) {
		array_shift($backtrace);
	}
	#~ The first trace is the call itself. It gives us the line and the file of the last call.
	$call						= $backtrace[0];
	#~ The second call give us the function where the call originated.
	if (isset($backtrace[1])){
		if (isset($backtrace[1]['class'])) {
			$call['function']	= $backtrace[1]['class'] . $backtrace[1]['type'] . $backtrace[1]['function'] . '()';
    	}else{
			$call['function']	= $backtrace[1]['function'] . '()';
    	}
  	}else{
		$call['function']		= 'main()';
	}
	return $call;
}

/**
 * Log a PHP error or exception, display an error page in fatal cases.
 *
 * @param $error
 *   An array with the following keys: %type, %message, %function, %file, %line.
 * @param $fatal
 *   TRUE if the error is fatal.
 */
function _error_log($error, $fatal = FALSE) {
print_r($error);
	return;
  // Initialize a maintenance theme if the boostrap was not complete.
  // Do it early because drupal_set_message() triggers a drupal_theme_initialize().
  if ($fatal && (drupal_get_bootstrap_phase() != DRUPAL_BOOTSTRAP_FULL)) {
    unset($GLOBALS['theme']);
    if (!defined('MAINTENANCE_MODE')) {
      define('MAINTENANCE_MODE', 'error');
    }
    drupal_maintenance_theme();
  }

  // When running inside the testing framework, we relay the errors
  // to the tested site by the way of HTTP headers.
  if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/^simpletest\d+;/", $_SERVER['HTTP_USER_AGENT']) && !headers_sent() && (!defined('SIMPLETEST_COLLECT_ERRORS') || SIMPLETEST_COLLECT_ERRORS)) {
    // $number does not use drupal_static as it should not be reset
    // as it uniquely identifies each PHP error.
    static $number = 0;
    $assertion = array(
      $error['%message'],
      $error['%type'],
      array(
        'function' => $error['%function'],
        'file' => $error['%file'],
        'line' => $error['%line'],
      ),
    );
    header('X-Drupal-Assertion-' . $number . ': ' . rawurlencode(serialize($assertion)));
    $number++;
  }

  try {
    watchdog('php', '%type: %message in %function (line %line of %file).', $error, $error['severity_level']);
  }
  catch (Exception $e) {
    // Ignore any additional watchdog exception, as that probably means
    // that the database was not initialized correctly.
  }

  if ($fatal) {
    drupal_add_http_header('500 Service unavailable (with message)');
  }

  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    if ($fatal) {
      // When called from JavaScript, simply output the error message.
      print t('%type: %message in %function (line %line of %file).', $error);
      exit;
    }
  }
  else {
    // Display the message if the current error reporting level allows this type
    // of message to be displayed, and unconditionnaly in update.php.
    $error_level = variable_get('error_level', ERROR_REPORTING_DISPLAY_ALL);
    $display_error = $error_level == ERROR_REPORTING_DISPLAY_ALL || ($error_level == ERROR_REPORTING_DISPLAY_SOME && $error['%type'] != 'Notice');
    if ($display_error || (defined('MAINTENANCE_MODE') && MAINTENANCE_MODE == 'update')) {
      $class = 'error';

      // If error type is 'User notice' then treat it as debug information
      // instead of an error message, see dd().
      if ($error['%type'] == 'User notice') {
        $error['%type'] = 'Debug';
        $class = 'status';
      }

      drupal_set_message(t('%type: %message in %function (line %line of %file).', $error), $class);
    }

    if ($fatal) {
      drupal_set_title(t('Error'));
      // We fallback to a maintenance page at this point, because the page generation
      // itself can generate errors.
      print theme('maintenance_page', array('content' => t('The website encountered an unexpected error. Please try again later.')));
      exit;
    }
  }
}

function exception_handler($e){
	$message		= $e->getMessage();
	$backtrace		= $e->getTrace();
	// Add the line throwing the exception to the backtrace.
	array_unshift($backtrace, array('line' => $e->getLine(), 'file' => $e->getFile()));
	## Add database decodes here
	
	#~ Locate the Error Location
	$caller			= error_locate($backtrace);
	_error_log(array(
				'%type' => get_class($e),
				'%message' => $message,
				'%function' => $caller['function'],
				'%file' => $caller['file'],
				'%line' => $caller['line'],
				'severity_level' => WATCHDOG_ERROR,
			));
}
#~ Custom error handler to show errors more neatly!
function error_handler($erNo, $erMsg, $fName, $line, $context){
	if(0 == error_reporting()){# If the @ error suppression operator was used, error_reporting will have been temporarily set to 0.
		return;
	}

	if($erNo & (E_ALL ^ E_NOTICE ^ E_DEPRECATED)){
		echo $erMsg . "<br />";
		$types					= array( 1 => 'error', 2	=> 'warning', 4 => 'parse error', 8 => 'notice', 16 => 'core error', 32 => 'core warning', 64 => 'compile error', 128 => 'compile warning', 256 => 'user error', 512 => 'user warning', 1024 => 'user notice', 2048 => 'strict warning', 4096 => 'recoverable fatal error' );
		# For database errors, we want the line number/file name of the place that the query was originally called, not _db_query().
		if ('/system/database' == dirname(str_replace(DocRoot, '', str_replace("\\", "/", $fName)))) {
			$backtrace			= array_reverse(debug_backtrace());
			#~ List of functions where SQL queries can originate.
			$query_functions	= array('Call', 'Query', 'Execute');
			#~ Determine where query function was called, and adjust line/file accordingly.
			foreach ($backtrace as $index => $function) {
				if (in_array($function['function'], $query_functions)) {
					$line		= $backtrace[$index]['line'];
					$fName		= $backtrace[$index]['file'];
					break;
				}
			}
		}
		$entry				= $types[$erNo] . ': ' . $erMsg . ' in ' . $fName . ' on line ' . $line . '.<br />';
		message_set($entry, 'error');
		#TODO WatchDog('php', '%message in %file on line %line.', array('%error' => $types[$errno], '%message' => $message, '%file' => $filename, '%line' => $line), WATCHDOG_ERROR);
	}
}

#~ Returns a config value or $value!
function config_get($name, $value = NULL){
	$rs						= db_get()->Call('system_config_get', $name);
	return is_null($rs) ? $value : $rs;
}

#~ Save a configuration value!
function config_set($name, $value = true){
	return db_get()->Call('system_config_set', $name, $value);
}

#~ Delete a previously set configuration 
function config_unset($name){
	return db_get()->Call('system_config_unset', $name);
}

#~ Manage Database Objects!
function db_get($name = 'default'){
	static $dbs					= array();
	if(!empty($dbs)){
		return $dbs[$name]['obj'];
	}
	global
		$settings
	;
	foreach($settings['databases'] as $cname => $database){
		$dbs[$cname]			= parse_url($database);
		$dbs[$cname]['dbname']	= substr($dbs[$cname]['path'], 1);
		unset($dbs[$cname]['path']);
		$class					= "\\Database\\" . $dbs[$cname]['scheme'];
		$dbs[$cname]['obj']		= new $class($dbs[$cname]);
	}
	return $dbs[$name]['obj'];
}

/**
 * Set a message which reflects the status of the performed operation.
 * If the function is called with no arguments, this function returns all set messages without clearing them.
 *
 * @param $message
 *   The message should begin with a capital letter and always ends with a period '.'.
 * @param $type
 *   The type of the message. One of the following values are possible: status | warning | error
 * @param $repeat
 *   If this is FALSE and the message is already set, then the message won't be repeated.
 */
function message_set($message = NULL, $type = 'status', $repeat = TRUE){
	if ($message){
		if (!isset($_SESSION['messages'])) {
			$_SESSION['messages'] = array();
		}
		if (!isset($_SESSION['messages'][$type])) {
			$_SESSION['messages'][$type] = array();
		}
		if ($repeat || !in_array($message, $_SESSION['messages'][$type])) {
			$_SESSION['messages'][$type][] = $message;
		}
	}
	return (isset($_SESSION['messages']) ? $_SESSION['messages'] : NULL);
}

/**
 * Return all messages that have been set.
 *
 * @param $type
 *   (optional) Only return messages of this type.
 * @param $clear_queue
 *   (optional) Set to FALSE if you do not want to clear the messages queue
 * @return
 *   An associative array, the key is the message type, the value an array
 *   of messages. If the $type parameter is passed, you get only that type,
 *   or an empty array if there are no such messages. If $type is not passed,
 *   all message types are returned, or an empty array if none exist.
 */
function message_get($type = NULL, $clear_queue = TRUE) {
  if ($messages = message_set()) {
    if ($type) {
      if ($clear_queue) {
        unset($_SESSION['messages'][$type]);
      }
      if (isset($messages[$type])) {
        return array($type => $messages[$type]);
      }
    }else {
      if ($clear_queue) {
        unset($_SESSION['messages']);
      }
      return $messages;
    }
  }
  return array();
}

/**
 * Log a system message.
 *
 * @param $type
 *   The category to which this message belongs.
 * @param $message
 *   The message to store in the log. See t() for documentation
 *   on how $message and $variables interact. Keep $message
 *   translatable by not concatenating dynamic values into it!
 * @param $variables
 *   Array of variables to replace in the message on display or
 *   NULL if message is already translated or not possible to
 *   translate.
 * @param $severity
 *   The severity of the message, as per RFC 3164
 * @param $link
 *   A link to associate with the message.
 *
 * @see watchdog_severity_levels()
 */
function watchDog($type, $message, $variables = array(), $severity = 0, $link = NULL){ # aka watch dog
	global $app;
	  $log						= array(
									'type'        => $type,
									'message'     => $message,
									'variables'   => $variables,
									'severity'    => $severity,
									'link'        => $link,
									'user'        => $user,
									'request_uri' => $app->RequestPath,
									'referer'     => $_SERVER['HTTP_REFERER'],
									'ip'          => $app->RemoteIP,
									'timestamp'   => time(),
								);
	#TODO
  /* Call the logging hooks to log/process the message
  foreach (module_implements('watchdog', TRUE) as $module) {
    module_invoke($module, 'watchdog', $log_message);
  }*/
}

/**
 * Set an HTTP response header for the current page.
 *
 * Note: When sending a Content-Type header, always include a 'charset' type,
 * too. This is necessary to avoid security bugs (e.g. UTF-7 XSS).
 */
function header_set( $header = NULL ){
	#~ We use an array to guarantee there are no leading or trailing delimiters. Or, header('') could get called when serving the page later, which ends HTTP headers prematurely on some PHP versions.
	static
		$stored_headers		= array()
	;
	
	if ( isset( $header ) ){
		header( $header );
		$stored_headers[]	= $header;
	}
	
	return implode("\n", $stored_headers);
}

function utils_unpack($obj, $properties){
	if(empty($obj)){
		return $obj;
	}
	$properties				= func_get_args();
	array_shift($properties);
	if(is_object($obj)){
		foreach($properties as $p){
			$obj->$p		= unserialize($obj->$p);
		}
	}else{
		foreach($properties as $p){
			$obj[$p]		= unserialize($obj[$p]);
		}
	}
}

?>