<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$db = new DB("dacms");
	$sql = "update web_tag set t_color=:color where t_id=:tid ";
	$db->param(":color", $_POST["color"]);
	$db->param(":tid", $_POST["tid"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out(urldecode($_POST["acontent"]));
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>