<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php
		include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
		include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Collect.class.php";
	?>
	
	<TITLE></TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
<div>
	<?php 
		Collect::get_content("http://tech.ifeng.com/internet/detail_2013_05/31/25936502_0.shtml");
		
	?>

</div>
</BODY>
</HTML>


