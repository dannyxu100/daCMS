<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");

	$sql = "insert into web_article(a_atid, a_title, a_title2, a_sort, a_count, 
	a_keywords, a_description, a_img, a_content, a_createdate, a_updatedate) 
	
	values(:atid, :atitle, :atitle2, :asort, :acount, 
	:akeywords, :adescription, :aimg, :acontent, :acreatedate, :aupdatedate)";
	
	$db = new DB("dacms");
	$db->param(":atid", $_POST["atid"]);
	$db->param(":atitle", $_POST["atitle"]);
	$db->param(":atitle2", $_POST["atitle2"]);
	$db->param(":asort", $_POST["asort"]);
	$db->param(":acount", $_POST["acount"]);
	$db->param(":akeywords", $_POST["akeywords"]);
	$db->param(":adescription", $_POST["adescription"]);
	$db->param(":aimg", $_POST["aimg"]);
	$db->param(":acontent", urldecode($_POST["acontent"]));
	$db->param(":acreatedate", $now);
	$db->param(":aupdatedate", $now);
	
	$res = $db->insert($sql);
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>