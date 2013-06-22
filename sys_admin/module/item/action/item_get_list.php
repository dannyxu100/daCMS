<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$db = new DB("dacms");
	$sql = "select sys_item.* from sys_item, sys_itemtype 
	where it_code=:itcode 
	and it_id = i_itid";
	
	$sql .= " order by i_sort asc, i_id asc";
	
	$db->param(":itcode", $_POST["itcode"]);
		
	
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>