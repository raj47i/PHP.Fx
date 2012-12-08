<?php
class reCaptcha{
	private
		$APIServer				= NULL,
		$VerifyServer			= 'api-verify.recaptcha.net',
		$Error					= NULL
	;
	
	static
		$PublicKey				= NULL,
		$PrivateKey				= NULL,
		$MPublicKey				= NULL,
		$MPrivateKey			= NULL
	;

	public function __construct( $ssl, $pKey = FALSE, $prKey = FALSE, $pMKey = FALSE, $prMKey = FALSE ){
		$this->APIServer		= $ssl ? 'https://api-secure.recaptcha.net' : 'http://api.recaptcha.net';
		if( $pKey ){
			self::SetKeys($pKey, $prKey);
		}
		if( $pMKey ){
			self::SetKeys($pMKey, $prMKey, true);
		}
	}
	
	public function SetKeys($pKey, $prKey, $mail = false){
		if($mail){
			self::$MPublicKey	= $pKey;
			self::$MPrivateKey	= $prKey;
			return;
		}
		self::$PublicKey		= $pKey;
		self::$PrivateKey		= $prKey;
	}
	
	public function __destruct(){}
	
	public function Error(){
		if( $this->Error ){
			$t					= $this->Error;
			$this->Error		= NULL;
			return $t;
		}
		return false;
	}
	
	public function GetHtml( $error = NULL ){
		if( empty( self::$PublicKey ) ){
			throw new Exception ( 'To use reCAPTCHA you must get an API key from http://recaptcha.net/api/getkey !' );
		}
		$data					= htmlspecialchars( $this->_QsEncode( array( 'k' => self::$PublicKey, 'error' => $error ) ) );
		$html					= "
			<script type=\"text/javascript\" src=\"{$this->APIServer}/challenge?{$data}\"></script>
            <noscript>
            	<iframe src=\"{$this->APIServer}/noscript?{$data}\" height=\"300\" width=\"500\" frameborder=\"0\"></iframe><br />
                <textarea name=\"recaptcha_challenge_field\" rows=\"3\" cols=\"40\"></textarea>
                <input type=\"hidden\" name=\"recaptcha_response_field\" value=\"manual_challenge\" />
			</noscript>"
		;
		return $html;
	}
	
	public function SignUpURL( $html = true, $domain = null, $appName = null ){
		$domain					= $this->_QsEncode( array ('domain' => $domain, 'app' => $appName ));
		$html					= $html ? htmlspecialchars($domain) : $domain;
		return "http://recaptcha.net/api/getkey?" . $html;
	}
	
	public function IsValid( $pIP, $pChallenge, $pResponse, $pExtra = array() ){
		if( empty( self::$PrivateKey ) ){
			throw new Exception ( 'To use reCAPTCHA you must get an API key from http://recaptcha.net/api/getkey !' );
		}
		if( empty( $pIP ) ){
			throw new Exception ( 'For security reasons, you must pass the remote ip to reCAPTCHA !' );
		}
		if( empty( $pChallenge ) || empty( $pResponse ) ){
			$this->Error		= 'incorrect-captcha-sol';
			return false;
		}
		
		$response				= $this->_Post( $this->VerifyServer, '/verify', array( 'privatekey' => self::$PrivateKey, 'remoteip' => $pIP,
																					  'challenge' => $pChallenge, 'response' => $pResponse ) + $pExtra);
		$response				= explode ("\n", $response [1]);
		if( trim( $response[0] ) == 'true' ){
			return true;
		}
		$this->Error			= $response[1];
		return false;
	}
	
	private function _Post( $host, $path, $data, $port = 80 ){
		$data					= $this->_QsEncode( $data );
		$http_req				= "POST {$path} HTTP/1.0\r\n";
		$http_req				.= "Host: {$host}\r\n";
		$http_req				.= "Content-Type: application/x-www-form-urlencoded;\r\n";
		$http_req				.= "Content-Length: " . strlen($req) . "\r\n";
		$http_req				.= "User-Agent: reCAPTCHA/PHP\r\n";
		$http_req				.= "\r\n";
		$http_req				.= $data;

		$http_res				= '';
		if( false == ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) ) {
			throw new Exception ( 'Error, Could not open socket !' );
        }
		fwrite($fs, $http_request);
		while ( !feof($fs) ){
			$http_res .= fgets($fs, 1160); // One TCP-IP packet
		}
		fclose($fs);
		
		$http_res = explode("\r\n\r\n", $http_res, 2);
		return $http_res;
	}

	private function _QsEncode( array $data ){
		foreach ( $data as $k => $v ){
			$data[ $k ]		= $k . '=' . urlencode($v);
		}
		return implode ( '&', $data );
	}
	
	private function AESPad( $p ){
		$block_size			= 16;
		$numpad				= $block_size - (strlen ($p) % $block_size);
		return str_pad($p, strlen ($p) + $numpad, chr($numpad));
	}
	
	private function AESEncrypt( $pVal, $pKey ){
		if (! function_exists ("mcrypt_encrypt")) {
			throw new Exception ( 'Error, To use reCAPTCHA Mailhide - you need to have the mcrypt php module installed !' );
		}
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $pKey, $this->AESPad( $pVal ), MCRYPT_MODE_CBC, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0");
	}
	
	public function MailHideURL( $pEmail ){
		if( empty( self::$MPrivateKey ) || empty( self::$MPublicKey ) ){
			throw new Exception ( 'To use reCAPTCHA MailHide you must get a MailHide-API key from http://recaptcha.net/api/getkey !' );
		}
		$ky					= pack('H*', self::$MPrivateKey);
		$pEmail				= $this->AESEncrypt( $pEmail, $ky );
		$html				= $this->_QsEncode( array( 'k' => self::$MPublicKey, 'c' => strtr(base64_encode( $pEmail ), '+/', '-_') ) );
		return "http://mailhide.recaptcha.net/d?" . $html;
	}
	
	public function MailHideParts( $pEmail ){
		$arr				= preg_split("/@/", $pEmail );
		if (strlen ($arr[0]) <= 4) {
			$arr[0]			= substr ($arr[0], 0, 1);
		}elseif (strlen ($arr[0]) <= 6) {
			$arr[0]			= substr ($arr[0], 0, 3);
		}else{
			$arr[0]			= substr ($arr[0], 0, 4);
		}
		return $arr;
	}
	
	public function MailHide( $pEmail ){
		$txt				= $this->MailHideParts( $pEmail );
		$url				= htmlentities( $this->MailHideURL( $pEmail ) );
		$html				= htmlentities( $txt[0] ) . "<a href=\"{$url}\" onclick=\"window.open('{$url}', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;\">...</a>@" . htmlentities( $txt[1] );
		return $html;
	}
}
?>