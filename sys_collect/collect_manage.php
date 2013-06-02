<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php"; ?>
	
	<TITLE>内容采集管理器</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">内容采集管理器</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="addrule()" ><img src="/images/sys_icon/add.png" /> 新建规则</a>
		</div>
	</div>
	
	<table id="tb_list" style="width:100%;">
		<tbody name="head">
			<tr>
				<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
				<td style="width:20px;">序</td>
				<td>规则名称</td>
				<td style="width:120px;">网址类型</td>
				<td style="width:120px;">最后采集时间</td>
				<td style="width:400px;">&nbsp;</td>
			</tr>
		</tbody>
		<tbody name="body" style="display:none">
			<tr>
				<td style="text-align:center;"><input type="checkbox" name="chkitem" value="" /></td>
				<td name="order">{order}</td>
				<td name="r_name" >{r_name}</td>
				<td name="r_urltype" >{r_urltype}</td>
				<td name="r_date" fmt="yyyy-mm-dd/p">{r_date}</td>
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
<script type="text/javascript" src="js/collect_manage.js"></script>