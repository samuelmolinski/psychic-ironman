<?php

	function shortenURL($longUrl) {

		// initialize the cURL connection
		$ch = curl_init(sprintf('%s/url?key=%s', GOOGLE_ENDPOINT, GOOGLE_API_KEY));

		// tell cURL to return the data rather than outputting it
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// create the data to be encoded into JSON
		$requestData = array('longUrl' => $longUrl);

		// change the request type to POST
		curl_setopt($ch, CURLOPT_POST, true);

		// set the form content type for JSON data
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

		// set the post body to encoded JSON data
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

		// perform the request
		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result, true);
	}

	function currentURI() {
		return hostURI() . $_SERVER["REQUEST_URI"];
	}
	/*
	 * returns the base uri shown in the uri (strips parameters)
	 * for example, "https://grs.ggle.com/forum/help.php?fromgroups#!forum/yiimdbs"
	 * would return "https://grs.ggle.com/forum/help.php"
	 * 
	 */

	function currentBaseURI() {
		$base = $_SERVER["REQUEST_URI"];
		$base = explode('?', $base);
		return hostURI() . $base[0];
	}
	
	/*
	 * returns the last dir shown in the uri
	 * for example, "https://grs.ggle.com/forum/help.php?fromgroups#!forum/yiimdbs"
	 * would return "https://grs.ggle.com/forum/"
	 * 
	 */
	function currenURIDir() {
		$base = $_SERVER["REQUEST_URI"];
		$base = explode('?', $base);
		$base = explode('/', $base[0]);
		$last = $base[count($base) - 1];
		if (FALSE === strpos($last, '.')) {
			$base = implode('/', $base);
		} else {
			array_pop($base);
			$base = implode('/', $base);
		}
		return hostURI() . $base;
	}
	
	/*
	 * returns the last dir shown in the uri
	 * for example, "https://grs.ggle.com/forum/help.php?fromgroups#!forum/yiimdbs"
	 * would return "https://grs.ggle.com/"
	 * 
	 */

	function hostURI() {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"])) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"];
		}
		return $pageURL;
	}
	
	/*
	 * 
	 * 
	 */

	function addParamToURL($url, $param) {
		// support for arrays
		$p = strpos($url, '?');
		
		if (FALSE === $p) {
			if (is_array($param)) {				
				return $url = $url . '?' . http_build_query($param);
			} else {
				return $url = $url . '?' . $param;
			}
		} else {
			if (is_array($param)) {				
				return $url = $url . '&' . http_build_query($param);
			} else {
				return $url = $url . '&' . $param;
			}
		}
	}


	function rest_helper($url, $params = null, $verb = 'GET', $format = 'json') {
		$cparams = array('http' => array('method' => $verb, 'ignore_errors' => true));
		if ($params !== null) {
			$params = http_build_query($params);
			if ($verb == 'POST') {
				$cparams['http']['content'] = $params;
			} else {
				$url .= '?' . $params;
			}
		}

		$context = stream_context_create($cparams);
		$fp = fopen($url, 'rb', false, $context);
		if (!$fp) {
			$res = false;
		} else {
			// If you're trying to troubleshoot problems, try uncommenting the
			// next two lines; it will show you the HTTP response headers across
			// all the redirects:
			// $meta = stream_get_meta_data($fp);
			// var_dump($meta['wrapper_data']);
			$res = stream_get_contents($fp);
		}

		if ($res === false) {
			throw new Exception("$verb $url failed: $php_errormsg");
		}

		switch ($format) {
			case 'json' :
				$r = json_decode($res);
				if ($r === null) {
					throw new Exception("failed to decode $res as json");
				}
				return $r;

			case 'xml' :
				$r = simplexml_load_string($res);
				if ($r === null) {
					throw new Exception("failed to decode $res as xml");
				}
				return $r;
		}
		return $res;
	}

	/**
	 * get_redirect_url()
	 * Gets the address that the provided URL redirects to,
	 * or FALSE if there's no redirect. 
	 *
	 * @param string $url
	 * @return string
	 */
	function get_redirect_url($url){
	    $redirect_url = null; 
	 
	    $url_parts = @parse_url($url);
	    if (!$url_parts) return false;
	    if (!isset($url_parts['host'])) return false; //can't process relative URLs
	    if (!isset($url_parts['path'])) $url_parts['path'] = '/';
	      
	    $sock = fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
	    if (!$sock) return false;
	      
	    $request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n"; 
	    $request .= 'Host: ' . $url_parts['host'] . "\r\n"; 
	    $request .= "Connection: Close\r\n\r\n"; 
	    fwrite($sock, $request);
	    $response = '';
	    while(!feof($sock)) $response .= fread($sock, 8192);
	    fclose($sock);
	 
	    if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
	        if ( substr($matches[1], 0, 1) == "/" )
	            return $url_parts['scheme'] . "://" . $url_parts['host'] . trim($matches[1]);
	        else
	            return trim($matches[1]);
	  
	    } else {
	        return false;
	    }
	     
	}
	 
	/**
	 * get_all_redirects()
	 * Follows and collects all redirects, in order, for the given URL. 
	 *
	 * @param string $url
	 * @return array
	 */
	function get_all_redirects($url){
	    $redirects = array();
	    while ($newurl = get_redirect_url($url)){
	        if (in_array($newurl, $redirects)){
	            break;
	        }
	        $redirects[] = $newurl;
	        $url = $newurl;
	    }
	    return $redirects;
	}
	 
	/**
	 * get_final_url()
	 * Gets the address that the URL ultimately leads to. 
	 * Returns $url itself if it isn't a redirect.
	 *
	 * @param string $url
	 * @return string
	 */
	function get_final_url($url){
	    $redirects = get_all_redirects($url);
	    if (count($redirects)>0){
	        return array_pop($redirects);
	    } else {
	        return $url;
	    }
	}

	class sfFacebookPhoto{
	   private $useragent = 'Loximi sfFacebookPhoto PHP5 (curl)';
	   private $curl = null;
	   private $response_meta_info = array();
	   private $header = array(
	      "Accept-Encoding: gzip,deflate",
	      "Accept-Charset: utf-8;q=0.7,*;q=0.7",
	      "Connection: close"
	 );
	 public function __construct() {
	    $this->curl = curl_init();
	    register_shutdown_function(array($this, 'shutdown'));
	 }
	/**
	 * Get the real url for picture to use after
	 */
	public function getRealUrl($photoLink) {
	    curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->header);
	    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, false);
	    curl_setopt($this->curl, CURLOPT_HEADER, false);
	    curl_setopt($this->curl, CURLOPT_USERAGENT, $this->useragent);
	    curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 10);
	    curl_setopt($this->curl, CURLOPT_TIMEOUT, 15);
	    curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	    curl_setopt($this->curl, CURLOPT_URL, $photoLink);
	    //        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
	    //this assumes your code is into a class method, and uses $this->readHeader as the callback //function
	    curl_setopt($this->curl, CURLOPT_HEADERFUNCTION, array(&$this, 'readHeader'));
	    $response = curl_exec($this->curl);
	    if (!curl_errno($this->curl)) {
	        $info = curl_getinfo($this->curl);
	        //var_dump($info);
	        if ($info["http_code"] == 302) {
	            $headers = $this->getHeaders();
	            if (isset($headers['fileUrl'])) {
	                return $headers['fileUrl'];
	            }
	         }
	     }
	     return false;
	 }
