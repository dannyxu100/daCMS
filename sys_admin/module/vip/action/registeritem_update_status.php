<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$db = new DB("dacms");
	
	$sql = "update web_vipregister set vr_status=:vr_status where vr_id=:vr_id ";
	
	$db->param(":vr_status", $_POST["vr_status"]);
	$db->param(":vr_id", $_POST["vr_id"]);
	$res = $db->update($sql);
	
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>