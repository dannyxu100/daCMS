<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	// $qry = $_POST["qry"];
	
	
	$db = new DB("dacms");
	$sql1 = "select * from ";
	$param1 = array();
	
	$sql2 = "select count(v_id) as Column1 from ";
	$param2 = array();
	
	if( isset($_POST["tid"]) ){
		$sql1 .= "web_vip, web_tagmap where tm_cid=v_id and tm_tid=:tid ";
		$sql2 .= "web_vip, web_tagmap where tm_cid=v_id and tm_tid=:tid ";
		array_push($param1, array(":tid", $_POST["tid"]));
		array_push($param2, array(":tid", $_POST["tid"]));
	}
	else{
		$sql1 .= "web_vip ";
		$sql2 .= "web_vip ";
	}
	$sql1 .="order by v_id desc";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$len = $_POST["pagesize"];
		$sql1 .= " limit :start, :len";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":len", $len));
	}
	// $log = new Log();
	// $log->write($sql);
	// $log->write($sql2);
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write(var_export($res,true));
	echo json_encode($res);
?>