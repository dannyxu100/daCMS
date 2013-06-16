<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$atid = $_POST["atid"];
	
	$db = new DB("dacms");
	$sql1 = "select * from ";
	$param1 = array();
	
	$sql2 = "select count(a_id) as Column1 from ";
	$param2 = array();
	
	if( isset($_POST["tid"]) ){
		$sql1 .= "web_article, web_tagmap where tm_cid=a_id and tm_tid=:tid and ";
		$sql2 .= "web_article, web_tagmap where tm_cid=a_id and tm_tid=:tid and ";
		array_push($param1, array(":tid", $_POST["tid"]));
		array_push($param2, array(":tid", $_POST["tid"]));
	}
	else{
		$sql1 .= "web_article where  ";
		$sql2 .= "web_article where  ";
	}
	
	$sql1 .= "a_atid=:atid ";
	$sql2 .= "a_atid=:atid ";
	array_push($param1, array(":atid", $atid));
	array_push($param2, array(":atid", $atid));
	
	$sql1 .="order by a_sort asc, a_id desc";
	
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