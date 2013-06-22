<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	$db = new DB("dacms");
	
	$sqlfield = array();
	$sqlvalue = array();
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
				continue;
			case "v_pwd":
				$value = md5($_POST["v_pwd"]);
			default:
				array_push($sqlfield, $key);
				array_push($sqlvalue, ":".$key);
				$db->param(":".$key, $value);
		}
	}
	
	$res = $db->insert("insert into web_vip(". implode(",", $sqlfield) .") values(". implode(",", $sqlvalue) .")");
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>