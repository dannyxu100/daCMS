<?php /* Smarty version Smarty-3.1.13, created on 2013-06-12 12:38:57
         compiled from "D:\work\daCMS\web\header2.htm" */ ?>
<?php /*%%SmartyHeaderCode:939251b7fb61ee7012-67355599%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19bbc79a4a10c75ce83cbc47c7fa05e8ff789c01' => 
    array (
      0 => 'D:\\work\\daCMS\\web\\header2.htm',
      1 => 1370890337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '939251b7fb61ee7012-67355599',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'webconfig' => 0,
    'navset1' => 0,
    'k' => 0,
    'nav1' => 0,
    'navset2' => 0,
    'nav2' => 0,
    'navset3' => 0,
    'nav3' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51b7fb62202649_66856910',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b7fb62202649_66856910')) {function content_51b7fb62202649_66856910($_smarty_tpl) {?><div class="header_img" id="aside2">
<!-- header -->
    <div class="topnav" style="background:#222;">
    	<div class="container_12">
        
			<div class="logo"><a href="/"><img src="<?php echo $_smarty_tpl->tpl_vars['webconfig']->value['c_img'];?>
" alt="ENVISION" border="0" /></a></div>

			<!-- topmenu -->            
			<div class="menu-header">
				<ul class="topmenu">
				<!-- 最多三级菜单 -->
					<?php  $_smarty_tpl->tpl_vars['nav1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nav1']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navset1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nav1']->key => $_smarty_tpl->tpl_vars['nav1']->value){
$_smarty_tpl->tpl_vars['nav1']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['nav1']->key;
?>
						<li class="parent <?php if (0==$_smarty_tpl->tpl_vars['k']->value){?> first current-menu-item <?php }elseif(count($_smarty_tpl->tpl_vars['navset1']->value)-1==$_smarty_tpl->tpl_vars['k']->value){?> last <?php }?>">
							<a href="<?php echo $_smarty_tpl->tpl_vars['nav1']->value['n_url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['nav1']->value['n_name'];?>
"><span><?php echo $_smarty_tpl->tpl_vars['nav1']->value['n_name'];?>
</span></a>
							<ul class="sub-menu">
							<?php  $_smarty_tpl->tpl_vars['nav2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nav2']->_loop = false;
 $_smarty_tpl->tpl_vars['k2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navset2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nav2']->key => $_smarty_tpl->tpl_vars['nav2']->value){
$_smarty_tpl->tpl_vars['nav2']->_loop = true;
 $_smarty_tpl->tpl_vars['k2']->value = $_smarty_tpl->tpl_vars['nav2']->key;
?>
								<?php if (($_smarty_tpl->tpl_vars['nav1']->value['n_id']==$_smarty_tpl->tpl_vars['nav2']->value['n_pid'])){?>
								<li class="parent <?php if (0==$_smarty_tpl->tpl_vars['k']->value){?> first current-menu-item <?php }elseif(count($_smarty_tpl->tpl_vars['navset1']->value)-1==$_smarty_tpl->tpl_vars['k']->value){?> last <?php }?>">
									<a href="<?php echo $_smarty_tpl->tpl_vars['nav2']->value['n_url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['nav2']->value['n_name'];?>
"><span><?php echo $_smarty_tpl->tpl_vars['nav2']->value['n_name'];?>
</span></a>
									<ul class="sub-menu">
									<?php  $_smarty_tpl->tpl_vars['nav3'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nav3']->_loop = false;
 $_smarty_tpl->tpl_vars['k3'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navset3']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nav3']->key => $_smarty_tpl->tpl_vars['nav3']->value){
$_smarty_tpl->tpl_vars['nav3']->_loop = true;
 $_smarty_tpl->tpl_vars['k3']->value = $_smarty_tpl->tpl_vars['nav3']->key;
?>
										<?php if (($_smarty_tpl->tpl_vars['nav2']->value['n_id']==$_smarty_tpl->tpl_vars['nav3']->value['n_pid'])){?>
										<li class="parent <?php if (0==$_smarty_tpl->tpl_vars['k']->value){?> first current-menu-item <?php }elseif(count($_smarty_tpl->tpl_vars['navset1']->value)-1==$_smarty_tpl->tpl_vars['k']->value){?> last <?php }?>">
											<a href="<?php echo $_smarty_tpl->tpl_vars['nav3']->value['n_url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['nav3']->value['n_name'];?>
"><span><?php echo $_smarty_tpl->tpl_vars['nav3']->value['n_name'];?>
</span></a>
										</li>
										<?php }?>
									<?php } ?>
									</ul>
								</li>
								<?php }?>
							<?php } ?>
							</ul>
						</li>
					<?php } ?>
			  </ul>
			</div>
			<!--/ topmenu -->        
			
		</div>            
    </div>

</div>
<!--/ header -->



<?php }} ?>