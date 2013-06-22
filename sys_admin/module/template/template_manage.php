<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>设计套餐管理</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
		
	<style type="text/css">
	*{margin:0;padding:0;}
	body{font-size:12px;color:#222;font-family:Verdana,Arial,Helvetica,sans-serif;}
	.clearfix:after{content: ".";display: block;height: 0;clear: both;visibility: hidden;}
	.clearfix{zoom:1;}
	ul,li{list-style:none;}
	img{border:0;}
	
	.wrapper{width:400px; padding:10px; background:#fff;}
	/* focus */
	#focus{width:400px;height:290px;overflow:hidden;position:relative;border:1px solid #666;}
	#focus ul{height:290px;position:absolute;}
	#focus ul li{float:left;width:400px;height:290px;overflow:hidden;position:relative;background:#fff;}
	#focus ul li img{width:400px;height:290px;}
	#focus ul li div{position:absolute;overflow:hidden;}
	#focus .btnBg{position:absolute;width:400px;height:20px;left:0;bottom:0;background:#000;}
	#focus .btn{position:absolute;width:780px;height:10px;padding:5px 10px;right:0;bottom:0;text-align:right;}
	#focus .btn span{display:inline-block;_display:inline;_zoom:1;width:25px;height:10px;_font-size:0;margin-left:5px;cursor:pointer;background:#fff;}
	#focus .btn span.on{background:#fff;}
	#focus .preNext{width:45px;height:100px;position:absolute;top:80px;background:url(/images/sprite.png) no-repeat 0 0;cursor:pointer;}
	#focus .pre{left:0;}
	#focus .next{right:0;background-position:right top;}
	</style>

 </HEAD>
<BODY>
<div>
	<div style="padding:20px 10px; width:960px;">
		<div style="float:left; margin-right:20px;">
			<!-- wrapper -->
			<div class="wrapper daShadow">
				<!--focus-->
				<div id="focus">
				</div>
				<!--/ focus-->
			</div>
			<!--/ wrapper -->
		</div>
		<div style="float:left; width:500px;">
			<div style="margin-bottom:5px;">
				<div>
					<a href="javascript:void(0)" class="bt_link" onclick="backuptemplate();"><img src="/images/sys_icon/save.png"/> 备份当前模板</a>
					<a href="javascript:void(0)" class="bt_link" onclick="restoretemplate()"><img src="/images/sys_icon/refresh.png"/> 还原模板</a>
				</div>
				
				<div style="padding:4px 0px;">
					<span style="font-weight:bold; color:#666;margin-right:15px;">模板名称</span><span id="tl_name"></span> 
				</div>
				<div style="padding:4px 0px;">
					<span style="font-weight:bold; color:#666;margin-right:15px;">模板编号</span><span id="tl_code"></span>
				</div>
				<div style="padding:4px 0px;">
					<span style="font-weight:bold; color:#666;margin-right:15px;">链接地址</span><span id="tl_url"></span>
				</div>
				<div style="padding:4px 0px;">
					<span style="font-weight:bold; color:#666;margin-right:15px;">发布日期</span><span id="tl_date"></span>
				</div>
				<div style="padding:4px 0px; height:18px; overflow:hidden;">
					<span style="font-weight:bold; color:#666;margin-right:15px;">模板简介</span><span id="tl_description"></span>
				</div>
			</div>
			<div>
				<div class="daShadow" style="width:90px;height:140px;float:left;padding:2px; margin-right:20px; text-align:right; background:#fff;">
					<img style="width:85px;height:100px;margin:2px;border:1px solid #666;" src="/web/_sys_templateinfo/designer.jpg"/>
					<div><span style="color:#999;">设计师</span><br/><span id="tl_designer"></span></div>
				</div>
				<div class="daShadow" style="width:90px;height:140px;float:left;padding:2px; margin-right:20px; text-align:right; background:#fff;">
					<img style="width:85px;height:100px;margin:2px;border:1px solid #666;" src="/web/_sys_templateinfo/frontend.jpg"/>
					<div><span style="color:#999;">前端开发</span><br/><span id="tl_frontend"></span></div>
				</div>
				<div class="daShadow" style="width:90px;height:140px;float:left;padding:2px; margin-right:20px; text-align:right; background:#fff;">
					<img style="width:85px;height:100px;margin:2px;border:1px solid #666;" src="/web/_sys_templateinfo/programmer.jpg"/>
					<div><span style="color:#999;">程序实现</span><br/><span id="tl_programmer"></span></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	
	<div style="width:100%; height:800px; border-top:1px solid #666; background:url(/33333333333.jpg) center top">
		<!--
		<iframe style="width:100%; height:800px;margin:0px;border:0px;" src="http://xiangce.baidu.com/plaza"></iframe>
		-->
	</div>
</div>
</BODY>
</HTML>

<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/template_manage.js"></script>
