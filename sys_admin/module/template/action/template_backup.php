<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Dir.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/PclZip.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	date_default_timezone_set('ETC/GMT-8');
	
	$root = rtrim($_SERVER['DOCUMENT_ROOT'],"/");
	$filename = $_POST["filename"];
	
	/**** 备份文件只保留最近 5份 ****/
	$list = Dir::dir_list( $root."/sys_backup/template_backup/", "pack" );
	$fileoldest = "";
	$timeoldest = time();
	$count = 0;
	
	foreach( $list as $v ){
		$count++;
		$t = filectime($v);
		
		if( $t < $timeoldest ){
			$fileoldest = $v;
			$timeoldest = $t;
		}
	}
	if( 4 < $count && "" != $fileoldest ){		//删除最老的1个备份
		@unlink($fileoldest);
	}
	
	
	/**** 备份打包 ****/
	$filename = $root."/sys_backup/template_backup/".$filename;
	$filename = iconv("UTF-8", "GB2312", $filename);
	
	$archive = new PclZip( $filename );
	$v_list = $archive->create( $root."/web/", PCLZIP_OPT_REMOVE_PATH, $root."/web/" );		//压缩
	
	if ( 0 == $v_list ) {
		die("Error : ".$archive->errorInfo(true));
	}
	echo true;
?>