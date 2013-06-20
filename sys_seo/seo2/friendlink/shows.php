<?php
header("content-Type: text/html; charset=GB2312");
define('IN_SEO','IN_SEO');
@include_once('qqwry.php');
$action = $_GET['action'];
$lurl   = $_GET['lurl'];
$domain = $_GET['domain'];
$QQWry  = new QQWry;
function get_real_ip(){
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
				$ip = $ips[$i];
				break;
			}
		}
	}
	return $ip;
}
function is_ip($str) {
	$ip = explode(".", $str);
	if (count($ip)<4 || count($ip)>4) return 0;
	foreach($ip as $ip_addr) {
		if ( !is_numeric($ip_addr) ) return 0;
		if ( $ip_addr<0 || $ip_addr>255 ) return 0;
	}
	return 1;
}
$ip=$inip=$_POST['ip']?$_POST['ip']:$lurl;
preg_match('/((\w|-)+\.)+[a-z]{2,4}/i',$ip) ? $ip=gethostbyname($ip) : $ip;
if(is_ip($ip)){
	$ifErr=$QQWry->QQWry($ip);
	$ipp1 = $ip;
	$ipp2 = $QQWry->Country.$QQWry->Local;
}
if($action == 'ips'){
	echo $ipp1;
}elseif($action == 'wulidizhi'){
	echo $ipp2;
}
?>