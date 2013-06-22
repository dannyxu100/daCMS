<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$db = new DB("dacms");
	$sql = "select * from web_vipregister ";
	
	if(isset($_POST["vr_status"])){
		$sql .= " where vr_status=:vr_status ";
		$db->param(":vr_status", $_POST["vr_status"]);
	}
	$sql .= " order by vr_sort asc, vr_id asc";
	
	$set = $db->getlist($sql);
	// Log::out($db->geterror());
	
	/******** 获取选择类型对应的可选项 ******/
	$items = array();
	$db->paramclear();
	$sql = "select sys_item.* from sys_item, sys_itemtype 
	where it_code=:itcode and it_id = i_itid 
	order by i_sort asc, i_id asc";
	
	for( $i=0; $i<count($set); $i++ ){
		if( "" != $set[$i]["vr_items"] ){
			$db->param(":itcode", $set[$i]["vr_items"]);
			$setitem = $db->getlist($sql);
			// Log::out($db->geterror());
			
			if(is_array($setitem) && 0<count($setitem)){
				$items[ $set[$i]["vr_items"] ] = $setitem;
			}
			else{
				$items[ $set[$i]["vr_items"] ] = "未配置可选项";
			}
		}
	}
	$db->close();

	
	$res = array(
		"column"=>$set,
		"items"=>$items			//记录集
	);
	
	echo json_encode($res);
?>