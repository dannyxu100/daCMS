<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$db = new DB("dacms");
	$db->param(":itid", $_POST["itid"]);
	$db->param(":iname", $_POST["iname"]);
	$db->param(":ivalue", $_POST["ivalue"]);
	$db->param(":isort", $_POST["isort"]);
	$db->param(":iremark", $_POST["iremark"]);
	$res = $db->insert("insert into sys_item(i_itid, i_name, i_value, i_sort, i_remark) values(:itid, :iname, :ivalue, :isort, :iremark)");
	
	$db->close();
	// Log::out($db->geterror());

	echo $res?$res:"FALSE";
?>