<?php
	// error_reporting(0);
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	
	$sql = "select * from web_config";
	
	$db = new DB("dacms");
	$webconfig = $db->getlist($sql);
	
	$db->close();
	
	$smarty->assign('webconfig', $webconfig);
	$smarty->display('index.htm');


?>