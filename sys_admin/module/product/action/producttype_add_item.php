<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	// error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":pid", $_POST["pid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into web_producttype(pt_pid, pt_name, pt_listnum, pt_style) values(:pid, :name, 10, 'LIST')");
	
	$db->close();
	// $log = new Log();
	// $log->write($set.time());

	echo $res?$res:"FALSE";
?>