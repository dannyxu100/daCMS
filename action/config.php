<?php
	// error_reporting(0);
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/plugin/smarty/Smarty.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$rootdir = rtrim($_SERVER['DOCUMENT_ROOT'],"/");
	$smarty = new Smarty();
	$smarty->template_dir = $rootdir."/web/";
	$smarty->compile_dir = $rootdir."/web_template_c/";
	$smarty->config_dir = $rootdir."/smarty_config/";
	$smarty->cache_dir = $rootdir."/smarty_cache/"; 
	$smarty->caching = false;
	
	
	$sql = "select * from web_config";
	$db = new DB("dacms");
	$webconfig = $db->getone($sql);
	$db->close();
	
	$smarty->assign('webconfig', $webconfig);
?>