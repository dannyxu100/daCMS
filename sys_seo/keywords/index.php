<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<HEAD>
		<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
		<link rel="stylesheet" href="/css/base.css"/>

		<TITLE>关键词查询-seo工具</TITLE>

	</HEAD>

	<BODY>
		<div class="notebox">
			1.通过关键词排名查询，可以快速得到当前网站的关键字在Baidu/Google收录的排名情况！<br/>
			2.有些关键词在各地的排名是不一样的，就是通常说的关键字地区排名。<br/>
		</div>
	
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:80px;">网站地址</td>
				<td colspan="3">
					<input type="text" name="domain" id="domain" size="30" value="www.ibcut.com"/>
				</td>
			</tr>
			<tr>
				<td class="header">搜索引擎</td>
				<td colspan="3">
					<select name="engine" id="engine" > 
						<option value="1" selected="selected">Baidu</option> 
						<option value="2">Google</option>
					</select>
					<select name="rn" id="rn">
						<option value=10 >每页显示10条</option>
						<option value=20 >每页显示20条</option>
						<option value=50 >每页显示50条</option>
						<option value=100 >每页显示100条</option>
					</select>
					<span style="color:#900;">(google引擎已停用)</span>
				</td>
			</tr>
			<tr>
				<td class="header">关键词</td>
				<td colspan="3">
					<input type="text" name="keywords" id="keywords" size="30" value="昆明网站建设"/>
					<a class="bt_link" href="javascript:void(0)" onclick="seosearch()" ><img src="/images/sys_icon/search.png" /> 查询</a>
					<span style="color:#900;">(多关键词空格分隔)</span>
				</td>
			</tr>
		</table>
		
		<div id="seo_pad"></div>
		
		<div id="last_pad"></div>
		
	</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/index.js"></script>
