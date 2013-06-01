<?php /* Smarty version Smarty-3.1.13, created on 2013-05-25 15:23:24
         compiled from "D:\work\daCMS\web\_templates\default\index.htm" */ ?>
<?php /*%%SmartyHeaderCode:86751a0d68b23f915-89073059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6afd788ab39723174ee10ac27c89275a440a3cf' => 
    array (
      0 => 'D:\\work\\daCMS\\web\\_templates\\default\\index.htm',
      1 => 1369495402,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86751a0d68b23f915-89073059',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a0d68b33aa75_06627187',
  'variables' => 
  array (
    'webconfig' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a0d68b33aa75_06627187')) {function content_51a0d68b33aa75_06627187($_smarty_tpl) {?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_name'];?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_keywords'];?>
"> 
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_description'];?>
" />

</head>

<body >
公司名称：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_company'];?>

地址：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_address'];?>

联系人：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_user'];?>

电话：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_phone'];?>

</body>
</html>
<?php }} ?>