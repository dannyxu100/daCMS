<?php
function is_domain($domain){
	if(preg_match("/^([0-9a-z\-]{1,}\.)?[0-9a-z\-]{2,}\.([0-9a-z\-]{2,}\.)?[a-z]{2,}$/i", $domain))	{
		return true;
	}else{
		return false;
	}
}

function get_content($url){
	if(!strpos($url, '://')) return 'Invalid URI';
	$content = '';
	if(ini_get('allow_url_fopen')){
	    $cnt=0;
        while($cnt < 15 && ($content=@file_get_contents($url))===FALSE) $cnt++;		
	}
	elseif(function_exists('curl_init')){
		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 0);
		$content = curl_exec($handle);
		curl_close($handle);
	}
	elseif(function_exists('fsockopen')){
		$urlinfo = parse_url($url);
		$host    = $urlinfo['host'];
		$str     = explode($host, $url);
		$uri     = $str[1];
		unset($urlinfo, $str);
		$content = '';
		$fp = fsockopen($host, 80, $errno, $errstr, 30);
		if(!$fp){
			$content = 'Can Not Open Socket...';
		}
		else{
			$out = "GET $uri   HTTP/1.1\r\n";
			$out.= "Host: $host \r\n";
			$out.= "Accept: */*\r\n";
			$out.= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out.= "Connection: Close\r\n\r\n";
			fputs($fp, $out);
			while (!feof($fp)){
				$content .= fgets($fp, 4069);
			}
			fclose($fp);
		}
	}
	if(empty($content)) $content = '无法打开该链接！';
	return $content;
}
?>