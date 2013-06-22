<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$sql = "select * from p_user where pu_id=".$_POST["pu_id"];
	// $log = new Log();
	// $log->write($sql);
	
	$db = new DB("dacms");
	$set = $db->getone($sql);
	
	$db->close();
	
	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
	
	// $log->write($res);
?>