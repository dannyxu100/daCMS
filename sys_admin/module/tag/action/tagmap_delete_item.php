<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":type", $_POST["type"]);
	$db->param(":tid", $_POST["tid"]);
	$db->param(":id", $_POST["id"]);
	$res = $db->delete( "delete from web_tagmap where tm_ttype=:type and tm_tid=:tid and tm_cid=:id");
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>