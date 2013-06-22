<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$db = new DB("dacms");
	$sql = "select * from web_nav ";
	
	if(isset($_POST["nid"])){
		$sql .= " where n_id=:nid ";
		$db->param(":nid", $_POST["nid"]);
	}
	else if(isset($_POST["npid"])){
		$sql .= " where n_pid=:npid ";
		$db->param(":npid", $_POST["npid"]);
	}
	else if(isset($_POST["nlevel"])){
		$sql .= " where n_level=:nlevel ";
		$db->param(":nlevel", $_POST["nlevel"]);
	}
	$sql .= " order by n_sort asc, n_pid asc";
	
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