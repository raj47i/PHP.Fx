<?php

class Clock extends \aSingleton implements \iSingleton{
	static
		private $self				= NULL
	;

	static public function Get(){
			if(is_null(self::$self)){
				$class				= __CLASS__;
				self::$self			= new $class;
			}
			return self::$self;
	}
	
	private $clock					= array();
	
	public function Start($name){
		list($usec, $sec)				= explode(' ', microtime());
		$this->clock[$name]['start']	= (float) $usec + (float) $sec;
		$this->clock[$name]['count']	= isset($this->clock[$name]['count'])
											? ++$this->clock[$name]['count']
											: 1;
	}
	
	public function Stop($name){
		$this->clock[$name]['time']	= self::Read($name);
		unset($this->clock[$name]['start']);
		return $this->clock[$name];
	}
	
	public function Read($name){
		if(isset($this->clock[$name]['start'])){
			list($usec, $sec)			= explode(' ', microtime());
			$stop						= (float) $usec + (float) $sec;
			$diff						= round(($stop - $this->clock[$name]['start']) * 1000, 2);
			if (isset($this->clock[$name]['time'])) {
				$diff					+= $this->clock[$name]['time'];
			}
			return $diff;
		}
	}

}
?>