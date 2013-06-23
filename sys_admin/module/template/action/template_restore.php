<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Dir.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/PclZip.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/smarty/Smarty.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$root = rtrim($_SERVER['DOCUMENT_ROOT'],"/");
	$filename = $_POST["filename"];

	$filename = $root."/sys_backup/template_backup/".$filename;
	$filename = iconv("UTF-8", "GB2312", $filename);
	
	$smarty = new Smarty();								//删除smarty模板缓存
	$smarty->compile_dir = $root."/web_template_c/";
	$smarty->clearCompiledTemplate();
	
	Dir::dir_delete( $root."/web/" );					//删除web目录内容
	Dir::dir_create( $root."/web/" );
	
	
	$archive = new PclZip( $filename );
	$v_list = $archive->extract(PCLZIP_OPT_PATH, $root."/web/");
	
	if ( 0 == $v_list ) {
		die("Error : ".$archive->errorInfo(true));
	}
	echo true;
?>