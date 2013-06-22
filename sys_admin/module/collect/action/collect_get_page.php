<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$db = new DB("dacms");
	$sql1 = "select * from sys_collect ";
	$param1 = array();
	
	$sql2 = "select count(c_id) as Column1 from sys_collect ";
	$param2 = array();
	
	if( isset($_POST["c_rid"]) ){
		$sql1 .= "where c_rid=:c_rid ";
		array_push($param1, array(":c_rid", $_POST["c_rid"]));
		
		$sql2 .= "where c_rid=:c_rid ";
		array_push($param2, array(":c_rid", $_POST["c_rid"]));
	}
	$sql1 .= " order by c_date desc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$len = $_POST["pagesize"];
		$sql1 .= " limit :start, :len";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":len", $len));
	}
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	echo json_encode($res);
?>