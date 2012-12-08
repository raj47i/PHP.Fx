<?php
namespace System;

class User{
	private
		$__get						= array(
										'Id' => 0
									)
	;
	
	public function __construct(){	}
	
	public function Init(array $vals, $loadRoles = false){
		foreach($vals as $k => $v){
			$this->__get[$k]		= $v;
		}
		if($loadRoles){
			return $this->LoadRoles();
		}
		return true;
	}
	
	public function __get($name){
		if(array_key_exists($name, $this->__get)){
			return $this->__get[$name];
		}
		throw new \Exception( 'Undefined property ' . $name );
	}

	public function Load(int $userId, $loadRoles = true){
		$db							= GetDatabase();
		if($loadRoles){
			return $this->LoadRoles();
		}
		return true;
	}
	
	public function LoadRoles(){
		$rs							= db_get()->Execute( 'system_user_loadroles', $this->__get['Id'] );
		while($row = $rs->Fetch()){
			$this->__get['Roles'][$row['RoleId']]	= $row['Name'];
		}
		unset($rs, $row);
		return true;
	}
}
?>