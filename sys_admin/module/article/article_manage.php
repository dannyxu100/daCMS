<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<div class="header">文章管理</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:250px;vertical-align:top;">
				<a class="bt_menu" href="javascript:void(0)" onclick="addroottype();" ><img src="/images/sys_icon/add.png" /> 添加大类</a>
				<ul id="treearticletype" class="ztree"></ul>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div id="tabbar"></div>
					
					<div id="pad_info">
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
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td class="header" style="width:80px;">分类名称</td>
								<td style="width:160px;"><input id="at_name" type="text" style="width:200px;" value="" /></td>
								<td class="header" style="width:80px;">排序</td>
								<td><input id="at_sort" type="text" style="width:50px;" value=""/></td>
							</tr>
							<tr>
								<td class="header">略缩图</td>
								<td colspan="3">
									<input id="at_img" type="text" style="width:320px;" value=""/>
									<input type="button" style="width:80px; height:22px;" value="上传"/>
								</td>
							</tr>
							<tr>
								<td class="header">预览</td>
								<td colspan="3">
									<img id="at_img_view" src="" style="margin:5px;"/>
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
					
					
					<div id="pad_list">
						<div class="list_top_bar">
							<div class="list_top_title">文章列表</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addarticle();" ><img src="/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deleteu2r();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
							</div>
						</div>
						
						<table id="tb_list" style="width:100%;">
							<tbody name="head">
								<tr>
									<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
									<td style="width:20px;">序</td>
									<td>标题</td>
									<td style="width:80px;">排序</td>
									<td style="width:80px;">日期</td>
									<td style="width:80px;">浏览次数</td>
									<td style="width:300px;">标签</td>
									<td style="width:30px;">&nbsp;</td>
								</tr>
							</tbody>
							<tbody name="body" style="display:none">
								<tr value="{a_id}">
									<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{a_id}" /></td>
									<td name="order">{order}</td>
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
					
				</div>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.exedit-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.excheck-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/article_manage.js"></script>
