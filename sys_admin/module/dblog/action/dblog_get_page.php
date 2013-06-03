<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("dacms");
	$sql1 = "select * from sys_dblog ";
	$param1 = array();
	
	$sql2 = "select count(l_id) as Column1 from sys_dblog ";
	$param2 = array();
	
	$sql1 .= " order by l_date desc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":end", $end));
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