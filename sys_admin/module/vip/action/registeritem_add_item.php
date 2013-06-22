<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	$db = new DB("dacms");
	
	if( 0 >= $db->getcount("select * from web_vipregister where vr_field='". $_POST["vr_field"] ."'") ){
		$db->insert( "alter table web_vip add ". $_POST["vr_field"] ." ". $_POST["vr_type"] ." not Null comment '".$_POST["vr_name"] ."'" );
		
		$sql = "insert into web_vipregister(vr_name, vr_field, vr_sort, vr_ismust, vr_type, vr_issys, vr_status, vr_items) 
		values(:vr_name, :vr_field, :vr_sort, :vr_ismust, :vr_type, :vr_issys, :vr_status, :vr_items)";
		
		$db->param(":vr_name", $_POST["vr_name"]);
		$db->param(":vr_field", $_POST["vr_field"]);
		$db->param(":vr_sort", $_POST["vr_sort"]);
		$db->param(":vr_ismust", $_POST["vr_ismust"]);
		$db->param(":vr_type", $_POST["vr_type"]);
		$db->param(":vr_issys", 0);
		$db->param(":vr_status", $_POST["vr_status"]);
		$db->param(":vr_items", $_POST["vr_items"]);
		$res = $db->insert($sql);
	}
	
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>