<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("dacms");
	$sql = "select web_articletype.*, count(a_id) total 
	from web_articletype left join web_article 
	on (at_id = a_atid) ";
	
	if(isset($_POST["atid"])){
		$sql .= " where at_id=:atid ";
		$db->param(":atid", $_POST["atid"]);
	}
	else if(isset($_POST["atpid"])){
		$sql .= " where at_pid=:atpid ";
		$db->param(":atpid", $_POST["atpid"]);
	}
	$sql .= "group by at_id order by at_sort asc, at_pid asc";
	
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