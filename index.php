<?php

#~ Set Application's Root Directory!
define('DocRoot', str_replace("\\", "/", dirname(__FILE__)));

#~ Include System files!
require_once( DocRoot . '/core/internal_variables.php' );
require_once( DocRoot . '/core/internal_functions.php' );
require_once( DocRoot . '/core/internal_oop.php' );
require_once( DocRoot . '/core/application.php' );
require_once( DocRoot . '/core/session.php' );
require_once( DocRoot . '/core/theme.php' );
require_once( DocRoot . '/core/clock.php' );
require_once( DocRoot . '/core/user.php' );

#~ Initialize & Bootstrap application!
$app			= \System\Application::Get();
$app->Boot();

#~ If Application is Not Offline, Process the request
if( $app->IsOffline() ){
	#$app->Enabl
}else{
	$app->Execute();
}

#~ Make the sub calculations & Turn off the Application
#~ Javascript, CSS, other Head / Closure Items, will be applied..
$html			= $app->TurnOff();

#~ We will reach here only for HTML pages; XML / JSON / etc.. would have been already sent!
#~ So go ahead and display the Active Theme Template
$html->Display();
?>