﻿<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$db = new DB("dacms");
	$sql = "select * from sys_itemtype ";
	
	if(isset($_POST["itid"])){
		$sql .= " where it_id=:itid ";
		$db->param(":itid", $_POST["itid"]);
	}
	else if(isset($_POST["itpid"])){
		$sql .= " where it_pid=:itpid ";
		$db->param(":itpid", $_POST["itpid"]);
	}
	$sql .= " order by it_sort asc, it_pid asc";
	
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>