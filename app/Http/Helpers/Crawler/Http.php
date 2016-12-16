<?php namespace App\Http\Helpers\Crawler;

class Http
{
	private static $_instance = NULL;
	/**
	 * curl发生错误时记录错误号以及错误信息
	 */
	private $_error = NULL;
	/**
	 * 最后一次HTTP返回的status code
	 */
	private $_http_code = NULL;
    private $_https = false;

	/**
	 * @return Http
	 */
    public static function getInstance()
    {
        if (!isset(self::$_instance))
        {
        	$c = __CLASS__;
            self::$_instance = new $c;
        }
        return self::$_instance;
    }
    
    public function request($url, $header=null, $options=[])
    {
        $this->_error = null;
        $this->_http_code = null;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_TIMEOUT,  isset($options['timeout']) ? $options['timeout'] : 30);
		
		if(!empty($header) && count($header) > 0)
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        if($this->_https)
        {
            // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
            // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        }

		$output = curl_exec($curl);
		if($output === FALSE)
			$this->_error = curl_errno($curl).'# :'.curl_error($curl);
		$this->_http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		return $output;
    }
    
//    public function requestProxy($url, $header=null) {
//		$curl = curl_init();
//		curl_setopt($curl, CURLOPT_URL, $url);
//		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//// 		curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
////		curl_setopt($curl, CURLOPT_PROXY, ProxyGenerator::get_singleton()->randProxy());
//		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
//		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
//		curl_setopt($curl, CURLOPT_FAILONERROR, 0);
//
//		if(!empty($header) && count($header) > 0)
//			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
//
//		$output = curl_exec($curl);
//		if($output === FALSE)
//			$this->_error = curl_errno($curl).'# :'.curl_error($curl);
//		$this->_http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//		curl_close($curl);
//		return $output;
//    }
    
    public function request_post($url, $header=[], $post, $options=[])
    {
        $this->_error = null;
        $this->_http_code = null;
    	$curl = curl_init();
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_POST, 1);
    	curl_setopt($curl, CURLOPT_POSTFIELDS, is_array($post) ? http_build_query($post) : $post);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
    	curl_setopt($curl, CURLOPT_TIMEOUT, isset($options['timeout']) ? $options['timeout'] : 30);
    
    	if(!empty($header) && count($header) > 0)
    		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        if($this->_https)
        {
            // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
            // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        }

    	$output = curl_exec($curl);
    	if($output === FALSE)
    		$this->_error = curl_errno($curl).'# :'.curl_error($curl);
    	$this->_http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    	curl_close($curl);
    	return $output;
    }

    public function setHttps()
    {
        $this->_https = TRUE;
    }
    
    public function getError()
    {
    	return $this->_error;
    }
    
    public function getMessage()
    {
    	return "http code:{$this->_http_code}, error:{$this->_error}";
    }
    
    public function getHttpCode()
    {
    	return $this->_http_code;
    }
}