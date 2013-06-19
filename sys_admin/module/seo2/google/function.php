<?php
@include_once('../global.php');
function get_seo_info($domain,$selects,$start){
	global $ROBOT;	
	$site_info = '';
    $domain    = $domain."&tbs=qdr:".$selects;   
	$content1  = get_content($ROBOT['site_url'].$domain."&start=".$start);	
	if(empty($content1)) return 'Unkown Error...';
	$li  =  "/<li class=g>(.*)<\/span><\/span><\/div>/is";
	preg_match($li,$content1,$arr);	
	$con = $arr[0];
	if(preg_match($ROBOT['site_pattern'], $content1, $matches)) $site_info = $matches[1];	
	preg_match_all('/\d/',$site_info,$dd);	
	$count = '';	
	for($m=0;$m<sizeof($dd[0]);$m++){
		$count .= $dd[0][$m];
	}	
	if($count>10){
	   $con3 = "<a href=google.php?domain=".$domain."&start=0>[1]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=10>[2]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=20>[3]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=30>[4]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=40>[5]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=50>[6]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=60>[7]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=70>[8]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=80>[9]</a>&nbsp;&nbsp;<a href=google.php?domain=".$domain."&start=90>[10]</a>";
	}
	$site_info = $site_info?$site_info:'0';
	return $con3.'<br/>¹È¸èÕÒµ½: <a href="'.$ROBOT['site_url'].$domain.'" target="_blank">'.$site_info.'</a>Ìõ¼ÇÂ¼<br/><hr/>'.$con.'<br/>'.$con3;
}
?>