<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	 
  <TITLE>会员管理</TITLE>
	<link rel="stylesheet" href="/css/base.css">
 
	<style type="text/css">
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#po_remark{width:400px; height:120px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">会员管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">成员信息列表</div>
					<div class="list_top_tools" style="float:left;">
						<a class="item" href="javascript:void(0)" onclick="addvip();" ><img src="/images/sys_icon/add.png" /> 添加</a>
						<a class="item" href="javascript:void(0)" onclick="" ><img src="/images/sys_icon/delete.png" /> 删除</a>
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
							<td style="width:80px;">账号</td>
							<td style="width:50px;">名称</td>
							<td style="width:80px;">手机</td>
							<td style="width:80px;">电话</td>
							<td style="width:200px;">邮箱</td>
							<td>地址</td>
							<td style="width:80px;">最近登陆</td>
							<td style="width:80px;">登陆次数</td>
						</tr>
					</tbody>
					<tbody name="body" style="display:none">
						<tr value="{v_id}">
							<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{v_id}" /></td>
							<td name="order">{order}</td>
							<td name="v_code" title="{v_remark}">{v_code}</td>
							<td name="v_name" >{v_name}</td>
							<td name="v_phone" >{v_phone}</td>
							<td name="v_telephone" >{v_telephone}</td>
							<td name="v_email" >{v_email}</td>
							<td name="v_address" >{v_address}</td>
							<td fmt="yyyy-mm-dd/p" >{v_lastlogin}</td>
							<td name="v_logincount" >{v_logincount}</td>
						</tr>
					</tbody>
					<tbody name="foot">
						<tr>
							<td  colspan="10" name="sum_order">
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

<script type="text/javascript" src="js/vip_manage.js"></script>

