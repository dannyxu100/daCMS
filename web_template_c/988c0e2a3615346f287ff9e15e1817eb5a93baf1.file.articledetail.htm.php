<?php /* Smarty version Smarty-3.1.13, created on 2013-07-07 20:28:44
         compiled from "articledetail.htm" */ ?>
<?php /*%%SmartyHeaderCode:2006551d95efc2fbc47-15483843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '988c0e2a3615346f287ff9e15e1817eb5a93baf1' => 
    array (
      0 => 'articledetail.htm',
      1 => 1373097767,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2006551d95efc2fbc47-15483843',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'article' => 0,
    'articletype' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51d95efc502112_37280376',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d95efc502112_37280376')) {function content_51d95efc502112_37280376($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\work\\daCMS\\action\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['article']->value['a_title'],'t2'=>$_smarty_tpl->tpl_vars['articletype']->value['at_name']),$_smarty_tpl);?>
</title>
	<meta name="title" content="<?php echo fn_title(array('t1'=>$_smarty_tpl->tpl_vars['article']->value['a_title'],'t2'=>$_smarty_tpl->tpl_vars['articletype']->value['at_name']),$_smarty_tpl);?>
"> 
	<meta name="keywords" content="<?php echo fn_keywords(array('k1'=>$_smarty_tpl->tpl_vars['article']->value['a_keywords'],'k2'=>$_smarty_tpl->tpl_vars['articletype']->value['at_keywords']),$_smarty_tpl);?>
"> 
	<meta name="description" content="<?php echo fn_description(array('d1'=>$_smarty_tpl->tpl_vars['article']->value['a_description'],'d2'=>$_smarty_tpl->tpl_vars['articletype']->value['at_description']),$_smarty_tpl);?>
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
				<h2 style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['article']->value['a_title'];?>
</h2>
				<div style="padding:10px 0px; margin:10px 0px; text-align:center; border:1px dotted #eee; font-size:12px;">
					更新日期: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value['a_updatedate'],'%Y-%m-%d');?>
 / 浏览次数: <?php echo $_smarty_tpl->tpl_vars['article']->value['a_count'];?>

				</div>
				<div class="art_content" style="line-height:26px"><?php echo $_smarty_tpl->tpl_vars['article']->value['a_content'];?>
</div>
				<?php echo $_smarty_tpl->getSubTemplate ("article/_sys_articlecomment.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</div>
			<div style="float:left; width:218px; padding:5px;">
				
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	
	<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>

<script type="text/javascript" language="javascript" src="/web/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/general.js"></script><?php }} ?>