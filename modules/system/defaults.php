<?php
namespace System;

class Defaults{
	public function GetPage($code){
		switch($code){
			case 401:
			case 404:
				return new Theme('system', $code . '.tpl');
			break;
		}
	}
}
?>