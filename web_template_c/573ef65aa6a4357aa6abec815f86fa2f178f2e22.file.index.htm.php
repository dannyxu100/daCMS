<?php /* Smarty version Smarty-3.1.13, created on 2013-06-24 21:05:33
         compiled from "D:\work\daCMS\web\index.htm" */ ?>
<?php /*%%SmartyHeaderCode:2348251c8441d3c7297-68794663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '573ef65aa6a4357aa6abec815f86fa2f178f2e22' => 
    array (
      0 => 'D:\\work\\daCMS\\web\\index.htm',
      1 => 1248944874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2348251c8441d3c7297-68794663',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c8441d45b5b8_77251310',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c8441d45b5b8_77251310')) {function content_51c8441d45b5b8_77251310($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>home</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript" charset="utf-8">
// <![CDATA[
$(document).ready(function(){	
	$("#slider").easySlider({
		controlsBefore:	'<p id="controls">',
		controlsAfter:	'</p>',
		auto: true, 
		continuous: true
	});	
});
// ]]>
</script>
<style type="text/css">
#slider { margin:0; padding:0; list-style:none; }
#slider ul,
#slider li { margin:0; padding:0; list-style:none; }
/* 
    define width and height of list item (slide)
    entire slider area will adjust according to the parameters provided here
*/
#slider li { width:906px; height:386px; overflow:hidden; }
p#controls { margin:0; position:relative; }
#prevBtn,
#nextBtn { display:block; margin:0; overflow:hidden; width:44px; height:44px; position:absolute; left:0; top:-250px; }
#nextBtn { left:862px; }
#prevBtn a { display:block; width:44px; height:44px; background:url(images/l_arrow.gif) no-repeat 0 0; }
#nextBtn a { display:block; width:44px; height:44px; background:url(images/r_arrow.gif) no-repeat 0 0; }
</style>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="block_header">
      <div class="logo"><a href="index.html"><img src="images/logo.gif" width="401" height="145" border="0" alt="logo" /></a></div>
      <div class="menu">
        <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="services.html">About us</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
      <div class="clr"> </div>
    </div>
  </div>
  <div class="slider">
    <div class="slice1">
      <div id="slider">
        <ul>
          <li>
            <div class="top" style="background:url(images/sliser_bg_img_1.jpg) top no-repeat;">
              <h2>Dummy text of the printing and typesetting industry.</h2>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer. <a href="#">Simply dummy text of the printing</a> and typesetting industry. Lorem Ipsum has been the industry's </p>
            </div>
            <div class="bot">
            <div class="lister">
                <p class="active">1</p>
                <p>2</p>
                <p>3</p>
              </div>
              <h2>Simply dummy text</h2>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since.</p>
            </div>
          </li>
          <li>
            <div class="top" style="background:url(images/sliser_bg_img_2.jpg) top no-repeat;">
              <h2>Dummy text of the printing and typesetting industry.</h2>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer. <a href="#">Simply dummy text of the printing</a> and typesetting industry. Lorem Ipsum has been the industry's </p>
            </div>
            <div class="bot">
            <div class="lister">
                <p>1</p>
                <p class="active">2</p>
                <p>3</p>
              </div>
              <h2>Simply dummy text</h2>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since.</p>
            </div>
          </li>
          <li>
            <div class="top" style="background:url(images/sliser_bg_img_3.jpg) top no-repeat;">
              <h2>Dummy text of the printing and typesetting industry.</h2>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since the when an unknown printer. <a href="#">Simply dummy text of the printing</a> and typesetting industry. Lorem Ipsum has been the industry's </p>
            </div>
            <div class="bot">
            <div class="lister">
                <p>1</p>
                <p>2</p>
                <p class="active">3</p>
              </div>
              <h2>Simply dummy text</h2>
              <p>Lorem Ipsum has been the industry's standard dummy text ever since.</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>  
  <div class="body">
    <div class="body_resize">
      <div class="Author">
        <h2>About the Author</h2>
        <img src="images/img_1.gif" alt="picture" width="97" height="89" hspace="20" vspace="5" />
        <p>Lorem Ipsum has been the industry's standard dummy text ever since thes, when an unknown printer.<a href="#"> Simply dummy text</a> of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since thes, when an unknown printer.</p>
        <p><a href="#"><img src="images/read_more.gif" alt="picture" width="68" height="20" border="0" /></a></p>
      </div>
      <div class="animator">
        <p><img src="images/img_4.gif" alt="picture" width="169" height="126" /> <img src="images/img_3.gif" alt="picture" width="169" height="126" /><img src="images/img_2.gif" alt="picture" width="170" height="126" /></p>
        <h2>Dummy text of the printing and typesetting industry.</h2>
        <p>Lorem Ipsum has been the industry's standard dummy text ever since thes,<a href="#"> when an unknown printer. Simply dummy text</a> of the printing and typesetting industry. </p>
      </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
  <div class="FBG">
    <div class="Fbg_resize">
      <div class="Twitter">
        <p><img src="images/Twitter.gif" alt="picture" width="129" height="96" /></p>
        <p><strong>Lorem Ipsum has been</strong> The industry's standard dummy text ever since thes. <a href="#"><img src="images/read_more.gif" alt="picture" width="68" height="20" border="0" /></a></p>
      </div>
      <div class="con">
        <h2>Contact us</h2>
        <ul>
          <li>Name of the Company</li>
          <li> 2901 Marmora Road, Glassgow, D04 59GR</li>
          <li> Telephone: +1 234 567 8910</li>
        </ul>
        <ul>
          <li>FAX: +1 234 567 8910</li>
          <li>E-mail: <a href="#">mail@yoursitename.com</a></li>
        </ul>
      </div>
    </div>
    <div class="clr"></div>
  </div>
  <div class="footer">
    <div class="resize">
      <div>Copyright © Sitename.com. <a href="http://dreamtemplate.com/">dreamtemplate.com</a>. All Rights Reserved<br />
        <a href="index.html">Home</a> | <a href="contact.html">Contact</a> | <a href="blog.html">RSS</a></div>
    </div>
    <p class="clr"></p>
  </div>
</div>
</body>
</html><?php }} ?>