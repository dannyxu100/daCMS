<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":type", $_POST["tagtype"]);
	$db->param(":name", $_POST["tagname"]);
	$res = $db->insert("insert into web_tag(t_type, t_name) values(:type, :name)");
	
	$db->close();
	// $log = new Log();
	// $log->write($set.time());

	echo $res?$res:"FALSE";
?>