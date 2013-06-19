<?php
define('IN_SEO', TRUE);
header("Content-Type:text/html;charset=gb2312");
require 'function.php';
error_reporting(E_ERROR);
set_time_limit(0);
isset($_SERVER['HTTP_REFERER']) or exit('Invalid Request');
preg_match("/".$_SERVER['HTTP_HOST']."/i", $_SERVER['HTTP_REFERER']) or exit('Access Denied');
$ROBOT['site_url']     = 'http://www.baidu.com/s?wd=site%3A';
$ROBOT['site_pattern'] = "/找到相关网页(.*)篇/";
@extract($_POST);
$domain = $domain?$domain:'chinaccnet.com';
@require_once('../cache.php');
if(file_exists("../cache/cache.php")){
	@require_once("../cache/cache.php");
    $urls = filehave($urls,$domain);
}else{
	$urls = fileno($domain);
}
writeover("../cache/cache.php","<?php\r\n\$urls=".vvar_export($urls).";\r\n?>");
isset($domain) or exit('非法操作！');
$domain = strtolower($domain);
is_domain($domain) or exit('请输入正确的域名！');
$result = get_seo_info($domain,$selects,$pn);
echo $result;
?>