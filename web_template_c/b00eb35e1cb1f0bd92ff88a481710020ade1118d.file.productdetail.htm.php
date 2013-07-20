<?php /* Smarty version Smarty-3.1.13, created on 2013-07-07 20:26:21
         compiled from "productdetail.htm" */ ?>
<?php /*%%SmartyHeaderCode:569851d94ba95f9b13-67855180%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b00eb35e1cb1f0bd92ff88a481710020ade1118d' => 
    array (
      0 => 'productdetail.htm',
      1 => 1373199979,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '569851d94ba95f9b13-67855180',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51d94ba978e6f7_07802549',
  'variables' => 
  array (
    'product' => 0,
    'producttype' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d94ba978e6f7_07802549')) {function content_51d94ba978e6f7_07802549($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	
	<link rel="icon" href="/web/images/ico.gif" type="image/x-icon" />
	<link href="/web/css/styles.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="/web/css/default.css" media="screen" rel="stylesheet" type="text/css" />

</head>

<body>
	<?php echo $_smarty_tpl->getSubTemplate ("header2.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
	<!-- banner -->	
	<div class="welcome_bar">
		<div class="container_12 bar">
			<div class="bar-icon"><img src="/web/images/icon_pages.png" width="64" height="64" alt="" /></div>
			<div class="bar-title">
				<h1>感谢您对 <span>51tongren.com</span> 产品的关注</h1>
				<div class="breadcrumbs">
				<a href="index.html">首页</a>
				<a href="pages.html">产品列表</a> 
				<span>产品详介</span>
				</div>
			</div>
			<div class="bar-right">
				
				<div id="search-2" class="widget-container widget_search">
					<form method="get" id="searchform" action="">
						<div>
							<label class="screen-reader-text" for="s">Search for:</label>
							<input type="text" name="s" id="s" value="Search" />
							<input type="submit" id="searchsubmit"  value="Search" />
						</div>
					</form>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>	
	<!--/ banner -->   
	
	<!-- 主区域 -->    
	<div class="middle" id="sidebar_right">
		<div class="container_12">
			<div class="wrapper">
				<div class="content">
					<?php echo $_smarty_tpl->getSubTemplate ("_sys_productdetail.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				</div>
				
			</div>
			
			<!-- 右栏 -->
			<div class="sidebar">
				<div class="inner">
					
					<div class="widget-container  widget_categories">
						<h3>其他分类</h3>
						<ul>
							<li><div><a href="page-sidebar-r.html">Page with Right Sidebar</a></div></li>
							<li><div><a href="page-sidebar-l.html">Page with Left Sidebar</a></div></li>
							<li><div><a href="page-fullwidth.html">Full width Page</a></div></li>
							<li><div><a href="portfolio-sidebar-col1.html">1 col Portfolio (sidebar)</a></div></li>
							<li><div><a href="portfolio-sidebar-col2.html">2 cols Portfolio (sidebar)</a></div></li>
							<li><div><a href="portfolio-full-cols3.html">3 column Portfolio (Fullwidth)</a></div></li>
							<li><div><a href="portfolio-full-cols4.html">4 column Portfolio</a></div></li>
						</ul>
					</div>
					
					<div class="widget-container  widget_categories">
						<h3>相关产品</h3>
						<ul>
							<li><div><a href="#">Typography</a></div></li>
							<li><div><a href="#">Shortcodes</a></div></li>
							<li><div><a href="#">Easy page examples</a></div></li>
							<li><div><a href="#">Contact</a></div></li>
						</ul>
					</div>
					
					<a href="contacts.html" class="button_link large_button"><span>立即联系我们</span></a>                    
				  
				</div>
			</div>
			<!--/ 右栏 -->
			
			<div class="clear"></div>
			
			<!-- 滚动图片 -->
			<div class="minigallery-list box border">
				<a class="prev">prev</a>
				<a class="next">next</a>
				<div class="minigallery">
					<ul>
						<li><a href="/web/images/temp/slider_img_1.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_1.jpg" alt="" width="140" height="100" border="0" /></a></li>
						<li><a href="/web/images/temp/slider_img_2.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_2.jpg" alt="" width="140" height="100" border="0" /></a></li>
						<li><a href="/web/images/temp/slider_img_3.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_3.jpg" alt="" width="140" height="100" border="0" /></a></li>
						<li><a href="/web/images/temp/slider_img_4.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_4.jpg" alt="" width="140" height="100" border="0" /></a></li>
						<li><a href="/web/images/temp/slider_img_5.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_1.jpg" alt="" width="140" height="100" border="0" /></a></li>
						<li><a href="/web/images/temp/slider_img_6.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_2.jpg" alt="" width="140" height="100" border="0" /></a></li>
						<li><a href="/web/images/temp/slider_img_1.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_3.jpg" alt="" width="140" height="100" border="0" /></a></li>
						<li><a href="/web/images/temp/slider_img_2.jpg" rel="prettyPhoto[gallery1]"><img src="/web/images/temp/gallery_img_4.jpg" alt="" width="140" height="100" border="0" /></a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<!--/ 滚动图片 -->
		</div>	
		
	</div>
	<!--/ 主区域 -->      

	<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>

<script type="text/javascript" language="javascript" src="/web/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="javascript" src="/web/js/general.js"></script><?php }} ?>