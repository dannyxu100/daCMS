<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>修改商品</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">修改商品信息</div>
		<!--
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		-->
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="saveproduct();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<div id="tabbar"></div>
	
	<div id="formbox">
		<div id="pad_step1" style="display:none;">
			<table class="grid" style="width:100%">
				<tr>
					<td class="header">商品名称</td>
					<td colspan="3"><input id="p_name" style="width:400px;" valid="anything,false" validinfo="不能为空"/><span class="must">*</span></td>
				</tr>
				<tr>
					<td class="header">商品编号</td>
					<td colspan="3"><input id="p_code" style="width:200px;" valid="anything,false" validinfo="不能为空"/><span class="must">*</span></td>
				</tr>
				<tr>
					<td class="header" style="width:80px;">排序</td>
					<td style="width:150px;"><input id="p_sort" type="text" value="999" /></td>
					<td class="header" style="width:80px;">浏览次数</td>
					<td><input id="p_viewcount" type="text" value="0" /></td>
				</tr>
				<tr>
					<td class="header">状态</td>
					<td colspan="3">
						<label style="margin-right:20px;"><input type="radio" name="p_status" value="1" />上架</label>
						<label><input type="radio" name="p_status" value="0" checked="checked" />下架</label>
					</td>
				</tr>
				<tr>
					<td class="header">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td class="header">标签</td>
					<td colspan="3">
						<span id="tagpad"></span>
						<a class="bt_link" href="javascript:void(0)" onclick="updatetag();" ><img src="/images/sys_icon/tag_plus.png" /> 设置标签</a>
					</td>
				</tr>
				<tr>
					<td class="header">简介</td>
					<td colspan="3"><textarea id="p_abstract" style="width:400px;height:100px;"></textarea></td>
				</tr>
				<tr>
					<td class="header">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td class="header">SEO关键词</td>
					<td colspan="3">
						<textarea id="p_keywords" style="width:400px;height:100px;"></textarea>
						<br/><span style="color:#900">注: 多关键字以逗号(,)分隔，如果不设置，将以"分类信息"->"SEO关键词"为准。</span>
					</td>
				</tr>
				<tr>
					<td class="header">SEO描述</td>
					<td colspan="3">
						<textarea id="p_description" style="width:400px;height:100px;"></textarea>
						<br/><span style="color:#900">注: 如果不设置，将以"分类信息"->"SEO描述"为准。</span>
					</td>
				</tr>
				<tr>
					<td class="header">发布日期</td>
					<td><input type="text" id="p_createdate" disabled="disabled"/></td>
					<td class="header">修改日期</td>
					<td><input type="text" id="p_updatedate" disabled="disabled"/></td>
				</tr>
			</table>
		</div>
		<div id="pad_step2" style="display:none;">
			<table class="grid" style="width:100%">
				<tr>
					<td class="header">商品货号</td>
					<td colspan="3"><input id="p_no" style="width:260px;" valid="anything,false" validinfo="不能为空"/><span class="must">*</span></td>
				</tr>
				<tr>
					<td class="header">货位</td>
					<td style="width:150px;"><input id="p_place" /></td>
					<td class="header">库存量</td>
					<td><input id="p_stock" valid="int" validinfo="只能是数值"/></td>
				</tr>
				<tr>
					<td class="header">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td class="header" style="width:80px;">重量</td>
					<td>
						<input type="text" id="p_weight" style="width:90px;" valid="float" validinfo="只能是数值"/> 克(g)
					</td>
					<td class="header" style="width:80px;">计量单位</td>
					<td>
						<input type="text" id="p_unit"/>
						<span style="color:#900"> 注: 产品数量的计量单位</span>
					</td>
				</tr>
				<tr>
					<td class="header">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td class="header">成本价</td>
					<td colspan="3">
						<input type="text" id="p_costprice" valid="float" validinfo="只能是数值"/> 
						<span style="color:#900"> 注: 访客页面一般不会显示</span>
						
					</td>
				</tr>
				<tr>
					<td class="header">会员价</td>
					<td colspan="3">
						<input type="text" id="p_vipprice" valid="float" validinfo="只能是数值"/>
						<span style="color:#900"> 注: 可按需定制开放</span>
						
					</td>
				</tr>
				<tr>
					<td class="header">促销优惠价</td>
					<td colspan="3">
						<input type="text" id="p_reduceprice" valid="float" validinfo="只能是数值"/> 
						<span style="color:#900"> 注: 可以按需显示</span>
					</td>
				</tr>
				<tr>
					<td class="header">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				</tr>
					<td class="header">销售价</td>
					<td colspan="3">
						<input type="text" id="p_saleprice" valid="float" validinfo="只能是数值"/>
						<span style="color:#090"> 实际销售价</span>
					</td>
				<tr>
					<td class="header">市场价</td>
					<td colspan="3">
						<input type="text" id="p_marketprice" valid="float" validinfo="只能是数值"/>
						<span style="color:#090"> 访客参照对比价格</span>
					</td>
				</tr>
			</table>
		</div>
		<div id="pad_step3" style="display:none;">
			<table class="grid" style="width:100%">
				<tr>
					<td class="header">略缩图</td>
					<td colspan="3">
						<input id="p_img" type="text" style="width:320px;" value=""/>
						<a class="bt_link" href="javascript:void(0)" onclick="uploadoneimg();" ><img src="/images/sys_icon/upload.png" /> 上传</a>
					</td>
					<tr>
						<td class="header">&nbsp;</td>
						<td colspan="3">
							<img id="p_img_view" src="/images/no_img.gif" style="height:80px; border:1px solid #f0f0f0"/>
						</td>
					</tr>
				</tr>
				<tr>
					<td class="header">&nbsp;</td>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td class="header">商品相册</td>
					<td colspan="3">
						<a class="bt_link" href="javascript:void(0)" onclick="uploadimgs();" ><img src="/images/sys_icon/upload.png" /> 批量上传</a>

					</td>
				</tr>
				<tr>
					<td class="header">&nbsp;</td>
					<td colspan="3">
						<div id="p_picture_view" class="piclist"></div>
					</td>
				</tr>
			</table>
		</div>
		<div id="pad_step4" style="display:none;">
			<table class="grid" style="width:100%">
				<tr>
					<td colspan="4"><textarea id="p_content" style="width:700px;height:600px;"></textarea></td>
				</tr>
			</table>
		</div>
		<div id="pad_step5" style="display:none;">
			<table class="grid" style="width:100%">
				<tr>
					<td class="header" style="width:80px;">相关商品</td>
					<td colspan="3">
						<input type="button" style="width:80px; height:22px;" value="上传"/>
					</td>
					<tr>
						<td class="header">&nbsp;</td>
						<td colspan="3">
							<div id="p2p_imglist_view"></div>
						</td>
					</tr>
				</tr>
			</table>
		</div>
	</div>
</div>
</BODY>
</HTML>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/product_update.js"></script>

