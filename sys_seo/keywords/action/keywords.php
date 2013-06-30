<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	require '../../action/fn.php';

	set_time_limit(300);		//超时设置5分钟
	//域名
	$domain = isset($_POST['domain']) ? $_POST['domain'] : ( isset($_GET['domain']) ? $_GET['domain'] : "" );
	//关键词
	$keys = isset($_POST['keys']) ? $_POST['keys'] : ( isset($_GET['keys']) ? $_GET['keys'] :" ");
	//搜索引擎
	$engine = isset($_POST['engine']) ? $_POST['engine'] : ( isset($_GET['engine']) ? $_GET['engine'] : 1);

	//页数
	$pn = intval( isset($_POST['pn']) ? $_POST['pn'] : ( isset($_GET['pn']) ? $_GET['pn'] : 0 ));
	//每页条数
	$rn = intval( isset($_POST['rn']) ? $_POST['rn'] : ( isset($_GET['rn']) ? $_GET['rn'] : 10 ));
	
	$keys = preg_replace("/,| |　|，|，]/is", ",", trim($keys));		//多关键词","分隔
	$keysa = explode(",", $keys);
	$output = '';
	$result = array();
	
	
	for( $k=0; $k<count($keysa); $k++ ){
		if( !preg_match('/(\w).*/', $keysa[$k], $arrk) ){	//过滤特殊符号
			$output = urlencode($keysa[$k]);				//转码
			
			// $tab_text = str_split($keysa[$k]);
			// $output = '';
			// foreach ($tab_text as $id=>$char){				//转码
			  // $hex = dechex(ord($char));
			  // $output.= '%' . $hex;
			// }
		}
		else{
			$output = $keysa[$k];
		}

		if($engine == 1){
			$ROBOT['baidu']['site_url'] = 'http://www.baidu.com/s?wd='.$output."&rn=".$rn."&pn=".$pn;
			$job = "baidu";
		}
		else{ 
			$ROBOT['google']['site_url'] = 'http://www.google.com.hk/search?hl=zh-CN&q='.$output."&num=".$rn."&start=".$pn;
			$job = "google";
		}

		$domain = strtolower($domain);
		
		if($domain){
			if( fn_is_domain($domain) ){
				$obj = fn_keywordsinfo($domain, $job, $pn, $keysa[$k], $engine, $output, $rn);
				array_push($result, $obj);
			}
			else{
				array_push($result, false);
			}
			
		}
	}

	set_time_limit(30);

	//缓存文件处理
	if( $domain ){
		if(file_exists("../../cache/cache.php")){
			@require_once("../../cache/cache.php");
			$urls = fn_filehave($urls, $domain);
			
		}else{
			$urls = fn_fileno($domain);
		}
		writeover("../../cache/cache.php","<?php\r\n\$urls=".fn_vvarexport($urls).";\r\n?>");
	}
	
	$arrlast = array();
	
	//获取缓存
	if( !empty($urls) ){
		foreach ($urls as $key=>$v){
			array_push($arrlast, "<a href=http://".$urls[$key]." target=_blank>".$urls[$key]."</a>&nbsp;&nbsp;");
		}
	}
	
	$res = array(
		"result"=>$result,
		"keys"=>$keysa,
		"last"=>$arrlast				//记录集
	);
	
	echo json_encode($res);
	
?>