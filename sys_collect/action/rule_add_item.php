<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$sql = "insert into sys_collectrule(r_name, r_pagecode, r_urltype, r_urlsource, 
	r_urlallowed, r_urlunallowed, r_urlrange1, r_urlrange2, r_titlerule, r_titleclear, 
	r_keywordsrule, r_keywordsclear, r_descriptionrule, r_descriptionclear, r_contentrule, r_contentclear, 
	r_downloadimg, r_date) 
	
	values(:r_name, :r_pagecode, :r_urltype, :r_urlsource, 
	:r_urlallowed, :r_urlunallowed, :r_urlrange1, :r_urlrange2, :r_titlerule, :r_titleclear, 
	:r_keywordsrule, :r_keywordsclear, :r_descriptionrule, :r_descriptionclear, :r_contentrule, :r_contentclear, 
	:r_downloadimg, :r_date)";
	
	$db = new DB("dacms");
	$db->param(":r_name", $_POST["r_name"]);
	$db->param(":r_pagecode", $_POST["r_pagecode"]);
	$db->param(":r_urltype", $_POST["r_urltype"]);
	$db->param(":r_urlsource", $_POST["r_urlsource"]);
	$db->param(":r_urlallowed", $_POST["r_urlallowed"]);
	$db->param(":r_urlunallowed", $_POST["r_urlunallowed"]);
	$db->param(":r_urlrange1", $_POST["r_urlrange1"]);
	$db->param(":r_urlrange2", $_POST["r_urlrange2"]);
	$db->param(":r_titlerule", $_POST["r_titlerule"]);
	$db->param(":r_titleclear", $_POST["r_titleclear"]);
	$db->param(":r_keywordsrule", $_POST["r_keywordsrule"]);
	$db->param(":r_keywordsclear", $_POST["r_keywordsclear"]);
	$db->param(":r_descriptionrule", $_POST["r_descriptionrule"]);
	$db->param(":r_descriptionclear", $_POST["r_descriptionclear"]);
	$db->param(":r_contentrule", $_POST["r_contentrule"]);
	$db->param(":r_contentclear", $_POST["r_contentclear"]);
	$db->param(":r_downloadimg", $_POST["r_downloadimg"]);
	$db->param(":r_date", $now);
	
	$res = $db->insert($sql);
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>