<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<link rel="stylesheet" href="/css/base.css"/>

	<title>网站系统配置</title>

	</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title">修改网站系统配置</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savewebconfig();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<div style="padding:10px;">企业信息</div>
	<table class="grid" style="width:100%">
		<tr>
			<td class="header">企业名称</td>
			<td colspan="3">
				<input type="text" id="c_company" style="width:590px;"/>
				<input type="hidden" id="c_id"/>
			</td>
		</tr>
		<tr>
			<td class="header">企业地址</td>
			<td colspan="3"><input type="text" id="c_address" style="width:590px;"/></td>
		</tr>
		<tr>
			<td class="header" style="width:100px;">联系人</td>
			<td style="width:250px;"><input type="text" id="c_user" style="width:220px;"/></td>
			<td class="header" style="width:100px;">手机</td>
			<td><input type="text" id="c_phone" style="width:220px;"/></td>
		</tr>
		<tr>
			<td class="header">电话</td>
			<td><input type="text" id="c_telephone" style="width:220px;"/></td>
			<td class="header">E-Mail</td>
			<td><input type="text" id="c_email" style="width:220px;"/></td>
		</tr>
		<tr>
			<td class="header">传真</td>
			<td><input type="text" id="c_fax" style="width:220px;"/></td>
			<td class="header">邮编</td>
			<td><input type="text" id="c_zipcode" style="width:220px;"/></td>
		</tr>
	</table>

	<div style="padding:10px;">网站信息</div>
	<table class="grid" style="width:100%">
		<tr>
			<td class="header">网站名称</td>
			<td colspan="3"><input type="text" id="c_name" style="width:590px;"/></td>
		</tr>
		<tr>
			<td class="header" style="width:100px;">网站域名</td>
			<td style="width:250px;"><input type="text" id="c_website" style="width:220px;"/></td>
			<td class="header" style="width:100px;">ICP备案号</td>
			<td><input type="text" id="c_icp" style="width:220px;"/></td>
		</tr>
		<tr>
			<td class="header">网站logo</td>
			<td colspan="3">
				<input id="c_img" type="text" style="width:320px;" value=""/>
				<input type="button" style="width:80px; height:22px;" value="上传"/>
			</td>
		</tr>
		<tr>
			<td class="header">&nbsp;</td>
			<td colspan="3">
				<img id="c_img_view" src="/images/no_img.gif" style="margin:5px;"/>
			</td>
		</tr>
		<tr>
			<td class="header">SEO关键字</td>
			<td colspan="3">
				<textarea type="text" id="c_keywords" style="width:590px; height:100px;"></textarea>
			</td>
		</tr>
		<tr>
			<td class="header">SEO描述</td>
			<td colspan="3">
				<textarea type="text" id="c_description" style="width:590px; height:100px;"></textarea>
			</td>
		</tr>
		<!--
		<tr>
			<td class="header">版权所有</td>
			<td><input type="text" id="w_user" style="width:220px;"/></td>
			<td class="header">技术支持</td>
			<td><input type="text" id="w_phone" style="width:220px;"/></td>
		</tr>
		-->
	</table>
	
	<div style="padding:10px;">其他信息</div>
	<table class="grid" style="width:100%">
		<tr>
			<td class="header" style="width:100px;">推送邮件账号</td>
			<td style="width:250px;"><input type="text" id="c_pushemail" style="width:220px;"/></td>
			<td class="header" style="width:100px;">推送邮件密码</td>
			<td><input type="text" id="c_pushpwd" style="width:220px;"/></td>
		</tr>
		<tr>
			<td class="header">伪静态</td>
			<td colspan="3">
				<label style="margin-right:10px;"><input name="c_isstatic" type="radio" value="1" checked="checked"/>启用</label>
				<label><input name="c_isstatic" type="radio" value="0"/>不启用</label>
			</td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td colspan="3">
				<textarea type="text" id="c_remark" style="width:590px; height:100px;"></textarea>
			</td>
		</tr>
	</table>
</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/webconfig.js"></script>
