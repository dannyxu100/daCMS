<?php
	//验证登陆信息
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/dbbackup.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set('ETC/GMT-8');

	if(!isset($_POST['u_code']) || !isset($_POST['u_pwd']) ){
		echo "请输入账号、密码。";
		return;
	}
	
	$code=$_POST['u_code'];
	$pwd=md5($_POST['u_pwd']);
	
	$arrcookie = array();
	
	//查询用户基本信息
	$db = new DB("dacms");
	//先判断是不是超级管理员
	$row = $db->getone("select * from p_admin where pa_code='".$code."' and pa_pwd='".$pwd."'");
	if ($row['pa_code']==$code && $row['pa_pwd']==$pwd){
		$db->close();
		array_push($arrcookie, "puid:".$row['pa_id']);
		array_push($arrcookie, "pucode:".$row['pa_code']);
		array_push($arrcookie, "puname:".$row['pa_name']);
		array_push($arrcookie, "puicon:".$row['pa_icon']);
		array_push($arrcookie, "roleid:-1");
		array_push($arrcookie, "rolename:超级管理员");
	}
	else{
		$row = $db->getone("select * from p_user where pu_code='".$code."' and pu_pwd='".$pwd."'");
		
		// $log = new Log();
		// $log->write($row['pu_code'].":".$code."----".$row['pu_pwd'].":".$pwd);
		if ($row['pu_code']!=$code || $row['pu_pwd']!=$pwd){
			$db->close();
			echo "用户名或密码错误。";
			return;
		}
		
		//更新用户最近登录记录
		$db->param(":puid", $row['pu_id']);
		$db->param(":time", date("Y-m-d H:i:s"));
		$db->update("update p_user set pu_lastlogin=:time where pu_id=:puid");
		$db->close();
		//--------------------------------- 以下为获取权限数据代码 --------------------------------------------------
		
		$db = new DB("dacms");
		//查询所属角色信息
		$sql_role = "select p_role.* from p_user, p_role, p_user2role where u2r_puid=pu_id and u2r_prid=pr_id and pu_id=:puid order by pr_sort asc";
		$db->param(":puid", $row['pu_id']);
		$set_role = $db->getlist($sql_role);
		
		// $log = new Log();
		// $log->write($db->geterror());
		$db->close();
		
		//缓存用户基本信息
		//格式//puid:999|pucode:dannyxu100|puname:徐飞
		array_push($arrcookie, "puid:".$row['pu_id']);
		array_push($arrcookie, "pucode:".$row['pu_code']);
		array_push($arrcookie, "puname:".$row['pu_name']);
		array_push($arrcookie, "puicon:".$row['pu_icon']);
		
		//缓存所属角色信息
		if(is_array($set_role)){
			//格式//roleid:0,999,3|rolename:超级管理员,总经理,普通员工
			$arrprid = array();
			$arrprname = array();
			for($i=0; $i<count($set_role); $i++){
				array_push($arrprid, $set_role[$i]['pr_id']);
				array_push($arrprname, $set_role[$i]['pr_name']);
			}
			array_push($arrcookie, 'roleid:'.implode(',', $arrprid));
			array_push($arrcookie, 'rolename:'.implode(',', $arrprname));
		}
	}
	
	
	
	//格式//puid:999|pucode:dannyxu100|puname:徐飞|groupid:0,999,3|groupname:销售一组,机动小组,飞虎组|roleid:0,999,3|rolename:超级管理员,总经理,普通员工|role:0,999,3-超级管理员,总经理,普通员工|
	setcookie('COOKIE_FROM_DACMS', urlencode(implode('|', $arrcookie)), time()+86400, "/");		//有效期24小时, 整个领域有效
	
	//登录成功
	echo 1;
?>