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
	
	$smarty = new Smarty();
	$smarty->template_dir = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/_templates/default/";
	$smarty->compile_dir = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/_templates_c/default/";
	$smarty->config_dir = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/_config/default/";
	$smarty->cache_dir = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/_cache/default/"; 
	$smarty->caching = false;
	
	$smarty->assign('webconfig', $webconfig);
	$smarty->assign('navset', $navset);
	$smarty->display('index.htm');


?>