<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB("dacms");
	$db->param(":prid", $_POST["prid"]);
	$db->param(":pmid", $_POST["pmid"]);
	$res = $db->insert("insert into p_menu2role(m2r_prid, m2r_pmid) values(:prid, :pmid)");
	
	$db->close();
	//echo $db->error_message;
	
	echo $res?$res:"FALSE";
?>