﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php"; ?>
	
	<TITLE>已采集文章</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">已采集<span id="count" style="margin-left:20px;color:#900;"></span></div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="exportlist()" ><img src="/images/sys_icon/save.png" /> 批量引用文章</a>
		</div>
	</div>
	
	<table id="tb_list" style="width:100%;">
		<tbody name="head">
			<tr>
				<td style="text-align:center; width:20px;"><input type="checkbox" onclick="checkall(this)" /></td>
				<td style="width:20px;">序</td>
				<td>标题</td>
				<td>链接地址</td>
				<td style="width:120px;">日期</td>
				<td style="width:200px;">&nbsp;</td>
			</tr>
		</tbody>
		<tbody name="body" style="display:none">
			<tr>
				<td style="text-align:center;">{checkbox}</td>
				<td name="order">{order}</td>
				<td name="c_title" >{c_title}</td>
				<td name="c_url" >{c_url}</td>
				<td name="c_date" fmt="/p">{c_date}</td>
				<td name="tools">{tools}</td>
			</tr>
		</tbody>
		<tbody name="foot">
			<tr>
				<td  colspan="6" name="sum_order">
					共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
					共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
					当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
					<span id="tb_list_pageinfo">&nbsp;</span>
				</td>
			</tr>
		</tbody>
	</table>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/collect_list.js"></script>