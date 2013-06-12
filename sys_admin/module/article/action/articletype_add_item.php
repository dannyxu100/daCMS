<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":pid", $_POST["pid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into web_articletype(at_pid, at_name, at_listnum, at_style) values(:pid, :name, 10, 'LIST')");
	
	$db->close();
	// $log = new Log();
	// $log->write($set.time());

	echo $res?$res:"FALSE";
?>