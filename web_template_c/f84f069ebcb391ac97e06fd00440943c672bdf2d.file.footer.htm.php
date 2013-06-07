<?php /* Smarty version Smarty-3.1.13, created on 2013-06-06 17:11:25
         compiled from "E:\workfiles\daCMS\web\footer.htm" */ ?>
<?php /*%%SmartyHeaderCode:740051b02c34902540-90168192%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f84f069ebcb391ac97e06fd00440943c672bdf2d' => 
    array (
      0 => 'E:\\workfiles\\daCMS\\web\\footer.htm',
      1 => 1370509883,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '740051b02c34902540-90168192',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51b02c349298a7_34948310',
  'variables' => 
  array (
    'webconfig' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b02c349298a7_34948310')) {function content_51b02c349298a7_34948310($_smarty_tpl) {?>﻿<!-- footer -->
<div class="footer">
<div class="footer_bg">
	<div class="container_12">
    
    	<div class="col_1_4 col">
	        <div class="inner">
            	<h3>我们做什么</h3>
            	<ul>
                	<li><a href="#">Interactive Technology</a></li>
                    <li><a href="#">Online Marketing</a></li>
                    <li><a href="#">Website Design</a></li>
                    <li><a href="#">Strategy &amp; Analysis</a></li>
                    <li><a href="#">E-Learning</a></li>
                </ul>
            </div>
        </div>
        
        <div class="col_1_4 col">
          <div class="inner">
            	<h3>我们是谁</h3>
            	<ul>
                	<li><a href="#">About us</a></li>
                    <li><a href="#">Our History</a></li>
                    <li><a href="#">Vision that drives us</a></li>
                    <li><a href="#">The Mission</a></li>
                </ul>
            </div>
        </div>
        
        <div class="col_1_4 col">
          <div class="inner">
            	<h3>特色产品</h3>
            	<ul>
                	<li><a href="#">Silicon App</a></li>
                    <li><a href="#">Art Gallery</a></li>
                    <li><a href="#">Bon Apetit </a></li>
                    <li><a href="#">Exquisite Works</a></li>
                    <li><a href="#">Clean Classy Corp</a></li>
                </ul>
            </div>
        </div>
        
        <div class="col_1_4 col">
          <div class="inner">
            	<h3>我们的博客</h3>
            	<ul>
                	<li><a href="#">Just released WS 2.3</a></li>
                    <li><a href="#">Not going to support IE6...</a></li>
                    <li><a href="#">Great feedback from...</a></li>
                    <li><a href="#">Don’t ask when!</a></li>
                    <li><a href="#">Best tutorial on jQuery</a></li>
                </ul>
            </div>
        </div>
        
      <div class="divider_space"></div>
    	
        <div class="col_2_3 col">
	        <div class="inner">
            	<a href="#" class="link-twitter" title="Twitter">Twitter</a>
                <a href="#" class="link-fb" title="Facebook">Facebook</a>
                <a href="#" class="link-flickr" title="Flickr">Flickr</a>
                <a href="#" class="link-da" title="deviantART">deviantART</a>
                <a href="#" class="link-rss" title="RSS Feed">RSS Feed</a>            </div>
        </div>
        
        <div class="col_1_3 col">
	        <div class="inner">
            	<p class="copyright">&copy; 2013 <a href="http://sc.chinaz.com/" target="_blank">sc.chinaz.com</a>. Please don’t steal!</p>
          </div>
      </div>
        <div class="clear"></div>
    </div>
</div>
</div>
<!--/ footer -->

<div class="foot">
公司名称：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_company'];?>
<br/>
地址：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_address'];?>
<br/>
联系人：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_user'];?>
<br/>
电话：<?php echo $_smarty_tpl->tpl_vars['webconfig']->value[0]['c_phone'];?>
<br/>
</div><?php }} ?>