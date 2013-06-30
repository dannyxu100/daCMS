<?php
//注销登录
	session_start();
	setcookie('COOKIE_FROM_DACMSVIP', "", time()-86400, "/");		//设置cookie 失效
	
	echo "<script language='javascript'>location='/web/vip/login.php';</script>";
?>