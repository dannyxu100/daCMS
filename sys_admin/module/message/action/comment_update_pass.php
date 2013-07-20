<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$c_id = $_POST["c_id"];
	$c_ispass = $_POST["c_ispass"];
	
	$db = new DB("dacms");
	$sql = "update web_comment set c_ispass=:c_ispass where c_id=:c_id";
	
	$db->param(":c_ispass", $_POST["c_ispass"]);
	$db->param(":c_id", $_POST["c_id"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>