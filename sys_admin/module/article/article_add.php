<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>添加文章</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">添加新文章</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savearticle();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<table class="grid" style="width:100%">
		<tr>
			<td class="header">标题</td>
			<td colspan="3"><input id="a_title" style="width:400px;" valid="anything,false" validinfo="不能为空"/><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header">副标题</td>
			<td colspan="3"><input id="a_title2" style="width:400px;"/></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">排序</td>
			<td style="width:150px;"><input id="a_sort" type="text" value="0" /></td>
			<td class="header" style="width:80px;">浏览次数</td>
			<td><input id="a_count" type="text" value="0" /></td>
		</tr>
		<tr>
			<td class="header">SEO关键词</td>
			<td colspan="3">
				<textarea id="a_keywords" style="width:400px;height:100px;"></textarea>
				<br/><span style="color:#900">注: 多关键字以逗号(,)分隔，如果不设置，将以"分类信息"->"SEO关键词"为准。</span>
			</td>
		</tr>
		<tr>
			<td class="header">SEO描述</td>
			<td colspan="3">
				<textarea id="a_description" style="width:400px;height:100px;"></textarea>
				<br/><span style="color:#900">注: 如果不设置，将以"分类信息"->"SEO描述"为准。</span>
			</td>
		</tr>
		<tr>
			<td class="header">略缩图</td>
			<td colspan="3">
				<input id="a_img" type="text" style="width:320px;" value=""/>
				<input type="button" style="width:80px; height:22px;" value="上传"/>
			</td>
		</tr>
		<tr>
			<td class="header">&nbsp;</td>
			<td colspan="3">
				<img id="a_img_view" src="/images/no_img.jpg" style="margin:5px;"/>
			</td>
		</tr>
		<tr>
			<td class="header">内容</td>
			<td colspan="3"><textarea id="a_content" style="width:800px;height:600px;"></textarea></td>
		</tr>
		<tr>
			<td class="header">发布日期</td>
			<td><input type="text" id="a_createdate" disabled="disabled"/></td>
			<td class="header">修改日期</td>
			<td><input type="text" id="a_updatedate" disabled="disabled"/></td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/article_add.js"></script>

