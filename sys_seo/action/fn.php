<?php
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	/****************  关键词排名查询-正则常量 **********************/
	define("REG_KW_BAIDU_LIST", "/<div id=\"content_left\">(.*)<p id=\"page\" >/Uis");		//list内容
	define("REG_KW_BAIDU_HIGHLIGHT", "/<font color=#CC0000>(.*)<\/font>/Uis");				//高亮关键词
	define("REG_KW_BAIDU_DATE", "/<font color=\"#008000\">(.*)<\/font>/Uis");				//域名+日期部分（情况1）
	define("REG_KW_BAIDU_DATE2", "/<span class=\"g\">(.*)<\/span>/Uis");					//域名+日期部分（情况2）
	define("REG_KW_BAIDU_DATE3", "/<span class=\"op_wiseapp_showurl\">(.*)<\/span>/Uis");	//域名+日期部分（情况3）
	define("REG_KW_BAIDU_DATE4", "/<span class=\"c-showurl\">(.*)<\/span>/Uis");			//域名+日期部分（情况4）
	
	
	
	
	/**验证域名格式
	*/
	function fn_is_domain($domain){
		if(preg_match("/^([0-9a-z\-]{1,}\.)?[0-9a-z\-]{2,}\.([0-9a-z\-]{2,}\.)?[a-z]{2,}$/i", $domain))	{
			return true;
		}else{
			return false;
		}
	}

	/**获取网页内容
	*/
	function fn_get_content($url){
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

	/**
	*/
	function fn_keywordsinfo($domain, $bot, $pn, $keys, $v, $output, $rn) {
		global $ROBOT;
		
		if(!array_key_exists($bot, $ROBOT)){
			return 'Invalid Robot';
		}
		
		$content = fn_get_content($ROBOT[$bot]['site_url']);
		
		if( empty($content) ){ 
			return '信息抓取失败';
		}
		
		$datecon = $listcon = array();
		if($bot == "baidu"){
			preg_match_all(REG_KW_BAIDU_LIST, $content, $arr);		//list内容
			$listcon = $arr[1];
			
			preg_match_all(REG_KW_BAIDU_DATE, $arr[1][0], $arr1);		//域名+日期部分（情况1）
			preg_match_all(REG_KW_BAIDU_DATE2, $arr[1][0], $arr2);		//域名+日期部分（情况2）
			preg_match_all(REG_KW_BAIDU_DATE3, $arr[1][0], $arr3);		//域名+日期部分（情况3）
			preg_match_all(REG_KW_BAIDU_DATE4, $arr[1][0], $arr4);		//域名+日期部分（情况4）
			$datecon = array_merge($arr1[1], $arr2[1], $arr3[1], $arr4[1]);
		}
		else{
			$row = "/<li class=g(.*)?>(.*)<\/li>/Uis";
			$key = "/<em>(.*)<em>/Uis";
			preg_match_all($row, $content, $arr1);		//list内容
			preg_match_all($key, $content, $arr2);		//域名+日期部分
			
			$listcon = $arr1[2];
			$datecon = $arr2[1];
		}
		
		
		$domain2 = ( 'www.' === substr($domain, 0, 4) ) ? substr($domain, 4):$domain;
		$kw = array();
		
		for($i=0; $i<sizeof($datecon); $i++){
			$datecon[$i] = str_replace("</b>", "", $datecon[$i]);
			$arr[$i] = explode("/", $datecon[$i]);
			
			if( false != strpos($arr[$i][0], $domain2, 0) ){
				$kw[$i] = $datecon[$i];
			}
		}
		
		$site_info = '';
		if(@preg_match($ROBOT[$bot]['site_pattern'], $content, $arr)){
			$site_info = $arr[1];
		}
		
		// foreach($kw as $key=>$val){
			// $kws .= "第<font color=red> ".($key+1+$pn)." </font>个出现<br/>".$val;
		// }
		
		// $domain1 = "keys.php?domain=".$domain."&keys=".$output."&val=".$v."&rn=".$rn;
		// $cons = "排名：<a href=".$domain1."&pn=0>1-".$rn."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*1).">".(($rn*1)+1)."-".($rn*2)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*2).">".(($rn*2)+1)."-".($rn*3)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*3).">".(($rn*3)+1)."-".($rn*4)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*4).">".(($rn*4)+1)."-".($rn*5)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*5).">".(($rn*5)+1)."-".($rn*6)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*6).">".(($rn*6)+1)."-".($rn*7)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*7).">".(($rn*7)+1)."-".($rn*8)."</a>";
		// $deta = "<font color=red>关键字</font> ".$keys." <font color=red>在网站</font> ".$domain." <font color=red>的</font> ".$bot." <font color=red>收录结果</font> ".($pn+1)."-".($pn+$rn)." <font color=red>名中有</font> ".sizeof($kw)." <font color=red>条记录</font>";
		
		// return $text = $cons."<br/>".$deta."<br/>".$kws;
		return array(
			"engine" => $bot,
			"url" => $ROBOT[$bot]['site_url'],
			"siteinfo" => $site_info,
			"domain" => $domain,
			"keyword" => $keys,
			"datecon" => $datecon,
			"pagenum" => $pn,
			"rownum" => $rn,
			"res" => $kw
		);
	}

	/**覆盖查询域名缓存文件
	*/
	function writeover($filename, $data, $method="rb+", $iflock=1, $chmod=1) {
		touch($filename);
		$handle=fopen($filename,$method);
		if ($iflock) {
			flock($handle,LOCK_EX);
		}
		fwrite($handle,$data);
		if ($method=="rb+") ftruncate($handle,strlen($data));
		fclose($handle);
		$chmod && @chmod($filename,0777);
	}

	/**组织查询域名缓存结构
	*/
	function fn_vvarexport($input,$t=null){
		$output = '';
		if (is_array($input)) {
			$output .= "array(\r\n";
			foreach ($input as $key => $value) {
				$output .= $t."\t".fn_vvarexport($key,$t."\t").' => '.fn_vvarexport($value,$t."\t");
				$output .= ",\r\n";
			}
			$output .= $t.')';
		} elseif (is_string($input)) {
			$output .= "'".str_replace(array("\\","'"),array("\\\\","\'"),$input)."'";
		} elseif (is_int($input) || is_double($input)) {
			$output .= "'".(string)$input."'";
		} elseif (is_bool($input)) {
			$output .= $input ? 'true' : 'false';
		} else {
			$output .= 'NULL';
		}
		return $output;
	}

	/**查询域名缓存处理
	*/
	function fn_filehave($urls, $url){
		if($url != ''){
			if(count($urls) == 0){
				$urls = array();
				$urls[0] = $url;
			}
			array_unshift($urls,$url);
			$urls = array_unique($urls);
			if(count($urls)>50){
				array_splice($urls,50);
			}
			return $urls;
		}
	}

	/**查询域名不缓存处理
	*/
	function fn_fileno($url){
		if($url != ''){
			$urls = array();
			$urls[0] = $url;
			return $urls;
		}
	}

?>
