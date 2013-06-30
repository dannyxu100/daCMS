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
					<input type="text" id="domain" style="height:22px;" value="sina.com.cn"/>
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
					<span style="color:#900;">(查询前10条是实时数据)</span>
				</td>
			</tr>
			<tr>
				<td class="header">关键词</td>
				<td colspan="3">
					<input type="text" id="keywords" style="width:400px;height:22px;" value="新闻 新浪 新浪新闻 中国新闻 新闻中心 事实的力量 新闻频道 时事报道 新闻,时事,时政,国际,国内,社会,法治,聚焦,评论,文化,教育,新视点,深度,网评,专题,环球,传播,论坛,图片,军事,焦点,排行,环保,校园,法治,奇闻,真情 网易科技,趋势,IT,科技,教程,通信,互联网,网易,论坛,评论,IT业界,产业报道,访谈,股票,A股,证券,行情,大盘,板块,个股,新股,黑马,牛股,主力,基金,研究报告,权证,股吧,牛博,美股,港股,期货,期指,外汇,权证,债券,数码,数码产品,笔记本,平板电脑,手机,数码相机,家电,数码论坛,数码报价,数码排行,网易数码"/>
					<a class="bt_link" href="javascript:void(0)" onclick="seosearch()" ><img src="/images/sys_icon/search.png" /> 查询</a>
					<span style="color:#900;">(多关键词","分隔)</span>
				</td>
			</tr>
		</table>
		
		<div class="notebox">
			1.通过关键词排名查询，可以快速得到当前网站的关键字在Baidu/Google收录的排名情况！<br/>
			2.有些关键词在各地的排名是不一样的，就是通常说的关键字地区排名。<br/>
			3.查询过程中，搜索引擎排名实时变化，会出现局部不准确，属于正常现象。<br/>
			4.频繁查询，会被搜索引擎短暂屏蔽，属于正常现象。<br/>
			5.百度引擎，查询前10条是实时数据，其他都会返回缓存数据，因此排名可能会不一致。<br/>
		</div>
		
		<div id="seo_pad" style="padding:0px 5px;"></div>
		
		<div id="last_pad"></div>
		
	</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/index.js"></script>
