<?php /* Smarty version Smarty-3.1.13, created on 2013-07-07 20:18:05
         compiled from "_sys_productdetail.htm" */ ?>
<?php /*%%SmartyHeaderCode:2487751d9541069b2e2-41437521%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4cad5998773cce903c4948a8d8e0e80e28e5255e' => 
    array (
      0 => '_sys_productdetail.htm',
      1 => 1373199483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2487751d9541069b2e2-41437521',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51d954106c3d60_93149130',
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d954106c3d60_93149130')) {function content_51d954106c3d60_93149130($_smarty_tpl) {?>﻿<div>
	<div style="float:left; margin-right:20px; border:1px solid #ccc; background:#fff; overflow:hidden;">
		<img src="<?php echo $_smarty_tpl->tpl_vars['product']->value['p_img'];?>
" style="width:250px; height:300px; border:0px;"/>
	</div>
	<div style="float:left; width:300px; padding:2px; overflow:hidden; font-size:12px" >
		<h2 style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['product']->value['p_name'];?>
</h2>
		<div style="color:#c00; font-weight:bold; margin-bottom:30px;"><?php echo $_smarty_tpl->tpl_vars['product']->value['p_abstract'];?>
</div>
		<div style="margin:10px 0px;">
			<span style="display:inline-block; color:#aaa; width:80px;">市场价:</span>
			<span style="font-weight:bold;text-decoration:line-through;">￥<?php echo $_smarty_tpl->tpl_vars['product']->value['p_marketprice'];?>
</span>
		</div>
		<div style="margin:10px 0px;">
			<span style="display:inline-block; color:#aaa; width:80px;">销售价:</span>
			<span style="font-weight:bold; font-size:26px; color:#c00">￥<?php echo $_smarty_tpl->tpl_vars['product']->value['p_saleprice'];?>
</span>
		</div>
		<div style="margin:10px 0px;">
			<span style="display:inline-block; color:#aaa; width:80px;">编号:</span>
			<span style=""><?php echo $_smarty_tpl->tpl_vars['product']->value['p_code'];?>
</span>
		</div>
		<div style="margin:10px 0px;">
			<span style="display:inline-block; color:#aaa; width:80px;">货号:</span>
			<span style="font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['product']->value['p_no'];?>
</span>
		</div>
		<div style="margin:10px 0px;">
			<span style="display:inline-block; color:#aaa; width:80px;">库存:</span>
			<span style=""><?php echo $_smarty_tpl->tpl_vars['product']->value['p_stock'];?>
</span>
		</div>
		<div style="margin:10px 0px;">
			<span style="display:inline-block; color:#aaa; width:80px;">单位:</span>
			<span style=""><?php echo $_smarty_tpl->tpl_vars['product']->value['p_unit'];?>
</span>
		</div>
		<div style="margin:10px 0px;">
			<span style="display:inline-block; color:#aaa; width:80px;">重量:</span>
			<span style=""><?php echo $_smarty_tpl->tpl_vars['product']->value['p_weight'];?>
</span>
		</div>
	</div>
	
	<div style="clear:both; margin:20px 0px 10px 0px; padding:5px 0px; border-bottom:2px solid #666; font-size:18px; font-weight:bold;">商品详细信息</div>
	<div class="text">
		<?php echo $_smarty_tpl->tpl_vars['product']->value['p_content'];?>

	</div>
</div>


<?php }} ?>