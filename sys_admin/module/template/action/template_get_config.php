<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Settings.class.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	//error_reporting(-1);
	
	$settings = new Settings_PHP;
	$settings->load( rtrim($_SERVER['DOCUMENT_ROOT'],"/") . '/web/_sys_templateinfo/config.php' );

	echo json_encode( $settings->get("info") );
?>