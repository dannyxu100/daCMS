<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$db = new DB("dacms");
	
	$db->param(":p_id", $_POST["p_id"]);
	$set = $db->getone( "select p_img from web_product where p_id=:p_id" );
	// Log::out($db->geterror());
	
	$db->param(":p_img", $_POST["p_img"]);
	$db->param(":p_updatedate", $now);
	$res = $db->update("update web_product set p_img=:p_img, p_updatedate=:p_updatedate where p_id=:p_id ");
	// Log::out($db->geterror());
	
	$db->close();
	
	
	/**** 删除不要的文件 *****/
	$oldpic = rtrim($_SERVER['DOCUMENT_ROOT'],"/") . $set["p_img"];
	// Log::out($oldpic);
	if (file_exists($oldpic)) {
		unlink ($oldpic);
	}
	
	echo $res?$res:"FALSE";
?>