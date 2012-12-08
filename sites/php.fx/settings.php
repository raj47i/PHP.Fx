<?php
global $settings;

define( 'Live' , false );

define( 'SSL' , (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true : false );

define( 'BaseURL' , 'http://php.fx' );
define( 'BasePath' , '/php.fx' );

$settings	= array(
# Per RFC 2109, cookie domains must contain at least one dot other than the first. For hosts such as 'localhost' or IP Addresses we don't set a cookie domain.
	'cookie_domain'	=> '.php.fx',
	'paypal'		=> array(
						'sandbox'	=> !Live,
						'version'	=> '50.0',	#API Version
						'api_user'	=> 'sell1_1256274104_biz_api1.arunraj.in',
						'api_pass'	=> '1256274112',
						'api_sign'	=> 'AFcWxV21C7fd0v3bYYYRCpSSRl31A-QetNUlLeNyoUAn6XYFV2QqccVV'
					),
	'themes'		=> array(
						'default'	=> 'Default Theme Full Name',
						'grey'		=> 'Grey Theme 1'
					),
	'databases'		=> array(
						'default'	=> 'pgsqli://php:rajasree@lamp:5432/php_fx'/*,
						'db1'		=> 'mysql://username:password@localhost/databasename',
						'db2'		=> 'mysqli://username:password@localhost/databasename'/**/
					),
	'unicode'		=> false
);
?>