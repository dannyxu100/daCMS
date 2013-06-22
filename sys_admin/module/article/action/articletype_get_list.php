<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$db = new DB("dacms");
	$sql = "select * from web_articletype ";
	
	if(isset($_POST["atid"])){
		$sql .= " where at_id=:atid ";
		$db->param(":atid", $_POST["atid"]);
	}
	else if(isset($_POST["atpid"])){
		$sql .= " where at_pid=:atpid ";
		$db->param(":atpid", $_POST["atpid"]);
	}
	$sql .= " order by at_sort asc, at_pid asc";
	
	$set = $db->getlist($sql);
	// Log::out($sql);
	// Log::out($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>