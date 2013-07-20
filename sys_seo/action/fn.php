<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Snoopy.class.php";
	
	/****************  关键词排名查询-正则常量 **********************/
	define("REG_KW_BAIDU_LIST", "/<div id=\"content_left\">(.*)<p id=\"page\" >/Uis");		//list内容
	define("REG_KW_BAIDU_ROW", "/<table(.*)<\/table>/Uis");									//行(用于累计排名)
	define("REG_KW_BAIDU_HIGHLIGHT", "/<font color=#CC0000>(.*)<\/font>/Uis");				//高亮关键词
	define("REG_KW_BAIDU_TITLE", "/<h3 class=\"t\">.*<a.*href=\"(.*)\".*>(.*)<\/a>.*<\/h3>/Uis");	//标题
	define("REG_KW_BAIDU_DATE1", "/<span class=\"g\">(.*)<\/span>/Uis");					//域名+日期部分（百度快照）
	
	define("REG_KW_BAIDU_DATE2", "/<span class=\"op_wiseapp_showurl\">(.*)<\/span>/Uis");	//域名+日期部分（非百度快照）
	define("REG_KW_BAIDU_DATE3", "/<span class=\"c-showurl\">(.*)<\/span>/Uis");			//域名+日期部分（非百度快照）
	define("REG_KW_BAIDU_DATE4", "/<font color=\"#008000\">(.*)<\/font>/Uis");				//域名+日期部分（非百度快照）
	define("REG_KW_BAIDU_DATE5", "/<span style=\"color:#008000\">(.*)<\/span>/Uis");		//域名+日期部分（非百度快照）
	define("REG_KW_BAIDU_BOLD", "/<(b|\/b)>/Uis");											//粗体字标签
	define("REG_KW_BAIDU_EM", "/<(em|\/em)>/Uis");											//关键字标签
	
	
	// define("REG_KW_BAIDU_TITLE", "/<h3 class=\"t\"><a(.*)href=\"(.*)\"(.*)>(.*)<\/a><\/h3>/Uis");	//标题	
	/**验证域名格式
	*/
	function fn_is_domain($domain){
		if(preg_match("/^([0-9a-z\-]{1,}\.)?[0-9a-z\-]{2,}\.([0-9a-z\-]{2,}\.)?[a-z]{2,}$/i", $domain))	{
			return true;
		}else{
			return false;
		}
	}
	
	/**随机字母、数字串
	*/
	function randchar( $len=10 ){
		$str='abcdefghijklmnopqrstuvwxyz1234567890';
		
		$rndstr ="";					//用来存放生成的随机字符串 
		for($i=0;$i<$len;$i++) 
		{ 
			$num=rand(0,35); 
			$rndstr.=$str[$num]; 
		} 
		return $rndstr; 
	}
	
	/**随机IP
	*/
	function randip(){
		$ip_long = array(
			array('607649792', '608174079'), //36.56.0.0-36.63.255.255
			array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
			array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
			array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
			array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
			array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
			array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
			array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
			array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
			array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
		);
		$rand_key = mt_rand(0, 9);
		$ip	= long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
		
		return $ip;
	}
	
	/**获取网页内容
	*/
	function fn_get_content($url){
		$snoopy = new Snoopy ;
		$snoopy->proxy_host ="http://www."+ randchar() +".com";		//设置代理
		$snoopy->proxy_port = "80";
		$snoopy->rawheaders["X_FORWARDED_FOR"] = randip();			//伪装ip
		// $snoopy->referer = "http://www.aibx.net";					//伪装来源页地址 http_referer
		// $snoopy->rawheaders["Pragma"] = "no-cache";					//cache 的http头信息
		// $snoopy->agent = "(compatible; MSIE 4.01; MSN 2.5; AOL 4.0; Windows 98)";		//模拟浏览器
		$snoopy->agent = "(compatible; Googlebot/2.1; +http://www.google.com/bot.html)";	//模拟爬虫(避免IP被屏)
		$snoopy->fetch( $url );
		
		$content = $snoopy->results;
		
		$encode = mb_detect_encoding($content, array("ASCII", "GB2312", "GBK", "UTF-8", "BIG5")); 		//判断编码方式
		$content = iconv( $encode, 'UTF-8', $content );
		
		return $content;
		
		
		/***** 下面代码弃用 *****/
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
		
		$encode = mb_detect_encoding($content, array("ASCII", "GB2312", "GBK", "UTF-8", "BIG5")); 		//判断编码方式
		$content = iconv( $encode, 'UTF-8', $content );
		
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
		
		$domainNoWWW = ( 'www.' === substr($domain, 0, 4) ) ? substr($domain, 4):$domain;
		
		$items = array();
		
		if($bot == "baidu"){
			preg_match_all(REG_KW_BAIDU_LIST, $content, $arr);			//list内容
			if( !isset($arr[1][0]) ){
				// Log::out($keys."--------Catch Content Error!");
				// Log::out($keys."--------".$content);
				return;
			}
			
			preg_match_all(REG_KW_BAIDU_ROW, $arr[1][0], $rows);		//行
			
			for($i=0; $i<count($rows[0]); $i++){
				preg_match_all(REG_KW_BAIDU_TITLE, $rows[0][$i], $arrtitle);	//标题
				preg_match_all(REG_KW_BAIDU_DATE1, $rows[0][$i], $arr1);		//域名+日期部分（百度快照）
				
				// preg_match_all(REG_KW_BAIDU_DATE2, $rows[0][$i], $arr2);	//域名+日期部分（非百度快照）
				// preg_match_all(REG_KW_BAIDU_DATE3, $rows[0][$i], $arr3);	//域名+日期部分（非百度快照）
				// preg_match_all(REG_KW_BAIDU_DATE4, $rows[0][$i], $arr4);	//域名+日期部分（非百度快照）
				// preg_match_all(REG_KW_BAIDU_DATE5, $rows[0][$i], $arr5);	//域名+日期部分（非百度快照）
				// $dateitem = array_merge($arr1[1], $arr2[1], $arr3[1], $arr4[1], $arr5[1]);
				
				// Log::out($i."---------------------------------------------------");
				// Log::out($arr1[1]);
				// Log::out($i."------------->".$arrtitle[2][0]);
				if( !isset($arr1[1]) || empty($arr1[1]) ) continue;
				if( !isset($arrtitle[1][0]) ) continue;
				
				/** 测试 非百度快照处理 **/
				// if( !isset($arr1[1]) || empty($arr1[1]) || !isset($arrtitle[1][0]) ){
					// $items[$i] = array(
						// "title" => preg_replace("/<.*>/Uis", "", $rows[0][$i]),		//去标签
						// "href" => "",
						// "date" => ""
					// );
					// continue;
				// }
				/** 测试 非百度快照处理 **/
				
				$title = $arrtitle[2][0];
				$title = preg_replace(REG_KW_BAIDU_EM, "", trim($title));		//去关键字标签、前后空格
				$href = $arrtitle[1][0];
				
				$dateitem = $arr1[1][0];
				$dateitem = preg_replace(REG_KW_BAIDU_BOLD, "", trim($dateitem));	//去粗体字标签、前后空格
				// Log::out($dateitem);
				
				$tmp = explode("/", $dateitem);
				// Log::out($i."------>".$tmp[0]);
				// Log::out($i."------>".(false !== strpos($tmp[0], $domain, 0)));
				// Log::out($arrtitle[4]);
				if( false !== strpos($tmp[0], $domain, 0) ){
					$items[$i] = array(
						"title" => $title,
						"href" => $href,
						"date" => $dateitem
						
					);
				}
			} 
			// Log::out($arr2[0]."-------".$arr2[1]);
			
		}
		else{
			$row = "/<li class=g(.*)?>(.*)<\/li>/Uis";
			$key = "/<em>(.*)<em>/Uis";
			preg_match_all($row, $content, $arr1);		//list内容
			preg_match_all($key, $content, $arr2);		//域名+日期部分
			
			$listcon = $arr1[2];
			$dateitem = $arr2[1];
		}
		
		$site_info = '';
		if(@preg_match($ROBOT[$bot]['site_pattern'], $content, $arr)){
			$site_info = $arr[1];
		}
		
		// $deta = "<font color=red>关键字</font> ".$keys." <font color=red>在网站</font> ".$domain." <font color=red>的</font> ".$bot." <font color=red>收录结果</font> ".($pn+1)."-".($pn+$rn)." <font color=red>名中有</font> ".sizeof($kw)." <font color=red>条记录</font>";
		
		return array(
			"engine" => $bot,
			"url" => $ROBOT[$bot]['site_url'],
			"siteinfo" => $site_info,
			"domain" => $domain,
			"domainNoWWW" => $domainNoWWW,
			"keyword" => $keys,
			// "rows" => $rows,
			"items" => $items,
			"pagenum" => $pn,
			"rownum" => $rn
			
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
