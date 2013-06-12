<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":ptid", $_POST["ptid"]);
	$res = $db->delete( "delete from web_producttype where pt_id=:ptid");
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>