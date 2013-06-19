<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 09:40:58
         compiled from "productdetail.htm" */ ?>
<?php /*%%SmartyHeaderCode:1783851bc95ac526562-04901064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b00eb35e1cb1f0bd92ff88a481710020ade1118d' => 
    array (
      0 => 'productdetail.htm',
      1 => 1371531602,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1783851bc95ac526562-04901064',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51bc95ac727092_56456690',
  'variables' => 
  array (
    'product' => 0,
    'producttype' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51bc95ac727092_56456690')) {function content_51bc95ac727092_56456690($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\workfiles\\daCMS\\plugin\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['product']->value['p_name'],'t2'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_name']),$_smarty_tpl);?>
</title>
	<meta name="title" content="<?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['product']->value['p_name'],'t2'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_name']),$_smarty_tpl);?>
"> 
	<meta name="keywords" content="<?php echo fn_keywords(array('k1'=>$_smarty_tpl->tpl_vars['product']->value['p_keywords'],'k2'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_keywords']),$_smarty_tpl);?>
"> 
	<meta name="description" content="<?php echo fn_description(array('d1'=>$_smarty_tpl->tpl_vars['product']->value['p_description'],'d2'=>$_smarty_tpl->tpl_vars['producttype']->value['pt_description']),$_smarty_tpl);?>
" />
	
	<link rel="icon" href="/images/ico.gif" type="image/x-icon" />
	<link href="/web/css/styles.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="/web/css/default.css" media="screen" rel="stylesheet" type="text/css" />

</head>

<body>
	<?php echo $_smarty_tpl->getSubTemplate ("header2.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div style="width:960px; margin:0px auto; padding:10px; background:#fff;">
		<div style="margin:10px 0px;">首页>>文章列表>>文章内容</div>
		<div>
			<div style="float:left; width:720px; padding-right:10px; border-right:1px solid #ddd; overflow:hidden; ">
				<h2 style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['product']->value['p_name'];?>
</h2>
				<div style="padding:10px 0px; margin:10px 0px; text-align:center; border:1px dotted #eee; font-size:12px;">
					更新日期: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['product']->value['p_updatedate'],'%Y-%m-%d');?>
 / 浏览次数: <?php echo $_smarty_tpl->tpl_vars['product']->value['p_viewcount'];?>

				</div>
				<div style="line-height:26px"><?php echo $_smarty_tpl->tpl_vars['product']->value['p_content'];?>
</div>
			</div>
			<div style="float:left; width:218px; padding:5px;">
				
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	
	<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>