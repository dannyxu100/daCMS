<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$db = new DB("dacms");
	
	$sql = "update web_product set p_name=:p_name";
	$db->param(":p_name", $_POST["p_name"]);
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
			case "p_id":
			case "p_name":
			case "p_updatedate":
				continue;
				
			default:
				$sql .= ", ".$key."=:".$key;
				$db->param(":".$key, $value);
		}
		
	}
	
	$sql .= ", p_updatedate=:p_updatedate";
	$db->param(":p_updatedate", $now);
	
	$sql .= " where p_id=:p_id ";
	$db->param(":p_id", $_POST["p_id"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out(urldecode($_POST["acontent"]));
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>