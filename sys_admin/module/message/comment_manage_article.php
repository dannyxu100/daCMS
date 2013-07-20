<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>评论管理</TITLE>
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
		<span style="margin-right:20px;">评论管理</span>
	</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div class="list_top_bar">
						<div class="list_top_title">评论列表</div>
						<div class="list_top_tools" style="float:left;">
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
								<td style="width:80px;">会员</td>
								<td>评论内容</td>
								<td style="width:100px;">&nbsp;</td>
								<td>评论文章</td>
								<td style="width:100px;">评论日期</td>
								<td style="width:80px;">审核</td>
							</tr>
						</tbody>
						<tbody name="body" style="display:none">
							<tr value="{a_id}">
								<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{c_id}" /></td>
								<td name="order" title="编号:{c_id}">{order}</td>
								<td name="v_code" >{v_code}</td>
								<td name="c_content" >{c_content}</td>
								<td name="tools">{tools}</td>
								<td name="c_title" >{c_title}</td>
								<td name="c_date" fmt="yyyy-mm-dd/p">{c_date}</td>
								<td name="c_ispass">{c_ispass}</td>
							</tr>
							<tr name="revertrow" style="display:none; background:#444;">
								<td colspan="3" style="border-right:0px;">&nbsp;</td>
								<td colspan="3" style="border-right:0px;padding:0px;">
									<div style=" background:#fff; margin-bottom:20px; padding:10px;">
										<div name="revertinfo" style="margin-bottom:20px;"></div>
										
										<textarea name="text_revert" style="width:100%; height:50px;"></textarea>
										<a class="bt_link" href="javascript:void(0)" onclick="addrevert(this,{c_id},{c_cid})"><img src="/images/sys_icon/ok.png"/> 确认</a>
									</div>
								</td>
								<td colspan="2">&nbsp;</td>
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
				
				<div id="templet_revertlist" style="display:none;">
						<table id="tb_list_revert" style="width:100%;background-color:#fff;">
							<tbody name="head">
								<tr>
									<td style="width:30px;">序</td>
									<td style="width:80px;">回复人</td>
									<td>回复内容</td>
									<td style="width:100px;">回复日期</td>
								</tr>
							</tbody>
							<tbody name="body">
								<tr>
									<td name="order">{order}</td>
									<td name="pu_code">{pu_code}</td>
									<td name="c_content">{c_content}</td>
									<td name="c_date" fmt="yyyy-mm-dd/p">{c_date}</td>
								</tr>
							</tbody>
						</table>
				</div>
			</td>
		</tr>
	</table>

	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/comment_manage_article.js"></script>
