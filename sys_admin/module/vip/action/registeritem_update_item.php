<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	$db = new DB("dacms");
	
	$db->update( "alter table web_vip change ". $_POST["vr_field1"] ." ". $_POST["vr_field2"] ." ". $_POST["vr_type"] ." not Null comment '".$_POST["vr_name"] ."'" );
	
	$sql = "update web_vipregister set 
	vr_name=:vr_name, 
	vr_field=:vr_field2, 
	vr_sort=:vr_sort, 
	vr_ismust=:vr_ismust, 
	vr_type=:vr_type, 
	vr_issys=:vr_issys, 
	vr_status=:vr_status, 
	vr_items=:vr_items 
	where vr_id=:vr_id ";
	
	$db->param(":vr_id", $_POST["vr_id"]);
	$db->param(":vr_name", $_POST["vr_name"]);
	// $db->param(":vr_field1", $_POST["vr_field1"]);
	$db->param(":vr_field2", $_POST["vr_field2"]);
	$db->param(":vr_sort", $_POST["vr_sort"]);
	$db->param(":vr_ismust", $_POST["vr_ismust"]);
	$db->param(":vr_type", $_POST["vr_type"]);
	$db->param(":vr_issys", 0);
	$db->param(":vr_status", $_POST["vr_status"]);
	$db->param(":vr_items", $_POST["vr_items"]);
	$res = $db->update($sql);
	
	
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>