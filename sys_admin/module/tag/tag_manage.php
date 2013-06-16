<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>标签管理</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
 
	<style type="text/css">
		.item{float:left; padding:2px; margin:5px; height:18px; line-height:18px;border:1px solid #aaa;background:#eee;cursor:pointer;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">标签管理</div>
		<div class="list_top_tools">
			<input type="text" id="tagname" style="float:left; height:22px;" valid="anything,false" validinfo="不能为空" />
			<a class="item" href="javascript:void(0)" onclick="addtag()" ><img src="/images/sys_icon/add.png" /> 新建</a>
		</div>
	</div>
	
	<table id="tb_list" style="width:100%;">
		<tbody name="head">
			<tr>
				<td style="text-align:center; width:20px;"></td>
				<td style="width:20px;">序</td>
				<td>标签名称</td>
				<td style="width:60px;">颜色</td>
				<td style="width:80px;">&nbsp;</td>
			</tr>
		</tbody>
		<tbody name="body" style="display:none">
			<tr value="{t_id}" onclick="selectitem(this)">
				<td style="text-align:center;">{checkbox}</td>
				<td name="order">{order}</td>
				<td name="t_name" >{t_name}</td>
				<td name="t_name">{t_color}</td>
				<td name="tools">{tools}</td>
			</tr>
		</tbody>
		<tbody name="foot">
			<tr>
				<td  colspan="5" name="sum_order">
					共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
					共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
					当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
					<span id="tb_list_pageinfo">&nbsp;</span>
				</td>
			</tr>
		</tbody>
	</table>
	<table style="width:100%;border:1px solid #ccc; ">
		<tr><td>选中的标签 <span style="color:#f00">(双击取消)</span>:</td></tr>
		<tr><td id="out_pad"></td></tr>
	</table>
	<div style="text-align:center;padding:5px;clear:both;">
		<a class="bt_link" href="javascript:void(0)" onclick="backitem()" ><img src="/images/sys_icon/ok.png" /> 确定选择</a>
		<a class="bt_link" href="javascript:void(0)" onclick="clearitem()" > 清空</a>
	</div>
</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/jscolor/jscolor.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/tag_manage.js"></script>
