<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/footer.php";
	
	$atid = $_GET["atid"];
	
	$db = new DB("dacms");
	
	$sql = "select * from web_articletype where at_id=:atid";
	$db->param(":atid", $atid);
	$articletype = $db->getone($sql);
	
	
	$sql = "select * from web_articletype where at_pid=:atid order by at_sort";
	$db->param(":atid", $atid);
	$articletype2 = $db->getlist($sql);
	
	$sql = "select * from web_article where a_atid=:atid order by a_id desc limit 20";
	$db->param(":atid", $atid);
	$articleset = $db->getlist($sql);
	$db->close();

	

	$smarty->assign('articletype', $articletype);
	$smarty->assign('articletype2', $articletype2);
	$smarty->assign('articleset', $articleset);
	
	$smarty->display('prolist.htm');

	
?>