<?php
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/footer.php";
	
	
	$pid = $_GET["pid"];
	
	$db = new DB("dacms");
	
	$sql = "select * from web_product where p_id=:pid";
	$db->param(":pid", $pid);
	$product = $db->getone($sql);

	$sql = "select * from web_producttype where pt_pid=:ptid order by pt_sort";
	$db->param(":ptid", $product["p_ptid"]);
	$producttype = $db->getlist($sql);
	$db->close();
	
	$smarty->assign('product', $product);
	$smarty->assign('producttype', $producttype);
	
	$smarty->display('productdetail.htm');

	
?>