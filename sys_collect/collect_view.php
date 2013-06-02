<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php"; ?>
	
	<TITLE>查看已采集文章内容</TITLE>
	<link rel="stylesheet" href="/css/base.css">
 </HEAD>
<BODY>
	<table id="formlist" class="grid" style="width:100%;display:none;">
		<tr>
			<td class="header" style="width:80px;">标题</td>
			<td>{c_title}</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">地址</td>
			<td>{c_url}</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">关键词</td>
			<td>{c_keywords}</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">描述</td>
			<td>{c_description}</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">内容</td>
			<td>{c_content}</td>
		</tr>
	</table>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/collect_view.js"></script>