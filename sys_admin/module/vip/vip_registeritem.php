<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	 
  <TITLE>会员注册项管理</TITLE>
	<link rel="stylesheet" href="/css/base.css">
 
	<style type="text/css">
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#po_remark{width:400px; height:120px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">会员注册项管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">注册项列表</div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="additem();" ><img src="/images/sys_icon/add.png" /> 新建注册项</a>
					</div>
				</div>
				
				<table id="tb_list" style="width:100%;">
					<tbody name="head">
						<tr>
							<td style="width:20px;">序</td>
							<td style="width:200px;">注册项</td>
							<td style="width:150px;">字段</td>
							<td>&nbsp;</td>
						</tr>
					</tbody>
					<tbody name="body" style="display:none">
						<tr value="{pu_id}">
							<td name="order">{order}</td>
							<td name="COLUMN_COMMENT" >{COLUMN_COMMENT}</td>
							<td name="COLUMN_NAME" >{COLUMN_NAME}</td>
							<td name="tools" >{tools}</td>
						</tr>
					</tbody>
					<tbody name="foot">
						<tr>
							<td  colspan="4" name="sum_order">
								共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
								共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
								当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
								<span id="tb_list_pageinfo">&nbsp;</span>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/vip_registeritem.js"></script>

