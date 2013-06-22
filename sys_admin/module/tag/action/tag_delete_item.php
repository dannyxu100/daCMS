<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":tagid", $_POST["tagid"]);
	$res = $db->delete( "delete from web_tag where t_id=:tagid");
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>