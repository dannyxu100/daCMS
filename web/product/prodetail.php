<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/footer.php";
	
	$aid = $_GET["aid"];
	
	$db = new DB("dacms");
	
	$sql = "select * from web_article where a_id=:aid";
	$db->param(":aid", $aid);
	$article = $db->getone($sql);

	$sql = "select * from web_articletype where at_pid=:atid order by at_sort";
	$db->param(":atid", $article["a_atid"]);
	$articletype = $db->getlist($sql);
	$db->close();
	
	$smarty->assign('article', $article);
	$smarty->assign('articletype', $articletype);
	
	$smarty->display('prodetail.htm');

	
?>