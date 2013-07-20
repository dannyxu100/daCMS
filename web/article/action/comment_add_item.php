<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	/***** 获取数据 *******/
	$db = new DB("dacms");
	$db->param(":c_type", "ARTICLE_COMMENT");		//属于文章评论
	
	$db->param(":c_vid", fn_getcookie("puid", "COOKIE_FROM_DACMSVIP"));
	$db->param(":c_date", $now);
	$db->param(":c_cid", $_POST["srcid"]);
	$db->param(":c_title", $_POST["srctitle"]);
	$db->param(":c_url", $_POST["srcurl"]);
	$db->param(":c_content", $_POST["c_content"]);
	
	$db->insert("insert into web_comment(c_type, c_cid, c_vid, c_title, c_url, c_content, c_date) 
	values(:c_type, :c_cid, :c_vid, :c_title, :c_url, :c_content, :c_date)");
	
	$db->close();
	
	header("location:". $_POST["srcurl"]);
?>