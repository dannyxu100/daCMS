<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/Collect.class.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$sql = "select * from sys_collectrule where r_id=".$_POST["rid"];
	
	$db = new DB("dacms");
	$set = $db->getone($sql);
	
	if(is_array($set) && 0<count($set)){
		$config = array(
			"codeset" => $set["r_pagecode"],
			"sourcetype" => $set["r_urltype"],
			"page_base" => $set["r_urlbase"],
			"url_start" => $set["r_urlrange1"],
			"url_end" => $set["r_urlrange2"],
			"url_contain" => $set["r_urlallowed"],
			"url_except" => $set["r_urlunallowed"]
		);
		
		switch( $set["r_urltype"] ){
			case "LIST":
				$list = explode("\n", $set["r_urlsource"]);
				$arr = array();
				foreach ($list as $k=>$v) {
					$tmp = Collect::get_url_lists( $v, $config );
					$arr = array_merge($arr, $tmp);
				}
				break;
			case "NUMBER":
				$arr = array();
				for( $i=$set["r_num1"]; $i<=$set["r_num2"]; $i=$i+$set["r_step"] ){
					$tmp = Collect::get_url_lists( str_replace("[*]", $i, $set["r_urlsource2"]), $config );
					$arr = array_merge($arr, $tmp);
				}
				break;
			case "SINGLE":
				$arr = Collect::get_url_lists( $set["r_urlsource3"], $config );
				break;
			case "RSS":
				$arr = Collect::get_url_lists( $set["r_urlsource4"], $config );
				break;
		}
		
		
		foreach( $arr as $k=>$v ){
			if( 0 >= $db->getcount("select * from sys_collect where c_rid=".$_POST["rid"]." and c_url='".$v["url"]."'") ){
				$arr[$k]["isold"] = "FALSE";
			}
			else{
				$arr[$k]["isold"] = "TRUE";
			}
			
			// Log::out($v);
		}
		
		$list = array(
			"ds1" => $arr
		);
		
		echo json_encode($list);
	}
	else{
		echo "FALSE";
	}
	
	$db->close();
?>