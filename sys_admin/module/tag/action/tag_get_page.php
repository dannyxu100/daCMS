<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$type = $_POST["tagtype"];
	
	$db = new DB("dacms");
	$sql1 = "select * from web_tag ";
	$param1 = array();
	
	$sql2 = "select count(t_id) as Column1 from web_tag ";
	$param2 = array();
	
	$sql1 .= "where t_type=:type ";
	$sql2 .= "where t_type=:type ";
	array_push($param1, array(":type", $type));
	array_push($param2, array(":type", $type));
	
	$sql1 .=" order by t_id desc";
	
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