<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>文章分类管理</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/plugin/ztree/zTreeStyle.css" type="text/css"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css"/>
 
	<style type="text/css">
		.ztree li span.button.add {
			margin-left:2px;
			margin-right: -1px;
			background-position:-144px 0;
			vertical-align:top;
			*vertical-align:middle
		}
		
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}

	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">
		<span style="margin-right:20px;">文章分类管理</span>
		<a class="bt_link" href="javascript:void(0)" onclick="addroottype();" ><img src="/images/sys_icon/add.png" /> 添加一级分类</a>
	</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" id="leftpad" style="width:200px;vertical-align:top;">
				<ul id="treearticletype" class="ztree"></ul>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div class="list_top_bar">
						<div class="list_top_title">分类基本信息</div>
						<div class="list_top_tools">
							<a class="item" href="javascript:void(0)" onclick="updatetype();" ><img src="/images/sys_icon/save.png" /> 保存</a>
						</div>
					</div>
					
					<table id="navform" class="grid" style="width:100%">
						<tr>
							<td class="header">编号</td>
							<td><input id="at_id" type="text" style="width:50px;" disabled="true" value=""/></td>
							<td class="header" style="width:80px;">排序</td>
							<td><input id="at_sort" type="text" style="width:50px;" value=""/></td>
						</tr>
						<tr>
							<td class="header" style="width:80px;">分类名称</td>
							<td style="width:160px;"><input id="at_name" type="text" style="width:200px;" value="" /></td>
							<td class="header" style="width:80px;">列表条数</td>
							<td><input id="at_listnum" type="text" style="width:50px;" value="10"/></td>
						</tr>
						<tr>
							<td class="header" style="width:80px;">列表风格</td>
							<td colspan="3">
								<label title="单页面" style="margin-right:10px;">
									<input type="radio" name="article_style" value="SINGLEPAGE" onclick="showstylepad(this)"/>
									<img src="/images/style_single.gif" style="vertical-align:middle;"/>
								</label>
								<label title="列表" style="margin-right:10px;">
									<input type="radio" name="article_style" value="LIST" checked="true" onclick="showstylepad(this)"/>
									<img src="/images/style_list.gif" style="vertical-align:middle;"/>
								</label>
								<label title="略缩图" style="margin-right:10px;">
									<input type="radio" name="article_style" value="ICONLIST" onclick="showstylepad(this)"/>
									<img src="/images/style_iconlist.gif" style="vertical-align:middle;"/>
								</label>
								<label title="九宫格" style="margin-right:10px;">
									<input type="radio" name="article_style" value="ICON" onclick="showstylepad(this)"/>
									<img src="/images/style_icon.gif" style="vertical-align:middle;"/>
								</label>
								<label title="超链接" style="margin-right:5px;">
									<input type="radio" name="article_style" value="LINK" onclick="showstylepad(this)"/>
									<img src="/images/style_link.gif" style="vertical-align:middle;"/>
								</label>
								<label title="自定义" style="margin-right:10px;">
									<input type="radio" name="article_style" value="USERDEFINED" onclick="showstylepad(this)"/>
									<img src="/images/style_userdefined.gif" style="vertical-align:middle;"/>
								</label>
							</td>
						</tr>
						<tr id="SINGLEPAGE_pad" style="display:none;">
							<td class="header">单页面</td>
							<td colspan="3">
								<textarea id="at_content" style="width:700px;height:600px;"></textarea>
							</td>
						</tr>
						<tr id="LINK_pad" style="display:none;">
							<td class="header">超链接</td>
							<td colspan="3">
								<input id="at_url" type="text" style="width:320px;" value=""/>
							</td>
						</tr>
						<tr>
							<td class="header">略缩图</td>
							<td colspan="3">
								<input id="at_img" type="text" style="width:320px;" value=""/>
								<input type="button" style="width:80px; height:22px;" value="上传"/>
							</td>
						</tr>
						<tr>
							<td class="header">&nbsp;</td>
							<td colspan="3">
								<img id="at_img_view" src="/images/no_img.gif" style="height:80px; border:1px solid #f0f0f0"/>
							</td>
						</tr>
						<tr>
							<td class="header">SEO关键字</td>
							<td colspan="3">
								<textarea id="at_keywords" style="width:400px;height:100px;"></textarea>
								<br/><span style="color:#900">注: 多关键字以逗号(,)分隔，如果不设置，将以"网站配置"->"SEO关键词"为准。</span>
							</td>
						</tr>
						<tr>
							<td class="header">SEO描述</td>
							<td colspan="3">
								<textarea id="at_description" style="width:400px;height:100px;"></textarea>
								<br/><span style="color:#900">注: 如果不设置，将以"网站配置"->"SEO描述"为准。</span>
							</td>
						</tr>
						<tr>
							<td class="header">备注</td>
							<td colspan="3"><textarea id="at_remark" style="width:400px;height:100px;"></textarea></td>
						</tr>
					</table>
				</div>
					
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.exedit-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.excheck-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/articletype_manage.js"></script>
