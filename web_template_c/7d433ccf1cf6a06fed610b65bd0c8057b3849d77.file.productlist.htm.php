<?php /* Smarty version Smarty-3.1.13, created on 2013-06-22 19:26:52
         compiled from "productlist.htm" */ ?>
<?php /*%%SmartyHeaderCode:594451c589fc757c73-45066470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d433ccf1cf6a06fed610b65bd0c8057b3849d77' => 
    array (
      0 => 'productlist.htm',
      1 => 1371877886,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '594451c589fc757c73-45066470',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'producttype' => 0,
    'producttype2' => 0,
    'k' => 0,
    'pt' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c589fcdd9fe6_19901993',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c589fcdd9fe6_19901993')) {function content_51c589fcdd9fe6_19901993($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_name']),$_smarty_tpl);?>
_<?php echo @constant('WC_NAME');?>
</title>
	<meta name="title" content="<?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_name']),$_smarty_tpl);?>
_<?php echo @constant('WC_NAME');?>
"> 
	<meta name="keywords" content="<?php echo fn_keywords(array('t1'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_keywords']),$_smarty_tpl);?>
"> 
	<meta name="description" content="<?php echo fn_description(array('t1'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_description']),$_smarty_tpl);?>
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
			<div style="float:left; width:720px;min-height:600px;height:auto !important;height:600px; overflow:visible;padding-right:10px; border-right:1px solid #ddd; overflow:hidden; ">
				<?php echo $_smarty_tpl->getSubTemplate ("_sys_productlist.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</div>
			<div style="float:left; width:218px; padding:5px;">
				<?php  $_smarty_tpl->tpl_vars['pt'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pt']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['producttype2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pt']->key => $_smarty_tpl->tpl_vars['pt']->value){
$_smarty_tpl->tpl_vars['pt']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['pt']->key;
?>
				<div style="margin-bottom:10px;">
					<span><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</span>. <a href="/web/product/prolist.php?ptid=<?php echo $_smarty_tpl->tpl_vars['pt']->value['pt_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['pt']->value['pt_name'];?>
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