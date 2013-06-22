<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$db = new DB("dacms");
	$db->param(":itpid", $_POST["itpid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into sys_itemtype(it_pid, it_name) values(:itpid, :name)");
	
	$db->close();
	// $log = new Log();
	// $log->write($db->geterror());

	echo $res?$res:"FALSE";
?>