<?php
function getphone($phone){
	$dbpath = "befo/";	
	$len    = strlen($phone);
	if ( $len < 7 ){
	return "手机号码最低7位";
	}
	$par = "[0-9]";
	for ($i=0;$i<$len;$i++){
		if(!ereg($par,substr($phone,$i,1) ) ){
		return "手机号码只能为数字";
		}
	}	
	$sub   = substr($phone,0,3);
	$sunum = readover($dbpath.$sub.".txt");
	if ($sunum){
		$num    = ltrim(substr($phone,3,4),"0");
		$search = file($dbpath.$sub.".txt");		
		$tmp    = $search[$num];
		$result = substr($tmp,strpos($tmp,"=")+1,strlen($tmp)-strpos($tmp,"=")-2);
		return (strlen($result)>1)?$result:"无数据";
	}else{
	return "暂不支持$sub";
	}
}
function readover($filename,$method="rb") {	
	strpos($filename,'..')!==false && exit('Forbidden');
	if ($handle = @fopen($filename,$method)) {
		flock($handle,LOCK_SH);
		$filedata=@fread($handle,filesize($filename));
		fclose($handle);
	}
	return $filedata;
}
?>