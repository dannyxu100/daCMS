<?php
define('IN_SEO','IN_SEO');
header("content-Type: text/html; charset=GB2312");
$testlink = $_GET['testlink'];
if(strpos($testlink,'wpa.qq.com') !== false){
	echo "(<a href=".$testlink." target=_blank><font color=red> ¡Ì </font></a>)";
}else{
	$con = @file_get_contents($testlink);
	if($con){
		@require_once('../pr/prfunction.php');
		$pr = GetPR($testlink);
		echo "(<a href=".$testlink." target=_blank><font color=red> ¡Ì </font></a>)&nbsp;&nbsp;<font color=black><b>".$pr."</b></font>";
	}else{
		echo "(<a href=".$testlink." target=_blank> ¡Á </a>)";
	}
}
?>