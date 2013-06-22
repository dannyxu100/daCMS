<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	$db = new DB("dacms");
	
	$db->param(":vr_id", $_POST["vr_id"]);
	$item = $db->getone("select * from web_vipregister where vr_id=:vr_id ");
	$res = $db->delete("delete from web_vipregister where vr_id=:vr_id ");
	
	if( 1 <= $res ){
		$db->delete("alter table web_vip drop column ".$item["vr_field"] );
	}
	
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>