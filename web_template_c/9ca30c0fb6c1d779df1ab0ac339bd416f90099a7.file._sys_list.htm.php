<?php /* Smarty version Smarty-3.1.13, created on 2013-06-12 13:37:15
         compiled from "_sys_list.htm" */ ?>
<?php /*%%SmartyHeaderCode:2845751b7fb6223c871-41892219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ca30c0fb6c1d779df1ab0ac339bd416f90099a7' => 
    array (
      0 => '_sys_list.htm',
      1 => 1371015433,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2845751b7fb6223c871-41892219',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51b7fb6258a320_58461294',
  'variables' => 
  array (
    'articletype' => 0,
    'articleset' => 0,
    'pager_Total' => 0,
    'pager_Number' => 0,
    'pager_Prev' => 0,
    'pager_Links' => 0,
    'pager_Next' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b7fb6258a320_58461294')) {function content_51b7fb6258a320_58461294($_smarty_tpl) {?>
<?php if ("SINGLEPAGE"==$_smarty_tpl->tpl_vars['articletype']->value['at_style']){?>
	<!-- 单页面 -->

	<!--/ 单页面 -->
	
<?php }elseif("LIST"==$_smarty_tpl->tpl_vars['articletype']->value['at_style']){?>
	<!-- 列表 -->
	<div>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['name'] = "list";
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['articleset']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<a href="/web/article/articledetail.php<?php echo fn_sethtmlurl(array('aid'=>$_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_id']),$_smarty_tpl);?>
">
				<?php echo $_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_title'];?>

			</a>
			- <span><?php echo $_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_updatedate'];?>
</span>
		</div>
	<?php endfor; endif; ?> 
	</div>
    <div class="daPage">
    总共<?php echo $_smarty_tpl->tpl_vars['pager_Total']->value;?>
条，共<?php echo $_smarty_tpl->tpl_vars['pager_Number']->value;?>
页，<?php echo $_smarty_tpl->tpl_vars['pager_Prev']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Links']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Next']->value;?>

    </div>

	<!--/ 列表 -->
	
<?php }elseif("ICONLIST"==$_smarty_tpl->tpl_vars['articletype']->value['at_style']){?>
	<!-- 略缩图 -->
	<div>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['name'] = "list";
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['articleset']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_img'])===null||$tmp==='' ? '/images/no_img.gif' : $tmp);?>
" style="float:left; margin:0px 20px 10px 0px; width:120px; height:80px;vertical-align:top;"/>
			<a href="/web/article/articledetail.php<?php echo fn_sethtmlurl(array('aid'=>$_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_id']),$_smarty_tpl);?>
">
				<?php echo $_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_title'];?>

			</a>
			- <span><?php echo $_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_updatedate'];?>
</span>
			<br/>
			<span><?php echo $_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_description'];?>
</span>
		</div>
	<?php endfor; endif; ?> 
	</div>
    <div class="daPage">
    总共<?php echo $_smarty_tpl->tpl_vars['pager_Total']->value;?>
条，共<?php echo $_smarty_tpl->tpl_vars['pager_Number']->value;?>
页，<?php echo $_smarty_tpl->tpl_vars['pager_Prev']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Links']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Next']->value;?>

    </div>

	<!--/ 略缩图 -->
	
<?php }elseif("ICON"==$_smarty_tpl->tpl_vars['articletype']->value['at_style']){?>
	<!-- 九宫格 -->
	<div>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["list"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['name'] = "list";
$_smarty_tpl->tpl_vars['smarty']->value['section']["list"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['articleset']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<img style="width:160px; height:100px; margin-bottom:10px;" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_img'])===null||$tmp==='' ? '/images/no_img.gif' : $tmp);?>
" />
			<div style="text-align:center;">
				<a href="/web/article/articledetail.php<?php echo fn_sethtmlurl(array('aid'=>$_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_id']),$_smarty_tpl);?>
">
					<?php echo $_smarty_tpl->tpl_vars['articleset']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['a_title'];?>

				</a>
			</div>
		</div>
	<?php endfor; endif; ?>
		<div style="clear:both;"></div>
	</div>
    <div class="daPage">
    总共<?php echo $_smarty_tpl->tpl_vars['pager_Total']->value;?>
条，共<?php echo $_smarty_tpl->tpl_vars['pager_Number']->value;?>
页，<?php echo $_smarty_tpl->tpl_vars['pager_Prev']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Links']->value;?>
<?php echo $_smarty_tpl->tpl_vars['pager_Next']->value;?>

    </div>

	<!--/ 九宫格 -->
	
<?php }elseif("USERDEFINED"==$_smarty_tpl->tpl_vars['articletype']->value['at_style']){?>
	<!-- 自定义 -->
	
	<!--/ 自定义 -->
<?php }?>


<?php }} ?>