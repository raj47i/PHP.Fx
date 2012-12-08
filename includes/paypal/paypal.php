<?php
namespace Includes\PayPal;

class PayPal{
	private
		$_Token					= NULL,
		$_Args					= NULL,
		$_APIURL				= NULL,
		$_GateWay				= NULL
	;
	public function __construct($token = NULL){
		global $settings;
		if(empty($settings['paypal']['sanbox'])){	# Live Mode
			$this->_APIURL		= 'https://api-3t.paypal.com/nvp';
			$this->_GateWay		= 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout';
		}else{										# Sandbox Mode for testing.
			$this->_APIURL		= 'https://api-3t.sandbox.paypal.com/nvp'; # https://api-3t.beta-sandbox.paypal.com/nvp
			$this->_GateWay		= 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout';
		}
		$this->_Args			= array(
									'VERSION'	=> $settings['paypal']['version'],
									'USER'		=> $settings['paypal']['api_user'],
									'PWD'		=> $settings['paypal']['api_pass'],
									'SIGNATURE'	=> $settings['paypal']['api_sign']
								);
		$this->_Token			= $token;
	}

	public function __destruct(){}

	private function _DoCURL($nvp){
	# URL encode & prepare args for request.
		$params					= $this->_Args + $nvp;
		$nvp					= array();
		foreach($params as $k => $v){
			$nvp[]				= $k . '=' . urlencode($v);
		}
	# Init CURL & sent the CURL PARAMs
		$curlObj				= curl_init($this->_APIURL);
		# Turning off the server and peer verification(TrustManager Concept).
		curl_setopt($curlObj, CURLOPT_VERBOSE, 1);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curlObj, CURLOPT_POST, 1);		# setting the nvpreq as POST FIELD to curl
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, implode('&', $nvp));
	# Execute CURL request..
		$httpResponse			= curl_exec($curlObj);
		if(!$httpResponse){
			throw new \Exception(curl_error($curlObj), curl_errno($curlObj));
		}
	# Parse the CURL Respose to an Array
		$httpResponseAr			= explode("&", $httpResponse);
		$httpParsedResponseAr	= array();
		foreach ($httpResponseAr as $i => $value){
			$tmpAr = explode("=", $value);
			if(is_array($tmpAr)){
				@$httpParsedResponseAr[$tmpAr[0]] = urldecode($tmpAr[1]);
			}
		}
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)){
			throw new \Exception("Invalid HTTP Response for POST request ( {$nvp} ) to {$this->APIURL}!");
		}
		return $httpParsedResponseAr;
	}

	public function GetToken(){
		if(is_null($this->_Token)){
			throw new \Exception("PayPal: 'SetExpressCheckout' not complete or Token is not set!");
		}
		return $this->_Token;
	}

	public function Go($return = false){
		$gateWay				= $this->GateWay . "&token=" . $this->GetToken();
		if($return){
			return $gateWay;
		}
		header("Location: {$gateWay}");
		exit;
	}

	public function SetExpressCheckout($p){
		$r						= $this->_DoCURL($p + array('METHOD' => 'SetExpressCheckout'));
		if(!empty($r['TOKEN'])){
			$this->_Token		= $r['TOKEN'];
		}
		return $r;
	}

	public function __call($name, $p){
		$p['METHOD']			= $name;
		return $this->_DoCURL($p);
	}
}