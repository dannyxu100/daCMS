<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$c_type = $_POST["c_type"];
	
	$db = new DB("dacms");
	$sql1 = "select * from ";
	$param1 = array();
	
	$sql2 = "select count(c_id) as Column1 from ";
	$param2 = array();
	
	if( isset($_POST["tid"]) ){
		$sql1 .= "web_comment, web_vip, web_tagmap where c_vid=v_id and tm_cid=c_id and tm_tid=:tid and ";
		$sql2 .= "web_comment, web_vip, web_tagmap where c_vid=v_id and tm_cid=c_id and tm_tid=:tid and ";
		array_push($param1, array(":tid", $_POST["tid"]));
		array_push($param2, array(":tid", $_POST["tid"]));
	}
	else{
		$sql1 .= "web_comment, web_vip where c_vid=v_id and ";
		$sql2 .= "web_comment, web_vip where c_vid=v_id and ";
	}
	
	$sql1 .= "c_type=:c_type ";
	$sql2 .= "c_type=:c_type ";
	array_push($param1, array(":c_type", $c_type));
	array_push($param2, array(":c_type", $c_type));
	
	$sql1 .="order by c_date desc, c_id desc";
	
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