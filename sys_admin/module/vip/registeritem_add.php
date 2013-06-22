<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	 
	<TITLE>添加注册项</TITLE>
	<link rel="stylesheet" href="/css/base.css" />
 
 </HEAD>
<BODY>
<div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">添加注册项</div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="saveitem()" ><img src="/images/sys_icon/save.png" /> 保存</a>
					</div>
				</div>
				
				<table class="grid" style="width:100%;">
					<tr>
						<td class="header" style="width:80px;">名称</td>
						<td>
							<input id="vr_name" type="text" valid="anything,false" validinfo="不能为空"/><span class="must">*</span>
						</td>
					</tr>
					<tr>
						<td class="header" style="width:80px;">字段</td>
						<td>
							<input id="vr_field" type="text" valid="code,false" validinfo="只能是字母/下划线/数字"/><span class="must">*</span>
						</td>
					</tr>
					<tr>
						<td class="header" style="width:80px;">排序</td>
						<td>
							<input id="vr_sort" type="text" style="width:50px;" value="9999" valid="int" validinfo="只能是整数"/>
						</td>
					</tr>
					<tr>
						<td class="header" style="width:80px;">类型</td>
						<td>
							<select id="vr_type" onchange="showedit()">
								<optgroup label="文本">
									<option value="varchar(100)" selected="selected">50字</option>
									<option value="varchar(200)">100字</option>
									<option value="varchar(400)">200字</option>
									<option value="varchar(1000)">500字</option>
									<option value="varchar(2000)">1000字</option>
									<option value="text">大文本</option>
								</optgroup>
								<optgroup label="时间项">
									<option value="datetime">日期时间</option>
								</optgroup>
								<optgroup label="数值">
									<option value="int">整数</option>
									<option value="float">浮点数</option>
								</optgroup>
								<optgroup label="选择">
									<option value="varchar(200)">下拉</option>
									<option value="varchar(300)">单选</option>
									<option value="varchar(1000)">多选</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr id="pad_items" style="display:none;">
						<td class="header" style="width:80px;">选项编码</td>
						<td>
							<input id="vr_items" type="text" />
							<br/><span style="color:#900">请对应设置为“系统配置”->“选项配置”功能模块下，其中任意“分类”的“编码”</span>
						</td>
					</tr>
					<tr>
						<td class="header" style="width:80px;"></td>
						<td>
							<label><input name="vr_ismust" type="radio" value="1" />必填</label>
							<label><input name="vr_ismust" type="radio" value="0" checked="checked"/>可以不填</label>
						</td>
					</tr>
					<tr>
						<td class="header" style="width:80px;"></td>
						<td>
							<label><input name="vr_status" type="radio" value="RUN" />启用</label>
							<label><input name="vr_status" type="radio" value="STOP" checked="checked"/>禁用</label>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/registeritem_add.js"></script>

