<?php /* Smarty version Smarty-3.1.13, created on 2013-06-03 00:44:15
         compiled from "D:\work\daCMS\web\_templates\index.htm" */ ?>
<?php /*%%SmartyHeaderCode:1239151ab75fb73ff79-84729252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6445d71a2d884911f320100835bbada528d46e1' => 
    array (
      0 => 'D:\\work\\daCMS\\web\\_templates\\index.htm',
      1 => 1370191453,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1239151ab75fb73ff79-84729252',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51ab75fbb4f9b2_40374461',
  'variables' => 
  array (
    'webconfig' => 0,
    'navset' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51ab75fbb4f9b2_40374461')) {function content_51ab75fbb4f9b2_40374461($_smarty_tpl) {?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<br/>
	地址：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_address'];?>
<br/>
	联系人：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_user'];?>
<br/>
	电话：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_phone'];?>
<br/>
	</div>
</body>
</html>
<?php }} ?>