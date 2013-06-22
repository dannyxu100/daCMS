<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$sql = "select * from sys_collect where c_id=".$_POST["cid"];
	
	$db = new DB("dacms");
	$set = $db->getlist($sql);
	
	$db->close();
	
	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>