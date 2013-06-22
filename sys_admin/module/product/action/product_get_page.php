<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$ptid = $_POST["ptid"];
	
	$db = new DB("dacms");
	$sql1 = "select *, pt_id, pt_name from ";
	$param1 = array();
	
	$sql2 = "select count(p_id) as Column1 from ";
	$param2 = array();
	
	if( isset($_POST["tid"]) ){
		$sql1 .= "web_product, web_producttype, web_tagmap where tm_cid=p_id and tm_tid=:tid and ";
		$sql2 .= "web_product, web_tagmap where tm_cid=p_id and tm_tid=:tid and ";
		array_push($param1, array(":tid", $_POST["tid"]));
		array_push($param2, array(":tid", $_POST["tid"]));
	}
	else{
		$sql1 .= "web_product, web_producttype where  ";
		$sql2 .= "web_product where  ";
	}
	
	$sql1 .= "p_ptid=pt_id and p_ptid=:ptid ";
	$sql2 .= "p_ptid=:ptid ";
	array_push($param1, array(":ptid", $ptid));
	array_push($param2, array(":ptid", $ptid));
	
	$sql1 .="group by p_id order by p_sort asc, p_id desc";
	
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