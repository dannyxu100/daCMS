<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	// error_reporting(-1);

	$currentdir = urldecode($_POST["dir"]);		//获取文件信息
	$filename = urldecode($_POST["filename"]);
	$type = $_POST["filetype"];
	$content = urldecode($_POST["content"]);

	$path = $currentdir."\\".iconv("UTF-8","gb2312", $filename);
	
	try{
		$fp = fopen($path, 'wb+');
		fwrite( $fp, $content );
		fclose( $fp );
		echo 1;
	}
	catch (Exception $e) {
		echo "FALSE";
	}
	
?>