<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php"; ?>
	
	<TITLE>数据库操作日志</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">数据库操作日志</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="" ><img src="/images/sys_icon/save.png" /> 查询</a>
		</div>
	</div>
	
	<table id="tb_list" style="width:100%;">
		<tbody name="head">
			<tr>
				<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
				<td style="width:20px;">序</td>
				<td style="width:80px;">操作者</td>
				<td style="width:120px;">日期</td>
				<td style="width:80px;">操作类型</td>
				<td style="width:120px;">来源文件</td>
				<td style="width:50px;">结果</td>
				<td>执行代码</td>
				<td style="width:20px;">&nbsp;</td>
			</tr>
		</tbody>
		<tbody name="body" style="display:none">
			<tr>
				<td style="text-align:center;">{checkbox}</td>
				<td name="order">{order}</td>
				<td name="l_puname" >{l_puname}</td>
				<td name="l_date" fmt="/p">{l_date}</td>
				<td name="l_type" >{l_type}</td>
				<td name="l_file" >{l_file}</td>
				<td name="l_res" >{l_res}</td>
				<td name="l_sql" >{l_sql}</td>
				<td name="tools">{tools}</td>
			</tr>
		</tbody>
		<tbody name="foot">
			<tr>
				<td  colspan="9" name="sum_order">
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
<script type="text/javascript" src="js/dblog_list.js"></script>