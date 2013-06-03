<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php"; ?>
	
	<TITLE>添加采集规则</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">文章链接地址<span id="count" style="margin-left:20px;color:#900;"></span></div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="" ><img src="/images/sys_icon/save.png" /> 批量获取内容</a>
		</div>
	</div>
	
	<table id="tb_list" style="width:100%;">
		<tbody name="head">
			<tr>
				<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
				<td style="width:20px;">序</td>
				<td>标题</td>
				<td>链接地址</td>
				<td style="width:200px;">&nbsp;</td>
			</tr>
		</tbody>
		<tbody name="body" style="display:none">
			<tr>
				<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{id}" /></td>
				<td name="order">{order}</td>
				<td name="title" >{title}</td>
				<td name="url" >{url}</td>
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
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/rule_collecturl.js"></script>