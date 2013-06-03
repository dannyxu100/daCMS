<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/sys_admin/module/collect/action/Collect.class.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$sql = "select * from sys_collectrule where r_id=".$_POST["rid"];
	
	$db = new DB("dacms");
	$set = $db->getone($sql);
	
	if(is_array($set) && 0<count($set)){
		$config = array(
			"sourcetype" => $set["r_urltype"],
			"url_start" => $set["r_urlrange1"],
			"url_end" => $set["r_urlrange2"],
			"url_contain" => $set["r_urlallowed"],
			"url_except" => $set["r_urlunallowed"]
		);
		
		$arr = Collect::get_url_lists( $set["r_urlsource"], $config );
		
		foreach( $arr as $k=>$v ){
			if( 0 >= $db->getcount("select * from sys_collect where c_rid=".$_POST["rid"]." and c_url='".$v["url"]."'") ){
				$arr[$k]["isold"] = "false";
			}
			else{
				$arr[$k]["isold"] = "true";
			}
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