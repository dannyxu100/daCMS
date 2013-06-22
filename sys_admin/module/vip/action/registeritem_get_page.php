<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	/**** 同步注册项和会员表结构 ****/
	$db = new DB("dacms");
	$tmp = $db->getlist("select * from information_schema.columns where table_schema='dacms' and table_name='web_vip' ");
	for( $i=0; $i<count($tmp); $i++ ){
		// Log::out( $tmp[$i]["COLUMN_NAME"] );
		// Log::out( "select * from web_vipregister where vr_field='". $tmp[$i]["COLUMN_NAME"] ."'" );
		
		if( 0 >= $db->getcount("select * from web_vipregister where vr_field='". $tmp[$i]["COLUMN_NAME"] ."'") ){
			$db->param( ":vr_name", $tmp[$i]["COLUMN_COMMENT"] );
			$db->param( ":vr_field", $tmp[$i]["COLUMN_NAME"] );
			$db->param( ":vr_sort", $i*10 );
			$db->param( ":vr_ismust", 0 );
			$db->param( ":vr_type", $tmp[$i]["COLUMN_TYPE"] );
			$db->param( ":vr_issys", 1 );
			$db->param( ":vr_status", "RUN" );
			$db->insert("insert into web_vipregister(vr_name, vr_field, vr_sort, vr_ismust, vr_type, vr_issys, vr_status) 
			values(:vr_name, :vr_field, :vr_sort, :vr_ismust, :vr_type, :vr_issys, :vr_status)");
		}
	}
	
	$db->close();
	/**** 同步注册项和会员表结构 ****/
	
	
	
	$db = new DB("dacms");
	$sql1 = "select * from web_vipregister ";
	$param1 = array();
	
	$sql2 = "select count(vr_id) as Column1 from web_vipregister ";
	$param2 = array();
	
	$sql1 .= " order by vr_sort asc, vr_id asc";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$len = $_POST["pagesize"];
		$sql1 .= " limit :start, :len";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":len", $len));
	}
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	echo json_encode($res);
?>