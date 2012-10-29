<?php
	if(isset($_GET['path'])) {
		$pathDownload = $_GET['path'];	
		$file = $_GET['file'];
	} else {
		$pathDownload = 'downloads/';		
		$file = $pathDownload.$_GET['file'];
	}
	
	//d($file);
	//d(file_exists($file));
	if (file_exists($file)) {
		if (ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit ;
	}

	function currenURIDir() {
		$base = $_SERVER["REQUEST_URI"];
		$base = explode('?', $base);
		$base = explode('/',  $base[0]);
		$last = $base[count($base)-1];
		if (FALSE === strpos($last, '.')) {
			$base = implode('/', $base);
		} else {
			array_pop($base);
			$base = implode('/', $base);			
		}
		return hostURI() . $base;
	}
	
	function hostURI() {
		$pageURL = 'http';
		//if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"];
		}
		return $pageURL;
	}
	
	function d($var) {
		if (TRUE) {
			
			$bt = debug_backtrace();
			$src = file($bt[0]["file"]);
			$line = $src[ $bt[0]['line'] - 1 ];

			//striping the inspect() from the sting
			$strip = explode('d(', $line);
			$matches = preg_match('#\(#', $strip[0]);
			$strip = explode(')', $strip[1]);
			for ($i=0;$i<count($matches-1);$i++) {
				array_pop($strip);
			}
			$label = implode(')', $strip);
                          
               d_format($var, $label);
		}

	}
	
	// log function to 
	
	function l() {
		global $super_dump_log;
		
		if (func_num_args() > 0) {
			$array = func_get_args();
			array_merge($super_dump_log, $array);
		} else {
			foreach($super_dump_log as $log){
				//
			}
		}
	}
	
	function d_format($var, $label) {
		
		$colorVar = 'Blue';
		$type = get_type($var);
		$colorType = get_type_color($type);
		
		echo "<div class='inspect' style='background-color:#FFF; overflow:visible;'><pre><span style='color:$colorVar'>";
		echo $label;
		echo "</span> = <span style='color:$colorType'>";
		if ($type == 'string') {
			print_r(htmlspecialchars($var));
		} else {
			print_r($var);
		}
		echo "</span></pre></div>";
	}
	
	function get_type($var) {
		
		if (is_bool($var)) {
			$type = 'bool';
		} elseif (is_string($var)) {
			$type = 'string';
		} elseif (is_array($var)) {	
			$type = 'array';		
		} elseif (is_object($var)) {	
			$type = 'object';		
		} elseif (is_numeric($var)) {
			$type = 'numeric';
		} else {
			$type = 'unknown';
		}
		
		return $type;
	}

	
	function get_type_color($type) {

		if ('bool' == $type) {
			$colorType = 'Green';
		} elseif ('string' == $type) {
			$colorType = 'DarkOrange';
		} elseif ('array' == $type) {
			$colorType = 'DarkOrchid';
		} elseif ('object' == $type) {
			$colorType = 'BlueViolet';
		} elseif ('numeric' == $type) {
			$colorType = 'Red';	
		} else {	
			$colorType = 'Tomato';	
		}
		
		return $colorType;
	}