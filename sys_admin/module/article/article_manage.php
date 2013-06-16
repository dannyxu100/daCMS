﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>文章管理</TITLE>
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
		<span style="margin-right:20px;">文章管理</span>
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
						<div class="list_top_title">文章列表</div>
						<div class="list_top_tools" style="float:left;">
							<a class="item" href="javascript:void(0)" onclick="addarticle();" ><img src="/images/sys_icon/add.png" /> 添加</a>
							<a class="item" href="javascript:void(0)" onclick="deleteu2r();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
							<a class="item" href="javascript:void(0)" onclick="updatetag();" ><img src="/images/sys_icon/tag_plus.png" /> 设置标签</a>
						</div>
						<div class="list_top_tools">
							<input type="text" id="txt_keyword" style="float:left;height:20px;"/>
							<a class="item" href="javascript:void(0)" onclick="search();" ><img src="/images/sys_icon/search.png" /> 查询</a>
							<a class="item" href="javascript:void(0)" onclick="slidetagbar();" ><img src="/images/sys_icon/down.gif" /> 标签</a>
						</div>
					</div>
					
					<div id="tagpad" style="display:none; padding:5px; text-align:right;"></div>
					
					<table id="tb_list" style="width:100%;">
						<tbody name="head">
							<tr>
								<td style="text-align:center; width:20px;"><input type="checkbox" onclick="checkall(this)" /></td>
								<td style="width:20px;">序</td>
								<td>标题</td>
								<td style="width:80px;">排序</td>
								<td style="width:100px;">日期</td>
								<td style="width:80px;">浏览次数</td>
								<td style="width:100px;">标签</td>
								<td style="width:30px;">&nbsp;</td>
							</tr>
						</tbody>
						<tbody name="body" style="display:none">
							<tr value="{a_id}">
								<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{a_id}" /></td>
								<td name="order" title="编号:{a_id}">{order}</td>
								<td name="a_title" >{a_title}</td>
								<td name="a_sort" >{a_sort}</td>
								<td name="a_updatedate" fmt="yyyy-mm-dd/p">{a_updatedate}</td>
								<td name="a_count" >{a_count}</td>
								<td name="tag" >{tag}</td>
								<td name="tools">{tools}</td>
							</tr>
						</tbody>
						<tbody name="foot">
							<tr>
								<td  colspan="8" name="sum_order">
									共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
									共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
									当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
									<span id="tb_list_pageinfo">&nbsp;</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="norecord" class="notebox" style="display:none;">
					1. 分类“<span id="at_name" style="font-weight:bold;"></span>” 为 “单独页”/“超链接” 表现形式，所以不能添加、编辑记录。<br/>
					2. 如果希望添加记录，请在 “分类管理” -> “列表风格” 中选择其他形式。<br/>
					3. 如果希望对 “单页面” 内容进行编辑，请在 “分类管理” 里面进行编辑。<br/>
				</div>
				
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/article_manage.js"></script>
