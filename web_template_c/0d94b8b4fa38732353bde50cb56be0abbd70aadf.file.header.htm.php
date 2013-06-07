<?php /* Smarty version Smarty-3.1.13, created on 2013-06-06 17:27:24
         compiled from "E:\workfiles\daCMS\web\header.htm" */ ?>
<?php /*%%SmartyHeaderCode:154751b02c348bb647-28695880%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d94b8b4fa38732353bde50cb56be0abbd70aadf' => 
    array (
      0 => 'E:\\workfiles\\daCMS\\web\\header.htm',
      1 => 1370510829,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154751b02c348bb647-28695880',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51b02c348ed984_83938265',
  'variables' => 
  array (
    'navset' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b02c348ed984_83938265')) {function content_51b02c348ed984_83938265($_smarty_tpl) {?><div class="header_img" id="aside2">
<!-- header -->
    <div class="topnav">
    	<div class="container_12">
        
			<div class="logo"><a href="index.html"><img src="images/logo.png" alt="ENVISION" border="0" /></a></div>

			<!-- topmenu -->            
			<div class="menu-header">
			
				<ul class="topmenu">
					<li class="parent first current-menu-item"><a href="#"><span>Sliders</span></a>
						<ul class="sub-menu">
							<li class="first"><a href="index.html"><span>关于我们</span></a></li>
							<li><a href="index-slider-images.html"><span>Nivo slider</span></a></li>
							<li><a href="index-slider-text.html"><span>Text / Video slider</span></a></li>                        
						</ul>
					</li>
					<li class="parent"><a href="#"><span>Pages</span></a>
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
				  <li class="parent"><a href="#"><span>Styles</span></a>
						<ul class="sub-menu">
							<li class="first"><a href="styles-columns.html"><span>Column Shortcodes</span></a></li>
							<li><a href="styles-typography.html"><span>Typography</span></a></li>
							<li class="last"><a href="styles-shortcodes.html"><span>HTML Shortcodes</span></a></li>                        
						</ul>
				  </li>
				  <li class="parent"><a href="#"><span>Portfolio</span></a>
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
				  <li><a href="blog.html"><span>Blog</span></a></li>
				  <li class="last"><a href="contacts.html"><span>Contact</span></a></li>
			  </ul>
			</div>
			<!--/ topmenu -->        
			
		</div>            
    </div>

	<!-- slider -->
    <div class="container_12">
        <div class="slider">
            	<div id="header_images">
					<img src="images/slider/image_1.jpg" class="header_image" color="#17191e" alt="" link="#link1" />
                    <img src="images/slider/image_2.jpg" class="header_image" color="#054065" alt="" link="#link2" />
                    <img src="images/slider/image_3.jpg" class="header_image" color="#3f0731" alt="" link="#link3" />
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