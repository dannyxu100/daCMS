<?php
@include('../global.php');
@include('pageft.php');
function get_seo_info($domain,$selects,$pn){	
	global $ROBOT;	
	$content   = '';
	$site_info = '';	
    $domain    = $domain."&lm=".$selects;
	$content1  = get_content($ROBOT['site_url'].$domain."&pn=".$pn);
	if(empty($content1)) return 'Unkown Error...';
	$table   =  "/<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"(.*)\">(.*)<\/table><br>/is";
	preg_match($table,$content1,$arr);
	$con = $arr[0];
	if(preg_match($ROBOT['site_pattern'], $content1, $matches)) $site_info = $matches[1];	
	preg_match_all('/\d/',$site_info,$dd);
	$count = '';
	for($m=0;$m<sizeof($dd[0]);$m++){
		$count .= $dd[0][$m];
	}
	$firstpage = 0;
	$lastpage  = (ceil($count/10)-1)*10;
	$nextpage  = ($pn==$lastpage?$lastpage:$pn+10);
	$pregpage  = ($pn ==$firstpage?0:$pn-10);
	if($count>10){
	   $co  = get_content($ROBOT['site_url'].$domain."&pn=".$count);
	   $di  = "/<div class=\"p\">(.*)<\/div>/Uis";
	   preg_match($di,$co,$art);
	   preg_match_all('/[\d]+/',$art[0],$www);	  
	   $con3 = page_slice((max($www[0])+20),($pn/10+1),10,'baidu.php?domain='.$domain);
	}
	return $con3.'<table><tr><td>百度总收录: <a href="'.$ROBOT['site_url'].$domain.'" target="_blank">'.$site_info.'</a>个页面具体页面如下：<br/><hr/></td></tr><tr><td>'.$con.'</td></tr></table>'.$con3;
}
?>