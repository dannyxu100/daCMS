<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$sql = "select * from web_product where p_id=:pid";
	
	$db = new DB("dacms");
	$db->param(":pid",$_POST["pid"]);
	$set = $db->getone($sql);
	
	$db->close();
	
	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>