<?php /* Smarty version Smarty-3.1.13, created on 2013-06-12 12:46:02
         compiled from "D:\work\daCMS\web\header.htm" */ ?>
<?php /*%%SmartyHeaderCode:2351651b7fd0a09dd03-75504450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c6d9f1114a323e2541d0cda3a8fc693bbab1e9e' => 
    array (
      0 => 'D:\\work\\daCMS\\web\\header.htm',
      1 => 1370890325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2351651b7fd0a09dd03-75504450',
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
    'navset' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51b7fd0a3aeb88_44332827',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b7fd0a3aeb88_44332827')) {function content_51b7fd0a3aeb88_44332827($_smarty_tpl) {?>
<div class="header_img" id="aside2">
<!-- header -->
    <div class="topnav">
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
					
					<!--
					<li class="parent first current-menu-item"><a href="#"><span>首页</span></a>
						<ul class="sub-menu">
							<li class="first"><a href="index.html"><span>关于我们</span></a></li>
							<li><a href="index-slider-images.html"><span>Nivo slider</span></a></li>
							<li><a href="index-slider-text.html"><span>Text / Video slider</span></a></li>                        
						</ul>
					</li>
					<li class="parent"><a href="#"><span>产品</span></a>
						<ul class="sub-menu">
							<li class="first"><a href="page-sidebar-r.html"><span>Pages with Sidebar</span></a></li>
							<li class="parent"><a href="#"><span>Portfolio pages</span></a>
								<ul class="sub-menu">
									<li class="first"><a href="portfolio.html"><span>1 column with Sidebar</span></a></li>
									<li><a href="portfolio-2cols.html"><span>2 columns with Sidebar</span></a></li>
									<li><a href="portfolio-3cols.html"><span>3 columns Full Width</span></a></li>
									<li class="last"><a href="portfolio-4cols.html"><span>4 columns Full Width</span></a></li>
								 </ul>
							</li>
							<li class="last"><a href="page-pricing.html"><span>Pricing page</span></a></li>
						</ul>
				  </li>
				  <li class="parent"><a href="#"><span>案例</span></a>
						<ul class="sub-menu">
							<li class="first"><a href="styles-columns.html"><span>Column Shortcodes</span></a></li>
							<li><a href="styles-typography.html"><span>Typography</span></a></li>
							<li class="last"><a href="styles-shortcodes.html"><span>HTML Shortcodes</span></a></li>                        
						</ul>
				  </li>
				  <li class="parent"><a href="#"><span>互联网</span></a>
						<ul class="sub-menu">
							<li class="first parent"><a href="#"><span>With sidebar</span></a>
								<ul class="sub-menu">
									<li class="first"><a href="portfolio.html"><span>1 column</span></a></li>
									<li class="last"><a href="portfolio-2cols.html"><span>2 columns</span></a></li>
								 </ul>
							</li>
							<li class="parent last"><a href="#"><span>Full width</span></a>	
								<ul class="sub-menu">
									<li><a href="portfolio-3cols.html"><span>3 columns</span></a></li>
									<li class="last"><a href="portfolio-4cols.html"><span>4 columns</span></a></li>
								 </ul>
							</li>										
						</ul>
				  </li>
				  <li><a href="blog.html"><span>博客</span></a></li>
				  <li class="last"><a href="contacts.html"><span>联系我们</span></a></li>
				  -->
			  </ul>
			</div>
			<!--/ topmenu -->        
			
		</div>            
    </div>

	<!-- slider -->
    <div class="container_12">
        <div class="slider">
            	<div id="header_images">
					<img src="/web/images/slider/image_1.jpg" class="header_image" color="#17191e" alt="" link="#link1" />
                    <img src="/web/images/slider/image_2.jpg" class="header_image" color="#054065" alt="" link="#link2" />
                    <img src="/web/images/slider/image_3.jpg" class="header_image" color="#3f0731" alt="" link="#link3" />
				</div>
                <div class="header_controls">            
					<a href="#" id="header_controls_left">Previous</a>
					<a href="#" id="header_controls_right">Next</a>
				</div>
                <div id="overlay_bg"></div>
        </div>
    </div>
	<!--/ slider -->    

</div>

<!--/ header -->

<!--
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
-->


<?php }} ?>