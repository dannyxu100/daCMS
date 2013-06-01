<?php /* Smarty version Smarty-3.1.13, created on 2013-05-25 23:56:07
         compiled from "D:\work\daCMS\web\_templates\default\index.htm" */ ?>
<?php /*%%SmartyHeaderCode:2536951a0d781726cf3-85995539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6afd788ab39723174ee10ac27c89275a440a3cf' => 
    array (
      0 => 'D:\\work\\daCMS\\web\\_templates\\default\\index.htm',
      1 => 1369497366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2536951a0d781726cf3-85995539',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a0d781844af7_98371734',
  'variables' => 
  array (
    'webconfig' => 0,
    'navset' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a0d781844af7_98371734')) {function content_51a0d781844af7_98371734($_smarty_tpl) {?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_name'];?>
</title>
<meta name="title" content="<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_name'];?>
"> 
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_keywords'];?>
"> 
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_description'];?>
" />

</head>

<body >
	<div class="head">
	<?php  $_smarty_tpl->tpl_vars['nav'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nav']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nav']->key => $_smarty_tpl->tpl_vars['nav']->value){
$_smarty_tpl->tpl_vars['nav']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['nav']->key;
?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['nav']->value['n_url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['nav']->value['n_name'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['nav']->value['n_name'];?>
</a>
	<?php } ?>
	</div>


	<hr/>
	<div class="foot">
	公司名称：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_company'];?>

	地址：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_address'];?>

	联系人：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_user'];?>

	电话：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_phone'];?>

	</div>
</body>
</html>
<?php }} ?>