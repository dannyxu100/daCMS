<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$db = new DB("dacms");
	$sql = "select * from sys_itemtype where it_id=:itid ";
	// $log = new Log();
	// $log->write($sql);
	
	$db->param(":itid", $_POST["itid"]);
	$set = $db->getone($sql);
	
	$db->close();
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
	
?>