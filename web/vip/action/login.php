<?php
	//验证登陆信息
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	// error_reporting(-1);

	date_default_timezone_set('ETC/GMT-8');
	
	if(!isset($_POST['v_code']) || !isset($_POST['v_pwd']) ){
		echo "请输入账号、密码。";
		return;
	}
	
	$backurl=isset($_POST["backurl"])?$_POST["backurl"]:"";
	$code=$_POST['v_code'];
	$pwd=md5($_POST['v_pwd']);
	
	$arrcookie = array();
	$usertype = "";

	//查询会员基本信息
	$db = new DB("dacms");
	
	$db->param(":v_code", $code);
	$db->param(":v_pwd", $pwd);
	$row = $db->getone("select * from web_vip where v_code=:v_code and v_pwd=:v_pwd");
	$db->close();
	
	if ($row['v_code']!=$code || $row['v_pwd']!=$pwd){
		echo "用户名或密码错误。";
		return;
	}
	
	//缓存会员基本信息
	//格式//puid:999|pucode:dannyxu100|puname:王小虎
	array_push($arrcookie, "puid:".$row['v_id']);
	array_push($arrcookie, "pucode:".$row['v_code']);
	array_push($arrcookie, "puname:".$row['v_name']);
	
	
	//格式//puid:999|pucode:dannyxu100|puname:王小虎|
	setcookie('COOKIE_FROM_DACMSVIP', urlencode(implode('|', $arrcookie)), time()+86400, "/");		//有效期24小时, 整个领域有效
	
	//更新会员最近登录记录
	$db = new DB("dacms");
	$db->param(":vid", $row["v_id"]);
	$db->param(":time", date("Y-m-d H:i:s"));
	$db->update("update web_vip set v_lastlogin=:time where v_id=:vid");
	// echo $db->geterror();
	$db->close();
		
	//登录成功
	echo "登录成功";
	if( $backurl ){
		header("location:".$backurl);
	}
?>