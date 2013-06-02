<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	
	$sql = "update sys_collectrule";
	$db = new DB("dacms");
	
	$sql .= " set r_name=:r_name";
	$db->param(":r_name", $_POST["r_name"]);
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
			case "r_name":
			case "r_id":
				continue;
				
			default:
				$sql .= ", ".$key."=:".$key;
				$db->param(":".$key, $value);
		}
		
	}
	
	$sql .= ", r_date=:r_date";
	$db->param(":r_date", $now);
	
	$sql .= " where r_id=:r_id ";
	$db->param(":r_id", $_POST["r_id"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>