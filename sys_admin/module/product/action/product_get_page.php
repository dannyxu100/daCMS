<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$ptid = $_POST["ptid"];
	
	$db = new DB("dacms");
	$sql1 = "select *, pt_id, pt_name from web_product, web_producttype ";
	$param1 = array();
	
	$sql2 = "select count(p_id) as Column1 from web_product ";
	$param2 = array();
	
	$sql1 .= "where p_ptid=pt_id and p_ptid=:ptid ";
	$sql2 .= "where p_ptid=:ptid ";
	array_push($param1, array(":ptid", $ptid));
	array_push($param2, array(":ptid", $ptid));
	
	$sql1 .="order by p_sort asc, p_id desc";
	
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