<?php /* Smarty version Smarty-3.1.13, created on 2013-06-27 23:28:23
         compiled from "login.htm" */ ?>
<?php /*%%SmartyHeaderCode:1663351cc595a63f5f9-24014713%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a756c063618a3b4be5e37a74eea143f0266ca9f9' => 
    array (
      0 => 'login.htm',
      1 => 1372346902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1663351cc595a63f5f9-24014713',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51cc595aaf9b41_95429268',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51cc595aaf9b41_95429268')) {function content_51cc595aaf9b41_95429268($_smarty_tpl) {?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>会员登陆页面,<?php echo @constant('WC_NAME');?>
</title>
	<meta name="title" content="会员登陆页面,<?php echo @constant('WC_NAME');?>
" /> 
	<meta name="keywords" content="会员登录,<?php echo @constant('WC_KEYWORDS');?>
" /> 
	<meta name="description" content="会员登录,<?php echo @constant('WC_DESCRIPTION');?>
" />
	<link rel="icon" href="/images/ico.gif" type="image/x-icon" />
	<link href="/web/css/styles.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="/web/css/default.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php echo $_smarty_tpl->getSubTemplate ("header2.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<table class="" style=" width:400px; height:50px; margin:10px auto;">
		<tr>
			<td colspan="2">会员登录</td>
		</tr>
		<tr>
			<td style="width:40px;">账号</td>
			<td><input id="v_code" type="text" style="width:150px;"/></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input id="v_pwd" type="password" style="width:150px;"/></td>
		</tr>
	</table>
	<div style="margin:20px auto; text-align:center;">
		<input type="button" style="width:100px; height:30px;" value="登陆" onclick="login()"/>
		<input type="button" style="width:50px; height:30px;" value="清空" onclick="clearinput()" />
	</div>
	<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>

<script type="text/javascript" language="javascript" src="/web/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/general.js"></script>
<script>
	function clearinput(){
		$("#v_code").val("");
		$("#v_pwd").val("");
	}
	
	function chkdata(){
		if(""==$("#v_code").val()){
			alert("账号不能为空！");
			return false;
		}
		if(""==$("#v_pwd").val()){
			alert("密码不能为空！");
			return false;
		}
		return true;
	}
	
	function login(){
		if( !chkdata() ){
			return;
		}
		
		$.ajax({
			url: "action/login.php",
			type: "POST",
			dataType: "text",
			data: {
				v_code: $("#v_code").val(),
				v_pwd: $("#v_pwd").val()
			},
			error: function(res){
				// debugger;
			},
			success: function( res ){
				alert(res);
			}
		});
	}
	
</script><?php }} ?>