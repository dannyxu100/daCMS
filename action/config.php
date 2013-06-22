<?php
	// error_reporting(0);
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/smarty/Smarty.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	
	/*** 网站基本配置信息常量 ***/
	$db = new DB("dacms");
	$sql = "select * from web_config";
	$site = $db->getone($sql);
	$db->close();
	
	define("WC_NAME", $site["c_name"]);
	define("WC_COMPANY", $site["c_company"]);
	define("WC_ADDRESS", $site["c_address"]);
	define("WC_USER", $site["c_user"]);
	define("WC_PHONE", $site["c_phone"]);
	define("WC_TELEPHONE", $site["c_telephone"]);
	define("WC_EMAIL", $site["c_email"]);
	define("WC_FAX", $site["c_fax"]);
	define("WC_ZIPCODE", $site["c_zipcode"]);
	define("WC_WEBSITE", $site["c_website"]);
	define("WC_IMG", $site["c_img"]);
	define("WC_ICP", $site["c_icp"]);
	define("WC_KEYWORDS", $site["c_keywords"]);
	define("WC_DESCRIPTION", $site["c_description"]);
	define("WC_PUSHEMAIL", $site["c_pushemail"]);
	define("WC_PUSHPWD", $site["c_pushpwd"]);
	define("WC_ISSTATIC", $site["c_isstatic"]);
	define("WC_REMARK", $site["c_remark"]);
	
	
	/*** 初始化smarty引擎 **/
	$rootdir = rtrim($_SERVER['DOCUMENT_ROOT'],"/");
	$smarty = new Smarty();
	$smarty->template_dir = $rootdir."/web/";
	$smarty->compile_dir = $rootdir."/web_template_c/";
	$smarty->config_dir = $rootdir."/smarty_config/";
	$smarty->cache_dir = $rootdir."/smarty_cache/"; 
	$smarty->caching = false;
	
	
	/*** 伪静态处理 **/
	fn_urlstatic();
	
	/*** smarty注册函数 **/
	$smarty->registerPlugin("function", "fn_urlstatic", "fn_urlstatic");
	$smarty->registerPlugin("function", "fn_title", "fn_title");
	$smarty->registerPlugin("function", "fn_keywords", "fn_keywords");
	$smarty->registerPlugin("function", "fn_description", "fn_description");
	
	
	
	$smarty->assign('sys', "daCMS");
?>