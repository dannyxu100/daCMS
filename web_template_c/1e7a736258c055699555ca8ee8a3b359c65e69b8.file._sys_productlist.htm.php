<?php /* Smarty version Smarty-3.1.13, created on 2013-06-19 20:20:29
         compiled from "_sys_productlist.htm" */ ?>
<?php /*%%SmartyHeaderCode:2242551c1a20d23c978-01334206%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e7a736258c055699555ca8ee8a3b359c65e69b8' => 
    array (
      0 => '_sys_productlist.htm',
      1 => 1371313634,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2242551c1a20d23c978-01334206',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'producttype' => 0,
    'productset' => 0,
    'pager_Total' => 0,
    'pager_Number' => 0,
    'pager_Prev' => 0,
    'pager_Links' => 0,
    'pager_Next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c1a20d7668b8_89810402',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c1a20d7668b8_89810402')) {function content_51c1a20d7668b8_89810402($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\work\\daCMS\\plugin\\smarty\\plugins\\modifier.date_format.php';
?>﻿
<?php if ("SINGLEPAGE"==$_smarty_tpl->tpl_vars['producttype']->value['pt_style']){?>
	

<?php }elseif("LIST"==$_smarty_tpl->tpl_vars['producttype']->value['pt_style']){?>
	<div>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['name'] = "list";
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['productset']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = (int)$_smarty_tpl->tpl_vars['pager_Total']->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total']);
?>
		<div style="margin:10px 0px;">
			<span><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['list']['index']+1;?>
</span>. 
			<a href="<?php echo fn_urlstatic(array('url'=>('/web/product/productdetail.php?pid=').($_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_id'])),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_name'];?>
</a>
			- <span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_updatedate'],'%Y-%m-%d');?>
</span>
		</div>
	<?php endfor; endif; ?> 
	</div>
	
<?php }elseif("ICONLIST"==$_smarty_tpl->tpl_vars['producttype']->value['pt_style']){?>
	<div>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['name'] = "list";
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['productset']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = (int)$_smarty_tpl->tpl_vars['pager_Total']->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total']);
?>
		<div style=" height:80px; padding:30px 0px; border-bottom:1px dotted #ddd;">
			<img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_img'])===null||$tmp==='' ? '/images/no_img.gif' : $tmp);?>
" style="float:left; margin:0px 20px 10px 0px; width:120px; height:80px;vertical-align:top;"/>
			<a href="<?php echo fn_urlstatic(array('url'=>('/web/product/productdetail.php?pid=').($_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_id'])),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_name'];?>
</a>
			- <span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_updatedate'],'%Y-%m-%d');?>
</span>
			<br/>
			<span><?php echo $_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_description'];?>
</span>
		</div>
	<?php endfor; endif; ?> 
	</div>
	
<?php }elseif("ICON"==$_smarty_tpl->tpl_vars['producttype']->value['pt_style']){?>
	<div>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['name'] = "list";
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['productset']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = (int)$_smarty_tpl->tpl_vars['pager_Total']->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = true;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['total']);
?>
		<div style="float:left;width:160px; height:180px; margin:10px; overflow:hidden;">
			<img style="width:160px; height:100px; margin-bottom:10px;" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_img'])===null||$tmp==='' ? '/images/no_img.gif' : $tmp);?>
" />
			<div style="text-align:center;"><a href="<?php echo fn_urlstatic(array('url'=>('/web/product/productdetail.php?pid=').($_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_id'])),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['productset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['p_name'];?>
</a></div>
		</div>
	<?php endfor; endif; ?>
		<div style="clear:both;"></div>
	</div>
<?php }?>

<div class="daPage">
总共<?php echo $_smarty_tpl->tpl_vars['pager_Total']->value;?>
条，共<?php echo $_smarty_tpl->tpl_vars['pager_Number']->value;?>
页，<?php echo $_smarty_tpl->tpl_vars['pager_Prev']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Links']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Next']->value;?>

</div>


<?php }} ?>