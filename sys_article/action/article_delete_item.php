<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":nid", $_POST["nid"]);
	$res = $db->delete( "delete from web_nav where n_id=:nid");
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>