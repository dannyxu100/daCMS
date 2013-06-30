<?php /* Smarty version Smarty-3.1.13, created on 2013-06-27 23:28:27
         compiled from "articlelist.htm" */ ?>
<?php /*%%SmartyHeaderCode:1386651c993c168ee97-95385183%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba85055e811e537745ece5d0a4309559f640b457' => 
    array (
      0 => 'articlelist.htm',
      1 => 1372344086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1386651c993c168ee97-95385183',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c993c1957925_15378411',
  'variables' => 
  array (
    'articletype' => 0,
    'articletype2' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c993c1957925_15378411')) {function content_51c993c1957925_15378411($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['articletype']->value['at_name']),$_smarty_tpl);?>
_<?php echo @constant('WC_NAME');?>
</title>
	<meta name="title" content="<?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['articletype']->value['at_name']),$_smarty_tpl);?>
_<?php echo @constant('WC_NAME');?>
" /> 
	<meta name="keywords" content="<?php echo fn_keywords(array('k1'=>$_smarty_tpl->tpl_vars['articletype']->value['at_keywords']),$_smarty_tpl);?>
,<?php echo @constant('WC_KEYWORDS');?>
" /> 
	<meta name="description" content="<?php echo fn_description(array('k1'=>$_smarty_tpl->tpl_vars['articletype']->value['at_description']),$_smarty_tpl);?>
,<?php echo @constant('WC_DESCRIPTION');?>
" />
	
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
				<?php echo $_smarty_tpl->getSubTemplate ("_sys_articlelist.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				
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

<script type="text/javascript" language="javascript" src="/web/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/general.js"></script>
<?php }} ?>