/**
 * Download facebook user photo
 * 
 */
  public function download($fileName) {
      curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->header);
      curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($this->curl, CURLOPT_HEADER, false);
      curl_setopt($this->curl, CURLOPT_USERAGENT, $this->useragent);
      curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($this->curl, CURLOPT_TIMEOUT, 15);
      curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
      curl_setopt($this->curl, CURLOPT_URL, $fileName);
      curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
      $response = curl_exec($this->curl);
      $return = false;
      if (!curl_errno($this->curl)) {
            $parts = explode('.', $fileName);
            $ext = array_pop($parts);
            $return = sfConfig::get('sf_upload_dir') . '/tmp/' . uniqid('fbphoto') . '.' . $ext;
            file_put_contents($return, $response);
       }
       return $return;
     }
    /**
    * CURL callback function for reading and processing headers
    * Override this for your needs
    *
    * @param object $ch
    * @param string $header
    * @return integer
    */
    private function readHeader($ch, $header) {
     //extracting example data: filename from header field Content-Disposition
      $filename = $this->extractCustomHeader('Location: ', '\n', $header);
      if ($filename) {
          $this->response_meta_info['fileUrl'] = trim($filename);
      }
      return strlen($header);        
    }
    private function extractCustomHeader($start, $end, $header) {
       $pattern = '/' . $start . '(.*?)' . $end . '/';
       if (preg_match($pattern, $header, $result)) {
           return $result[1];
       } else {
          return false;
       }
   }
   public function getHeaders() {
       return $this->response_meta_info;
   }
   /**
   * Cleanup resources
   */
   public function shutdown() {
       if ($this->curl) {
          curl_close($this->curl);
       }
   }
}