<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":itid", $_POST["itid"]);
	$res = $db->delete( "delete from sys_itemtype where it_id=:itid");
	//echo $db->error_message;
	$db->close();
	
	echo $res?$res:"FALSE";
?>