<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$db = new DB("dacms");
	
	$sql = "update web_vipregister set vr_ismust=:vr_ismust where vr_id=:vr_id ";
	
	$db->param(":vr_ismust", $_POST["vr_ismust"]);
	$db->param(":vr_id", $_POST["vr_id"]);
	$res = $db->update($sql);
	
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>