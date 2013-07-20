<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$c_commentid = $_POST["c_commentid"];
	$c_type = $_POST["c_type"];

	$db = new DB("dacms");
	$sql1 = "select * from web_comment, p_user 
	where c_type=:c_type 
	and c_commentid=:c_commentid 
	and c_puid=pu_id 
	and c_isrevert=1";
	$param1 = array();
	
	$sql2 = "select count(c_id) as Column1 from web_comment, p_user 
	where c_type=:c_type 
	and c_commentid=:c_commentid 
	and c_puid=pu_id 
	and c_isrevert=1";
	$param2 = array();
	
	array_push($param1, array(":c_type", $c_type));
	array_push($param1, array(":c_commentid", $c_commentid));
	array_push($param2, array(":c_type", $c_type));
	array_push($param2, array(":c_commentid", $c_commentid));
	
	$sql1 .= " order by c_date desc, c_id desc";
	
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$len = $_POST["pagesize"];
		$sql1 .= " limit :start, :len";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":len", $len));
	}
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	// Log::out($sql1);
	// Log::out($db->geterror());
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	$db->close();

	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	echo json_encode($res);
?>