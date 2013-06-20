<?php
header("content-Type: text/html; charset=GB2312");
eval('$__file__=__FILE__;');
define('ROOT_PATH',$__file__ ? dirname($__file__).'/' : './');
$action = $_GET['action'];
$lurl   = $_GET['lurl'];
$domain = $_GET['domain'];
if($action == 'baidushoulu'){
	$url          = "http://www.baidu.com/s?wd=site%3A".$lurl;	
	$cnt3=0;
    while($cnt3 < 10 && ($content=@file_get_contents($url))===FALSE){$cnt3++;}
	$site_pattern = "/找到相关网页(.*)篇/";
	preg_match($site_pattern,$content,$arrs);
	echo "<a href=\"$url\" target=_blank>".$arrs[1]."</a>";
}elseif($action == 'prs'){
	@require_once('../pr/prfunction.php');
	echo GetPR($lurl);
}elseif($action == 'baidukuaizhao'){
	$baids   = "/<font color=\"#008000\">(.*)<\/font> - <a href=\"(.*)\"  target=\"_blank\"  class=\"m\">百度快照<\/a>/Usi";
	$times   = "/\d{4}-\d{1,2}-\d{1,2}/";
	$cnt2=0;
    while($cnt2 < 10 && ($content=@file_get_contents("http://www.baidu.com/s?wd=site%3A".$lurl))===FALSE){$cnt2++;}
	preg_match($baids,$content,$bs1);
	preg_match($times,$bs1[0],$bs2);
	$bs2= $bs2[0]?$bs2[0]:'无百度快照';
	echo "<a href=\"http://www.baidu.com/s?wd=".$lurl."\" target=_blank>".$bs2."</a>";
}elseif($action == 'fanlianjie'){	
	$cnt=0;
    while($cnt < 10 && ($content=@file_get_contents("http://".$lurl))===FALSE){$cnt++;}
	$charset  = "/charset=(.*)/";
	preg_match($charset,$content,$charsetarr);
	$charset2 = strtolower(substr($charsetarr[1],0,2));
	if($charset2 != 'gb'){
		require_once('require/chinese.php');
		$chs     = new Chinese('utf-8','GB2312');
		$content = $chs->Convert($content);
	}
	if(!$content){
		echo "对方首页可能无法访问";
	}else{
		$pat1   = "/<a(.*?)<\/a>/i";
		preg_match_all($pat1, $content, $array);
		$urlsname = $array[0];
		for($i=0;$i<sizeof($urlsname);$i++){
			$pq = '/ href=["\']?([^>"\' ]+)["\']?\s*[^>]*>(.*)<\/a>/si';
			preg_match($pq,$urlsname[$i],$b);
			if($b[2] && strpos($b[1],'javascript') === false){
				if(strpos($b[1],'http') === false){
					$b[1] = 'http://'.$ulink.'/'.$b[1];
				}
				if(strpos($b[1],"http://www.".$domain) !==false ||strpos($b[1],"http://".$domain) !== false){
					if(strpos($b[2],'img') !== false){
						$b[2] = '图片链接';
					}
					$name = strlen($b[2])>8 ? substr($b[2],0,8).'……' : $b[2];
				}
			}
		}
		if($name){
			echo "有反链 链接词：<a href=http://".$domain." target=_blank>".$name."</a>";
		}else{
			echo "无反链";
		}
	}
}
?>