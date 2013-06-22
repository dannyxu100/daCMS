<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	$db = new DB("dacms");
	
	$db->param(":n_id", $_POST["n_id"]);
	$set = $db->getone( "select n_img from web_nav where n_id=:n_id" );
	// Log::out($db->geterror());
	
	$db->param(":n_img", $_POST["n_img"]);
	$res = $db->update("update web_nav set n_img=:n_img where n_id=:n_id ");
	// Log::out($db->geterror());
	
	$db->close();
	
	
	/**** 删除不要的文件 *****/
	$oldpic = rtrim($_SERVER['DOCUMENT_ROOT'],"/") . $set["n_img"];
	// Log::out($oldpic);
	if (file_exists($oldpic)) {
		unlink ($oldpic);
	}
	
	echo $res?$res:"FALSE";
?>