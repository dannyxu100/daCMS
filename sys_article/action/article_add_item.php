<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":pid", $_POST["pid"]);
	$db->param(":name", $_POST["name"]);
	$db->param(":level", isset($_POST["level"])?$_POST["level"]:1);
	$res = $db->insert("insert into web_nav(n_pid, n_name, n_level) values(:pid, :name, :level)");
	
	$db->close();
	// $log = new Log();
	// $log->write($set.time());

	echo $res?$res:"FALSE";
?>