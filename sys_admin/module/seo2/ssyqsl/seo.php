<?php
define('IN_SEO', TRUE);
error_reporting(E_ERROR);
set_time_limit(0);
isset($_SERVER['HTTP_REFERER']) or exit('Invalid Request');
preg_match("/".$_SERVER['HTTP_HOST']."/i", $_SERVER['HTTP_REFERER']) or exit('Access Denied');
header("Content-Type:text/html;charset=gb2312");
include '../robot.php';
require 'function.php';
@extract($_POST);
$domain = $domain?$domain:'chinaccnet.com';
$domain = strtolower($domain);
is_domain($domain) or exit;
$result = '';
if($che){
 $result = get_seo_info($domain,$che);
}
if($domain){
	@require_once('../cache.php');
	if(file_exists("../cache/cache.php")){
		@require_once("../cache/cache.php");
		$urls = filehave($urls,$domain);
	}else{
	$urls = fileno($domain);
	}
	writeover("../cache/cache.php","<?php\r\n\$urls=".vvar_export($urls).";\r\n?>");
}
echo $result;
?>