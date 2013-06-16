<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$names = preg_split("/□/", $_POST["names"]);
	$urls = preg_split("/□/", $_POST["urls"]);
	$type = $_POST["type"];
	$cid = $_POST["cid"];
	
	$db = new DB("dacms");
	$sql = "insert into web_picture(p_name, p_type, p_cid, p_url, p_date) 
	values(:p_name, :p_type, :p_cid, :p_url, :p_date)";
	
	if( 0<count($urls) && 0<count($names) ){
	
		for($i=0; $i<count($urls); $i++){
			$db->param(":p_name", $names[$i]);
			$db->param(":p_url", $urls[$i]);
			
			$db->param(":p_type", $type);
			$db->param(":p_cid", $cid);
			$db->param(":p_date", $now);
			
			$db->insert($sql);
		}
	}
	
	// Log::out($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>