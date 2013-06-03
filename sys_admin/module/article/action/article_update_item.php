<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$sql = "update web_article";
	$db = new DB("dacms");
	
	$sql .= " set a_title=:atitle";
	$db->param(":atitle", $_POST["atitle"]);
	
	if( isset($_POST["atitle2"]) ){
		$sql .= ", a_title2=:atitle2";
		$db->param(":atitle2", $_POST["atitle2"]);
	}
	if( isset($_POST["asort"]) ){
		$sql .= ", a_sort=:asort";
		$db->param(":asort", $_POST["asort"]);
	}
	if( isset($_POST["acount"]) ){
		$sql .= ", a_count=:acount";
		$db->param(":acount", $_POST["acount"]);
	}
	if( isset($_POST["akeywords"]) ){
		$sql .= ", a_keywords=:akeywords";
		$db->param(":akeywords", $_POST["akeywords"]);
	}
	if( isset($_POST["adescription"]) ){
		$sql .= ", a_description=:adescription";
		$db->param(":adescription", $_POST["adescription"]);
	}
	if( isset($_POST["aimg"]) ){
		$sql .= ", a_img=:aimg";
		$db->param(":aimg", $_POST["aimg"]);
	}
	if( isset($_POST["acontent"]) ){
		$sql .= ", a_content=:acontent";
		$db->param(":acontent", urldecode($_POST["acontent"]));
	}
	
	$sql .= ", a_updatedate=:aupdatedate";
	$db->param(":aupdatedate", $now);
	
	$sql .= " where a_id=:aid ";
	$db->param(":aid", $_POST["aid"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out(urldecode($_POST["acontent"]));
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>