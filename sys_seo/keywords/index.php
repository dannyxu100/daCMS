<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<HEAD>
		<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
		<link rel="stylesheet" href="/css/base.css"/>

		<TITLE>关键词查询-seo工具</TITLE>

	</HEAD>

	<BODY>
		<table class="grid" style="width:100%">
			<tr>
				<td class="header" style="width:80px;">网站地址</td>
				<td colspan="3">
					<input type="text" id="domain" style="height:22px;" value="news.sina.com.cn"/>
				</td>
			</tr>
			<tr>
				<td class="header">搜索引擎</td>
				<td colspan="3">
					<select id="engine" > 
						<option value="1">百度搜索</option> 
						<option value="2" disabled="disabled">Google搜索</option>
					</select>
					<select name="rn" id="rn">
						<option value=10 >前10条</option>
						<option value=20 >前20条</option>
						<option value=50 >前50条</option>
						<option value=100 selected="selected">前100条</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="header">关键词</td>
				<td colspan="3">
					<input type="text" id="keywords" style="width:400px;height:22px;" value="新闻 新浪 新浪新闻 中国新闻 新闻中心 事实的力量 新闻频道 时事报道 新闻,时事,时政,国际,国内,社会,法治,聚焦,评论,文化,教育,新视点,深度,网评,专题,环球,传播,论坛,图片,军事,焦点,排行,环保,校园,法治,奇闻,真情"/>
					<a class="bt_link" href="javascript:void(0)" onclick="seosearch()" ><img src="/images/sys_icon/search.png" /> 查询</a>
					<span style="color:#900;">(多关键词","分隔)</span>
				</td>
			</tr>
		</table>
		
		<div class="notebox">
			1.通过关键词排名查询，可以快速得到当前网站的关键字在Baidu/Google收录的排名情况！<br/>
			2.有些关键词在各地的排名是不一样的，就是通常说的关键字地区排名。<br/>
		</div>
		
		<div id="seo_pad" style="padding:20px;"></div>
		
		<div id="last_pad"></div>
		
	</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/index.js"></script>
