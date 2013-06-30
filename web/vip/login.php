<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/footer.php";
	
	$smarty->display('login.htm');

?>