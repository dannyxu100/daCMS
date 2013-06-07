<?php
	// error_reporting(0);
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/config.php";
	
	$sql = "select * from web_nav";
	
	$db = new DB("dacms");
	$navset = $db->getlist($sql);
	
	$db->close();
	
	$smarty->assign('navset', $navset);

?>