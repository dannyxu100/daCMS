<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php"; ?>
	
	<TITLE>添加采集规则</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">数据采集规则</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="saverule();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<div id="tabbar"></div>
	<div id="pad_1">
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:100px;">规则名称</td>
				<td colspan="2"><input id="r_name" type="text" style="width:300px;"/></td>
			</tr>
			<tr>
				<td class="header">页面编码</td>
				<td colspan="2">
					<label><input name="r_pagecode" type="radio" value="UTF8" checked="true"/>UTF8</label>
					<label><input name="r_pagecode" type="radio" value="GBK"/>GBK</label>
					<label><input name="r_pagecode" type="radio" value="BIG5"/>BIG5</label>
				</td>
			</tr>
			<tr>
				<td class="header">网址类型</td>
				<td colspan="2">
					<label><input name="r_urltype" type="radio" value="ITEM"/>序列网址</label>
					<label><input name="r_urltype" type="radio" value="LIST" checked="true"/>多网址</label>
					<label><input name="r_urltype" type="radio" value="SINGLE"/>单网址</label>
					<label><input name="r_urltype" type="radio" value="RSS"/>RSS</label>
				</td>
			</tr>
			<tr>
				<td class="header">来源网址</td>
				<td colspan="2">
					<textarea id="r_urlsource" style="width:100%; height:200px;"></textarea>
					(每个网址占一条)
				</td>
			</tr>
			<tr>
				<td class="header">网址过滤</td>
				<td>
					<input id="r_urlallowed" type="text" style="width:90%; "/>
					<br/>(必须包含的字符)
				</td>
				<td>
					<input id="r_urlunallowed" type="text" style="width:90%; "/>
					<br/>(不能包含的字符)
				</td>
			</tr>
			<tr>
				<td class="header">获取范围</td>
				<td>
					<textarea id="r_urlrange1" style="width:90%; height:150px;"></textarea>
					<br/>(开始位置代码)
				</td>
				<td>
					<textarea id="r_urlrange2" style="width:90%; height:150px;"></textarea>
					<br/>(结束位置代码)
				</td>
			</tr>
		</table>
	
	</div>
	<div id="pad_2">
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:100px;">文章标题</td>
				<td>
					<textarea id="r_titlerule" style="width:90%; height:100px;"></textarea>
					<br/>("[内容]"为通配符)
				</td>
				<td>
					<textarea id="r_titleclear" style="width:90%; height:100px;"></textarea>
					<br/>(去除字符)
				</td>
			</tr>
			<tr>
				<td class="header" style="width:100px;">SEO关键词</td>
				<td>
					<textarea id="r_keywordsrule" style="width:90%; height:100px;"></textarea>
					<br/>("[内容]"为通配符)
				</td>
				<td>
					<textarea id="r_keywordsclear" style="width:90%; height:100px;"></textarea>
					<br/>(去除字符)
				</td>
			</tr>
			<tr>
				<td class="header" style="width:100px;">SEO描述</td>
				<td>
					<textarea id="r_descriptionrule" style="width:90%; height:100px;"></textarea>
					<br/>("[内容]"为通配符)
				</td>
				<td>
					<textarea id="r_descriptionclear" style="width:90%; height:100px;"></textarea>
					<br/>(去除字符)
				</td>
			</tr>
			<tr>
				<td class="header">文章内容</td>
				<td>
					<textarea id="r_contentrule" style="width:90%; height:100px;"></textarea>
					<br/>("[内容]"为通配符)
				</td>
				<td>
					<textarea id="r_contentclear" style="width:90%; height:100px;"></textarea>
					<br/>(去除字符)
				</td>
			</tr>
		</table>
	</div>
	<div id="pad_3">
	</div>
	<div id="pad_4">
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:100px;">图片下载</td>
				<td colspan="2">
					<label><input name="r_downloadimg" type="radio" value="0" checked="true"/>不下载</label>
					<label><input name="r_downloadimg" type="radio" value="1"/>下载</label>
				</td>
			</tr>
		</table>
	
	</div>
	
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/rule_add.js"></script>