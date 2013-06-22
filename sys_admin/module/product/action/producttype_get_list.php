<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$db = new DB("dacms");
	$sql = "select * from web_producttype ";
	
	if(isset($_POST["ptid"])){
		$sql .= " where pt_id=:ptid ";
		$db->param(":ptid", $_POST["ptid"]);
	}
	else if(isset($_POST["ptpid"])){
		$sql .= " where pt_pid=:ptpid ";
		$db->param(":ptpid", $_POST["ptpid"]);
	}
	$sql .= " order by pt_sort asc, pt_pid asc";
	
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