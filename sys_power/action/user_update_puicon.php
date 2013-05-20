<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	 
	$db = new DB("dacms");

	if(-1 == fn_getcookie("roleid")){		//超级管理员
		$sql = "update p_admin ";
		$sql .= "set pa_icon='".$_POST["puicon"]."' ";
		$sql .= " where pa_id='".$_POST["puid"]."'";
		
		$res = $db->update($sql);
		// Log::out($db->geterror());
	}
	else{									//普通管理员
		$sql = "update p_user ";
		$sql .= "set pu_icon='".$_POST["puicon"]."' ";
		$sql .= " where pu_id='".$_POST["puid"]."'";
		
		$res = $db->update($sql);
		// Log::out($db->geterror());
		
	}
	
	$db->close();
	echo $res?$res:"FALSE";
?>