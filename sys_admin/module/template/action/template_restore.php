<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/PclZip.class.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$root = rtrim($_SERVER['DOCUMENT_ROOT'],"/");

	$archive = new PclZip( $root."/backup/template_backup/template.pack" );
	$v_list = $archive->extract(PCLZIP_OPT_PATH, $root."/web/");
	
	if ( 0 == $v_list ) {
		die("Error : ".$archive->errorInfo(true));
	}
	echo true;
?>