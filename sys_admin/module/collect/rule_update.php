<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php"; ?>
	
	<TITLE>修改采集规则</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">数据采集规则</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="updaterule();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<div id="tabbar"></div>
	<div id="pad_1" style="display:none;">
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:100px;">规则名称</td>
				<td colspan="2">
					<input id="r_name" type="text" style="width:300px;" valid="anything,false" validinfo="不能为空"/>
				</td>
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
					<label><input name="r_urltype" type="radio" onclick="showurlpad(this)" value="LIST" checked="true"/>多网址</label>
					<label><input name="r_urltype" type="radio" onclick="showurlpad(this)" value="NUMBER"/>连续网址</label>
					<label><input name="r_urltype" type="radio" onclick="showurlpad(this)" value="SINGLE"/>单网址</label>
					<label><input name="r_urltype" type="radio" onclick="showurlpad(this)" value="RSS"/>RSS</label>
				</td>
			</tr>
			<tr id="LIST_pad">
				<td class="header">来源网址</td>
				<td colspan="2">
					<textarea id="r_urlsource" style="width:100%; height:200px;"></textarea>
					<span style="color:#900">(每个网址占一条)</span>
					<br/>
					<br/>
				</td>
			</tr>
			<tr id="NUMBER_pad" style="display:none;">
				<td class="header">来源网址</td>
				<td colspan="2">
					<input type="text" id="r_urlsource2" style="width:400px;" value=""><input type="button" onclick="show_url()" value="测试"><br> 
					 <span style="color:#900">(如：http://www.phpcms.cn/help/rumen/[*].html,页码使用[*]做为通配符。</span>
					 <br>
					 页码从: <input type="text" id="r_num1" value="1" /> 到 
					 <input type="text" id="r_num2" value="10" /> 每次增加 
					 <input type="text" id="r_step" value="1" />
					<br/>
					<br/>
				</td>
			</tr>
			<tr id="SINGLE_pad" style="display:none;">
				<td class="header">来源网址</td>
				<td colspan="2">
					<input type="text" id="r_urlsource3" style="width:400px;" />
					<br/>
					<br/>
				</td>
			</tr>
			<tr id="RSS_pad" style="display:none;">
				<td class="header">来源网址</td>
				<td colspan="2">
					<input type="text" id="r_urlsource4" style="width:400px;" />
					<br/>
					<br/>
				</td>
			</tr>
			<tr>
				<td class="header">网址过滤</td>
				<td>
					<input id="r_urlallowed" type="text" style="width:90%; "/>
					<br/><span style="color:#900">(必须包含的字符)</span>
				</td>
				<td>
					<input id="r_urlunallowed" type="text" style="width:90%; "/>
					<br/><span style="color:#900">(不能包含的字符)</span>
				</td>
			</tr>
			<tr>
				<td class="header">获取范围</td>
				<td>
					<textarea id="r_urlrange1" style="width:90%; height:150px;"></textarea>
					<br/><span style="color:#900">(开始位置代码)</span>
				</td>
				<td>
					<textarea id="r_urlrange2" style="width:90%; height:150px;"></textarea>
					<br/><span style="color:#900">(结束位置代码)</span>
				</td>
			</tr>
		</table>
	
	</div>
	<div id="pad_2" style="display:none;">
		<div class="notebox">
			1. 匹配规则,请设置开始和结束符，具体内容使用“[content]”做为通配符 。<br/>
			2. 过滤选项,格式为“要过滤的内容[|]替换值”，要过滤的内容支持正则表达式，每行一条。
		</div>
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:100px;">文章标题</td>
				<td>
					<textarea id="r_titlerule" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(匹配规则)</span>
				</td>
				<td>
					<textarea id="r_titleclear" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(过滤选项)</span>
				</td>
			</tr>
			<tr>
				<td class="header" style="width:100px;">SEO关键词</td>
				<td>
					<textarea id="r_keywordsrule" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(匹配规则)</span>
				</td>
				<td>
					<textarea id="r_keywordsclear" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(过滤选项)</span>
				</td>
			</tr>
			<tr>
				<td class="header" style="width:100px;">SEO描述</td>
				<td>
					<textarea id="r_descriptionrule" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(匹配规则)</span>
				</td>
				<td>

					<textarea id="r_descriptionclear" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(过滤选项)</span>
				</td>
			</tr>
			<tr>
				<td class="header">文章内容</td>
				<td>
					<textarea id="r_contentrule" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(匹配规则)</span>
				</td>
				<td>
					<textarea id="r_contentclear" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(过滤选项)</span>
				</td>
			</tr>
		</table>
		
	</div>
	<div id="pad_3" style="display:none;">
		<div class="notebox">
			1. 如果详细页面也有分页，请配置下面的内容分页规则<br/>
			2. 序列模式分页，是指以数字超链接直接罗列的方式，如[1] [2] [3] [4]...<br/>
			3. 上下页模式分页，是指以“上一页”，“下一页”超链接的方式。
		</div>
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:100px;">是否分页</td>
				<td colspan="2">
					<label><input name="r_split" type="radio" value="0" checked="true"/>不分页</label>
					<label><input name="r_split" type="radio" value="1"/>分页</label>
				</td>
			</tr>
			<tr>
				<td class="header" style="width:100px;">分页模式</td>
				<td colspan="2">
					<label><input name="r_splittype" type="radio" onclick="showsplitpad(this)" value="NUMBER" checked="true"/>序列模式</label>
					<label><input name="r_splittype" type="radio" onclick="showsplitpad(this)" value="PREVNEXT"/>上下页模式</label>
				</td>
			</tr>
			<tr id="PREVNEXT_pad" style="display:none;">
				<td class="header">下一页标志</td>
				<td colspan="2">
					<input type="text" id="r_splitnexttag" value="下一页">
					<br><span style="color:#900">填写下一页超链接中间的代码。如：下一页，他的“下一页标志”为“下一页”。</span>			
					<br/>
					<br/>
				</td>
			</tr>
			<tr>
				<td class="header">分页代码范围</td>
				<td>
					<textarea id="r_splitrange1" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(开始位置代码)</span>
				</td>
				<td>
					<textarea id="r_splitrange2" style="width:90%; height:100px;"></textarea>
					<br/><span style="color:#900">(结束位置代码)</span>
				</td>
			</tr>
		</table>
	</div>
	<div id="pad_4" style="display:none;">
	</div>
	<div id="pad_5" style="display:none;">
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
<script type="text/javascript" src="js/rule_update.js"></script>