<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("dacms");
	$sql1 = "select * from sys_item ";
	$param1 = array();
	
	$sql2 = "select count(i_id) as Column1 from sys_item ";
	$param2 = array();
	
	if( isset($_POST["itid"]) ){
		$sql1 .= " where i_itid=:itid ";
		$sql2 .= " where i_itid=:itid ";
		
		array_push($param1, array(":itid", $_POST["itid"]));
		array_push($param2, array(":itid", $_POST["itid"]));
	}
	$sql1 .= " order by i_sort asc, i_id asc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$len = $_POST["pagesize"];
		$sql1 .= " limit :start, :len";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":len", $len));
	}
	// $log = new Log();
	// $log->write($sql1);
	// $log->write($sql2);
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	// $log->write($db->geterror());
	$db->close();
		
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write(json_encode($res));
	echo json_encode($res);
?>