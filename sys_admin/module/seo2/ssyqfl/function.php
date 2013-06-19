<?php
@include_once('../global.php');
function get_seo_info($domain,$che){
	global $ROBOT;
	$che = explode(',',$che);
	$ch  = array_combine($che,$che);
	$content   = '';
	$site_info = '';
	$link_info = '';
	$jobs    = array();
	$jobs[1] = "baidu";
	$jobs[2] = "google";
	$jobs[3] = "yahoo";
	$jobs[4] = "vnet";
	$a = '<table border=1 width=100% bordercolordark=#FFFFFF cellspacing=0 cellpadding=0 bordercolorlight=#BBD7E6>	<tr bgcolor=#D8F0FC><td colspan=9>网址<a href=http://'.$domain.' target=_blank>http://'.$domain.'</a>在各大搜索引擎的反向链接查询结果</td></tr><tr><td>搜索引擎</td>';
for ($i = 1; $i <= sizeof($jobs); $i++) {
	if($ch[$i]){
		$a .= "<td>".$ROBOT[$jobs[$i]]['name']."</td>";
	}
}
$a .= "</tr><tr><td>收录数量</td>";
for ($i = 1; $i <= sizeof($jobs); $i++) {
	if($ch[$i]){
		eval('$__file__=__FILE__;');
		define('ROOT_PATH',$__file__ ? dirname($__file__).'/' : './');
		$content[$i] = get_content($ROBOT[$jobs[$i]]['site_url'].$domain);
		if($i == 3 || $i==4){
			require_once('require/chinese.php');
			$chs = new Chinese('utf-8','GB2312');
			$content[$i] = $chs->Convert($content[$i]);
		}
		$content[$i] = get_content($ROBOT[$jobs[$i]]['link_url'].$domain);
		if(empty($content[$i])) return 'Unkown Error...';
		if(preg_match($ROBOT[$jobs[$i]]['link_pattern'], $content[$i], $matches[$i])) $site_info[$i] = $matches[$i][1];		$site_info[$i] = $site_info[$i]?$site_info[$i]:'--';
		$a .= '<td><a href="'.$ROBOT[$jobs[$i]]['link_url'].$domain.'" target="_blank">'.$site_info[$i].'</a></td>';
	}
}
	$a .= "</tr><tr><td>相关查询</td><td colspan=4 align=left><a href=../ip/index.php?domain=".$domain." target=_blank>IP地址查询</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=../pr/pr.php?domain=".$domain." target=_blank>PR查询</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=../whois/index.php?domain=".$domain." target=_blank>域名Whois查询</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=http://alexa.chinaccnet.com target=_blank>Alexa排名查询</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=../friends/friends.php?domain=".$domain." target=_blank>友情链接查询</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=../friendlink/friendlink.php?domain=".$domain." target=_blank>友情链接IP查询</a></td></tr></table>";
	return $a;
}
?>