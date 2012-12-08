<?php

#~ Singleton Class Interface
interface iSingleton{
	static public function Get();
	public function __clone();
	#private function __construct();
}

#~ Generic Parent Class for Singleton Classes
abstract class aSingleton{
	public function __clone(){
		throw new \Exception('Singleton: Multiple instances are not allowed.');
	}
}


interface iDatabase{
	public function __construct($conf);
	#~ Connect and Initialize the Database for use
	public function Connect();
	#~ Perform a Database Query
	public function Query($query);
	#~ Safely encode / decode a Blob
	public function EncodeBlob($data);
	public function DecodeBlob($data);
	#~ Safely escape a string
	public function EscapeStr($str);
}

abstract class aDatabase{
	protected
		$conf						= NULL,
		$connection					= NULL
	;
	public function __construct($conf){
		$this->conf					= $conf;
	}	
}

#~ Module Bases
abstract class Module{
	public function __construct(){}
	public function __destruct(){}
	
	public function Boot(){}

	public function Access(){}
	public function Perm(){}
	
	public function WatchDog(){}

	final function Invoke($event, $args){
		return call_user_func_array( array( $this, $event ), $args );
	}
}
abstract class modInfo{
	
}

abstract class modCron{
	public function __construct(){}
	public function __destruct(){}
	public function Execute(){}
	public function WatchDog(){}
}

abstract class modInstaller{
	public function __construct(){}
	public function __destruct(){}
	
	public function Install(){}
	public function Remove(){}
	public function Update(){}
	public function WatchDog(){}
	
	public function Enable(){}
	public function Disable(){}
	
	public function Schema($version){}
	
}
?>