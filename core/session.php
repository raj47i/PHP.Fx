<?php
namespace System;

class Session extends \aSingleton implements \iSingleton{
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
		$_name						= false,
		$_save						= true
	;

	private function __construct(){
		session_set_save_handler(
			array($this,'_Open'),	# Open Session
			array($this,'_Close'),	# Close Session
			array($this,'_Read'),	# Read from Session
			array($this,'_Write'),	# Write to Session
			array($this,'_Destroy'),# Destroy current Session
			array($this,'_Purge')	# Garbage collector for Session
		);
	}
	
	public function Init(){
		if($_COOKIE[session_name()]){
			#~ If a session cookie exists, initialize the session. Otherwise the session is only started on demand in drupal_session_commit(), making
			#  anonymous users not use a session cookie unless something is stored in $_SESSION. This allows HTTP proxies to cache anonymous pageviews.
			$this->Start();
			##if(User is guest || Session is not NULL){
			##	Page is not cacheable
			##}
		}else{
			#~ Set a session identifier for this request. This is necessary because we lazily start sessions at the end of this request, and some<br />
			# processes (like drupal_get_token()) needs to know the future session ID in advance.
			## $user = drupal_anonymous_user();
			session_id(md5(uniqid('', TRUE)));
		}
	}

	public function _Open($path, $name){
		return ($this->_name = $name);
	}

	public function Save($status = true){
		return ($this->_save = $status);
	}

	public function _Close(){
		return TRUE;
	}

	public function _Read($sessId){
		global
			$app
		;
		if(!isset($_COOKIE[$this->_name])){
			$app->User->Init(array('Id' => NULL, 'Roles' => array(0 => 'guest'), 'UserName' => 'guest', 'Name' => 'guest', 'Theme' => NULL, 'Picture' => NULL), false);
			return NULL;
		}
		$rs							= db_get()->Execute( 'system_session_read', $sessId )->Fetch();
		if($rs){
			$app->User->Init(array(
							'Id'		=> $rs['UserId'],
							'Roles'		=> array(1 => 'authenticated user'),
							'UserName'	=> $rs['UserName'],
							'Name'		=> $rs['Name'],
							'Sex'		=> $rs['Sex'],
							'DOB'		=> $rs['DOB'],
							'Status'	=> $rs['Status'],
							'Theme'		=> $rs['Theme'],
							'Signature'	=> $rs['Signature'],
							'LastAccess'=> $rs['LastAccess'],
							'LastLogin'	=> $rs['LastLogin'],
							'Timezone'	=> $rs['Timezone'],
							'Picture'	=> $rs['Picture'],
							'Data'		=> $rs['Data']
						), true); # Set Values and autoload Roles from the database !
		}else{
			$app->User->Init(array('Id' => NULL, 'Roles' => array(0 => 'guest'), 'UserName' => 'guest', 'Name' => 'guest', 'Theme' => NULL, 'Picture' => NULL), false);
		}
		return $rs['Session'];
	}

	public function _Write($key, $data){
		global $user;
		$userId						= empty($user->Id) ? 0 : $user->Id;
		$app						= Application::Get();
		if( !$this->_save || (empty($data) && empty($_COOKIE[$this->_name]) && $userId > 0) ){
			return TRUE;
		}
		return db_get()->Call('system_session_write', $key, $userId, $app->RemoteIP, 1, $data);
	}

	public function _Destroy($sessId){
		return db_get()->Call('system_session_destroy', $sessId);
	}

	public function _Purge($maxLifeTime){
		return db_get()->Call('system_session_purge', $maxLifeTime);
	}
	
	public function Start($force = false){
		if(!isset($_SESSION) || $force){
			return session_start();
		}
		return false;
	}
	
	public function Destroy(){
		session_destroy();
	}
	
	public function KickOut($userId){
		return db_get()->Call('system_session_kickout', $userId);
	}
	
	public function Id(){
		$this->Start();
		return session_id();
	}
	
	public function __get($key){
		return $_SESSION[$key];
	}
	
	public function __set($key, $value){
		$_SESSION[$key]						= $value;
		return $_SESSION[$key];
	}
	
	public function USet($name){
		$keys			= func_get_args();
		foreach($keys as $key){
			unset($_SESSION[$key]);
		}
		return NULL;
	}
	
	public function ReGenerate(){
		$oldSId						= session_id();
		session_regenerate_id();
		return $this->_Destroy($oldSId);
	}
	
	public function Count($timeStamp = 0){
		return ( db_get()->Execute( 'system_session_count', $timeStamp)->Fetch() );
	}
}
?>