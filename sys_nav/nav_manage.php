<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>系统常量可选项管理</TITLE>
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
	<div class="header">可选项管理</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:250px;vertical-align:top;">
				<a class="bt_menu" href="javascript:void(0)" onclick="addrootnav();" ><img src="/images/sys_icon/add.png" /> 添加一级导航</a>
				<ul id="treenavtype" class="ztree"></ul>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div id="tabbar"></div>
					
					<div id="pad_type">
						<div class="list_top_bar">
							<div class="list_top_title">基本信息</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updatenav();" ><img src="/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						
						<table id="navform" class="grid" style="width:100%">
							<tr>
								<td class="header">编号</td>
								<td><input id="n_id" type="text" disabled="true" value=""/></td>
								<td class="header">菜单级别</td>
								<td><input id="n_level" type="text" style="width:50px;" disabled="true" value="" /></td>
							</tr>
							<tr>
								<td class="header" style="width:80px;">中文名称</td>
								<td style="width:160px;"><input id="n_name" type="text" value="" /></td>
								<td class="header" style="width:80px;">排序</td>
								<td><input id="n_sort" type="text" style="width:50px;" value=""/></td>
							</tr>
							<tr>
								<td class="header" style="width:80px;">英文名称</td>
								<td style="width:160px;"><input id="n_enname" type="text" value="" /></td>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td class="header">URL地址</td>
								<td colspan="3"><input id="n_url" type="text" style="width:400px;" value=""/></td>
							</tr>
							<tr>
								<td class="header">图标</td>
								<td colspan="3">
									<input id="n_img" type="text" style="width:320px;" value=""/>
									<input type="button" style="width:80px; height:22px;" value="上传"/>
								</td>
							</tr>
							<tr>
								<td class="header">预览</td>
								<td colspan="3">
									<img id="n_img_view" src="" style="margin:5px;"/>
								</td>
							</tr>
							<tr>
								<td class="header">备注</td>
								<td colspan="3"><textarea id="n_remark" style="width:400px;height:100px;"></textarea></td>
							</tr>
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
<script type="text/javascript" src="js/nav_manage.js"></script>
