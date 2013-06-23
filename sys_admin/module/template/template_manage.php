<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>设计套餐管理</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
		
 </HEAD>
<BODY>
<div>
	<div class="clearfix" style="padding:20px 10px; width:1050px;">
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
			<div class="tl_info_box">
				<div>
					<a href="javascript:void(0)" class="bt_link" onclick="backuptemplate();"><img src="/images/sys_icon/save.png"/> 备份当前模板</a>
					<a href="javascript:void(0)" class="bt_link" onclick="restoretemplate()"><img src="/images/sys_icon/refresh.png"/> 还原模板</a>
				</div>
				
				<div class="tl_info_box_row">
					<span class="header">模板名称</span><span id="tl_name"></span> 
				</div>
				<div class="tl_info_box_row">
					<span class="header">模板编号</span><span id="tl_code"></span>
				</div>
				<div class="tl_info_box_row">
					<span class="header">链接地址</span><span id="tl_url"></span>
				</div>
				<div class="tl_info_box_row">
					<span class="header">发布日期</span><span id="tl_date"></span>
				</div>
				<div class="tl_info_box_row">
					<span class="header">模板简介</span><span id="tl_description"></span>
				</div>
			</div>
			<div class="tl_pic_box clearfix">
				<div class="tl_pic_box_row daShadow">
					<img id="tl_designer_pic" src=""/>
					<div>
						<span style="color:#999;">设计师</span><br/><span id="tl_designer"></span>
					</div>
				</div>
				<div class="tl_pic_box_row daShadow">
					<img id="tl_frontend_pic" src=""/>
					<div>
						<span style="color:#999;">前端开发</span><br/><span id="tl_frontend"></span>
					</div>
				</div>
				<div class="tl_pic_box_row daShadow">
					<img id="tl_programmer_pic" src=""/>
					<div>
						<span style="color:#999;">程序实现</span><br/><span id="tl_programmer"></span>
					</div>
				</div>
			</div>
		</div>
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
