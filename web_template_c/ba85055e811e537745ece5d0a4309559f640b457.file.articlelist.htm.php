<?php /* Smarty version Smarty-3.1.13, created on 2013-06-12 12:39:48
         compiled from "articlelist.htm" */ ?>
<?php /*%%SmartyHeaderCode:1227551b7fb61c2b109-80110903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba85055e811e537745ece5d0a4309559f640b457' => 
    array (
      0 => 'articlelist.htm',
      1 => 1371011985,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1227551b7fb61c2b109-80110903',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51b7fb61e51723_64023243',
  'variables' => 
  array (
    'articletype' => 0,
    'webconfig' => 0,
    'articletype2' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b7fb61e51723_64023243')) {function content_51b7fb61e51723_64023243($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['articletype']->value['at_name'];?>
_<?php echo $_smarty_tpl->tpl_vars['webconfig']->value['c_name'];?>
</title>
	<meta name="title" content="<?php echo $_smarty_tpl->tpl_vars['articletype']->value['at_name'];?>
_<?php echo $_smarty_tpl->tpl_vars['webconfig']->value['c_name'];?>
"> 
	<meta name="keywords" content="<?php if ($_smarty_tpl->tpl_vars['articletype']->value['at_keywords']){?><?php echo $_smarty_tpl->tpl_vars['articletype']->value['at_keywords'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['webconfig']->value['c_keywords'];?>
<?php }?>"> 
	<meta name="description" content="<?php if ($_smarty_tpl->tpl_vars['articletype']->value['at_description']){?><?php echo $_smarty_tpl->tpl_vars['articletype']->value['at_description'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['webconfig']->value['c_description'];?>
<?php }?>" />
	<link rel="icon" href="/images/ico.gif" type="image/x-icon" />
	<link href="/web/css/styles.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="/web/css/default.css" media="screen" rel="stylesheet" type="text/css" />

</head>

<body>
	<?php echo $_smarty_tpl->getSubTemplate ("header2.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div style="width:960px; margin:0px auto; padding:10px; background:#fff;">
		<div style="margin:10px 0px;">首页>>文章列表</div>
		<div>
			<div style="float:left; width:720px;min-height:300px;height:auto !important;height:300px; padding-right:10px; border-right:1px solid #ddd; overflow:hidden; ">
				<?php echo $_smarty_tpl->getSubTemplate ("_sys_list.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				
			</div>
			<div style="float:left; width:218px; padding:5px;">
				<?php  $_smarty_tpl->tpl_vars['articletype'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['articletype']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['articletype2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['articletype']->key => $_smarty_tpl->tpl_vars['articletype']->value){
$_smarty_tpl->tpl_vars['articletype']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['articletype']->key;
?>
				<div style="margin-bottom:10px;">
					<span><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</span>. <a href="/web/article/articlelist.php?atid=<?php echo $_smarty_tpl->tpl_vars['articletype']->value['at_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['articletype']->value['at_name'];?>
</a>
				</div>
				<?php } ?>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	
	<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>