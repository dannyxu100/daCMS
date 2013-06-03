<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);

	$currentdir = urldecode($_POST["dir"]);		//获取文件信息
	$filename = urldecode($_POST["filename"]);
	$type = $_POST["filetype"];

	$path = $currentdir."\\".iconv("UTF-8","gb2312", $filename);

	$fp = fopen($path,'r');
	$contents = fread($fp, filesize ($path));
	fclose($fp);
	echo $contents;
	
?>