<?php
namespace wapi\lib;
class HttpClient{
	private $ch;
	public $timeout = 30;
	function __construct($cookie=false){
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
   		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($this->ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($this->ch, CURLOPT_ENCODING,'gzip,deflate');
	}
	function __destruct(){
		curl_close($this->ch);
	}
	final public function setProxy($proxy='http://192.168.0.103:3128'){
		curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
	}

	final public function setHeader($headers=false){
//		$defalut = [
//			'Accept-Encoding:gzip,deflate',
//			'Cache-Control: no-cache',
//			'Accept-Language:zh-CN,zh;q=0.8',
//			'Content-Type: application/json',
//			'X-Requested-With:XMLHttpRequest'
//			];
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
	}

	final public function setReferer($ref=''){
		if($ref != ''){
			curl_setopt($this->ch, CURLOPT_REFERER, $ref);//Referrer
		}
	}
	final public function setEncode($code = 'UTF-8'){
		curl_setopt($this->ch, CURLOPT_ENCODING, $code);
	}

	final public function setCookie($ck=''){
		if($ck != ''){
			curl_setopt($this->ch, CURLOPT_COOKIE, $ck);//Cookie
		}
	}

	final public function Get($url, $header=false, $nobody=false){
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POST, 0);//GET
		curl_setopt($this->ch, CURLOPT_HEADER, $header);
		curl_setopt($this->ch, CURLOPT_NOBODY, $nobody);
		return curl_exec($this->ch);
	}

	final public function Post($url, $data=array(), $header=false, $nobody=false){
		if(is_array($data))$data = http_build_query($data);
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_HEADER, $header);
		curl_setopt($this->ch, CURLOPT_NOBODY, $nobody);
		curl_setopt($this->ch, CURLOPT_POST, true);//POST
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
		return curl_exec($this->ch);
	}
	final public function getCode(){
		$httpCode = curl_getinfo($this->ch,CURLINFO_HTTP_CODE);
		return $httpCode;
	}
}

