<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	// error_reporting(-1);

	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$db = new DB("dacms");
	$db->param(":c_commentid", $_POST["c_id"]);
	$db->param(":c_cid", $_POST["c_cid"]);
	$db->param(":c_content", $_POST["c_content"]);
	$db->param(":c_type", $_POST["c_type"]);
	$db->param(":c_puid", fn_getcookie("puid"));
	$db->param(":c_date", $now);
	
	$res = $db->insert("insert into web_comment(c_type, c_cid, c_puid, c_content, c_ispass, c_isrevert, c_commentid, c_date) 
	values(:c_type, :c_cid, :c_puid, :c_content, 1, 1, :c_commentid, :c_date)");
	
	$db->close();
	// $log = new Log();
	// $log->write($set.time());

	echo $res?$res:"FALSE";
?>