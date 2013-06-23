<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Dir.class.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	// error_reporting(-1);
	
	date_default_timezone_set('ETC/GMT-8');
	
	$root = rtrim($_SERVER['DOCUMENT_ROOT'],"/");
	$list = Dir::dir_list( $root."/sys_backup/template_backup/", "pack" );
	
	$set = $item = array();
	
	foreach( $list as $v ){
		// echo $v;
		// echo filectime($v);
		// echo filemtime($v);
		// echo fileatime($v);
		
		$path = iconv("GB2312", "UTF-8", $v);
		$file = substr($path, strrpos($path, "/" )+1);
		
		if( $file ){
			$item = array(
				"bak_file"=>$file,
				"bak_createdate"=>date("Y-m-d H:i:s", filectime($v)),
			);
			
			array_push( $set, $item);
		}
	}
	
	$res = array(
		"ds1"=>array( array("Column1"=>count($set)) ),
		"ds11"=>$set					//记录集
	);
	
	echo json_encode($res);
?>