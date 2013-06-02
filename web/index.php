<?php
	// error_reporting(0);
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/plugin/smarty/Smarty.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$sql = "select * from web_nav";
	
	$db = new DB("dacms");
	$navset = $db->getlist($sql);
	
	$db->close();
	// if(is_array($set) && 0<count($set)){
		// echo json_encode($set);
	// }
	// else{
		// echo "FALSE";
	// }
	$sql = "select * from web_config";
	
	$db = new DB("dacms");
	$webconfig = $db->getlist($sql);
	
	$db->close();
	
	$rootdir = rtrim($_SERVER['DOCUMENT_ROOT'],"/");
	$smarty = new Smarty();
	$smarty->template_dir = $rootdir."/web/_templates/";
	$smarty->compile_dir = $rootdir."/web/_templates_c/";
	$smarty->config_dir = $rootdir."/web/_config/";
	$smarty->cache_dir = $rootdir."/web/_cache/"; 
	$smarty->caching = false;
	
	$smarty->assign('webconfig', $webconfig);
	$smarty->assign('navset', $navset);
	$smarty->display($rootdir.'/web/_templates/index.htm');


?>