<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	$db->param(":p_id", $_POST["p_id"]);
	$set = $db->getone( "select p_url from web_picture where p_id=:p_id" );
	Log::out($db->geterror());
	$res = $db->delete( "delete from web_picture where p_id=:p_id" );
	Log::out($db->geterror());
	$db->close();
	
	/**** 删除不要的文件 *****/
	$oldpic = rtrim($_SERVER['DOCUMENT_ROOT'],"/") . $set["p_url"];
	Log::out($oldpic);
	if (file_exists($oldpic)) {
		unlink ($oldpic);
	}
	
	echo $res?$res:"FALSE";
?>