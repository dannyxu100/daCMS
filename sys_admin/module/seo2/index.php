<!--
	关键字百度排名批量查询|PHP网页版
	下载与更新：http://www.baiek.com/ （用这个域名做网站，至少变更过100次主题，最终百事不成，所以，沉痛的教训是--坚持最重要）
	By 198114.com（做企业站与认识企业站的朋友支持一下哦） 落伍会员“百亿客”
	交流邮件与QQ：1468085800@qq.com
	用途：批量查询指定网站、指定关键字在百度的排名情况
	思路：基于PHP程序采集，直接采集百度搜索页面然后略作分析，水平不行，程序写得很暴力，有兴趣的朋友直接拿去折腾吧，修改或推倒重来都随便
	使用：请参考readme.txt
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>关键字百度排名批量查询|PHP网页版|Baiek.com</title>
<base target="_blank" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<style type="text/css">
body{margin:0;padding:0;background:#fff;color:#000;font:12px 微软雅黑, Verdana, Tahoma, Lucida Grande, Arial, sans-serif;text-align:center;}
#wrapper{width:990px;margin:0 auto;line-height:20px;text-align:left;}
#header,#main,#footer{clear:both;float:left;margin:10px 0 0 0;width:100%;}
a,a:visited{color:#0196e3;text-decoration:none;}
form{margin:10px;}
.kinput{width:300px;margin:0 5px;padding:2px;text-align:left;border:1px solid #ccc;font-weight:bold;}
.kbutton{width:80px;margin:0 5px;padding:2px;height:20px;}
#kgrid{float:left;width:100%;}
.s_kw,.s_rank,.s_wt,.s_title,.s_cache,.s_feng,.s_baidu,.s_mu{float:left;height:30px;line-height:30px;overflow:hidden;text-align:left;border:1px solid #c2d5e3;}
.s_bar{clear:both;float:left;width:100%;height:30px;line-height:30px;text-align:center;}
.s_kw{clear:both;width:120px;}
.s_rank{width:30px;}
.s_wt{width:50px;color:#0e774a;}
.s_title{width:340px;}
.s_cache{width:80px;}
.s_feng{width:80px;}
.s_baidu{width:150px;}
.s_mu{width:120px;}
</style>
</head>

<body>
<div id="wrapper">
<?php
function tongji()
{
	$myhost = $_SERVER['HTTP_HOST'];
	if (preg_match("/(www\.)?baiek\.com/i", $myhost, $myout))
	{
		echo '<script language="javascript" type="text/javascript" src="http://js.users.51.la/4295418.js"></script>';
	}
}

function libxml_display_error($error) 
{ 
	$return = "<br/>\n"; 
	switch ($error->level)
	{ 
		case LIBXML_ERR_WARNING: 
			$return .= "<b>Warning $error->code</b>: "; 
			break; 
		case LIBXML_ERR_ERROR: 
			$return .= "<b>Error $error->code</b>: "; 
			break; 
		case LIBXML_ERR_FATAL: 
			$return .= "<b>Fatal Error $error->code</b>: "; 
			break; 
	} 
	$return .= trim($error->message); 
	if ($error->file)
	{ 
		$return .= " in <b>$error->file</b>"; 
	} 
	$return .= " on line <b>$error->line</b>\n"; 
	return $return; 
} 

function libxml_display_errors()
{ 
	$errors = libxml_get_errors(); 
	foreach ($errors as $error)
	{ 
		print libxml_display_error($error); 
	} 
	libxml_clear_errors(); 
}

$kfname = '';
if (isset($_GET['kf']))
{
	$kfname = trim($_GET['kf']);
}
$version = '<script language="javascript" type="text/javascript" src="http://www.baiek.com/version.js"></script>';
echo <<< EOTH
<div id="header">
	做企业站或认识企业站的朋友，请支持一下我的小站 <a href="http://www.198114.com/"><b>198114产品企业分类目录</b></a>，多谢多谢！！
	<a href="http://www.baiek.com/" target="_self"><h1>关键字百度排名批量查询（PHP网页版） Baiek.Com</h1></a>
	<form method="GET" target="_self">
		<input id="kf" name="kf" type="text" class="kinput" value="{$kfname}" />
		<input id="submitbtn" type="submit" class="kbutton" value="批量查询" />
		&emsp;<a href="http://www.baiek.com/baiek.rar" target="_self"><b>点击此处下载（更新于{$version}）</b></a>
		&emsp;在线演示：<a href="http://www.baiek.com/?kf=kw1.xml" target="_self">演示1</a>&emsp;<a href="http://www.baiek.com/?kf=kw2.xml" target="_self">演示2</a>&emsp;<a href="http://www.baiek.com/?kf=kw3.xml" target="_self">演示3</a>
	</form>
</div>

EOTH;
if (!file_exists($kfname) || !is_readable($kfname))
{
	tongji();
	exit('请输入正确的关键字清单文件（XML格式，请参考<a href="http://www.baiek.com/readme.txt">readme</a>文件）！！');
}
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->load($kfname);
if (!$doc->schemaValidate('kw.xsd'))
{
	print '<b>关键字列表XML文件发现错误！</b>'; 
	libxml_display_errors(); 
	tongji();
	exit;
}

//由XML文件提取关键字列表与相应的域名
$kwlist = array();	$g = 1;
$kgroups = $doc->getElementsByTagName("kgroup");
foreach ($kgroups as $kgroup)
{
	$kwlist[$g]['domain'] = trim($kgroup->getElementsByTagName("kdomain")->item(0)->nodeValue);
	$kwords = $kgroup->getElementsByTagName("kword");
	$w = 1;
	foreach ($kwords as $kword)
	{
		if ($kword->hasChildNodes())
		{
			$kwlist[$g]['kword'][$w] = trim($kword->firstChild->nodeValue);
		}
		$w++;
	}
	$g++;
}
?>
<div id="main">
<?php
function get_dm_weight($h, $i)
{
	//$h表示搜索结果的url，$i表示结果排名
	$p = ceil($i / 10);		//搜索结果第几页
	
	$i_weight = array(1 => 52, 2 => 15, 3 => 10, 4 => 5, 5 => 5, 6 => 4, 7 => 1, 8 => 3, 9 => 2, 0 => 3);
	$h_str = preg_replace("/^.*?:\/\/(.*?)(#.*)?$/i", "$1$3", $h);	//去除url中的协议（例如http）与#信息片段部分
	$h_arr = explode("?", $h_str, 2);
	$h0_arr = explode("/", $h_arr[0]);
	if ($h0_arr[count($h0_arr) - 1] == '')
	{
		$level_l = count($h0_arr) - 1;
	}
	else
	{
		$level_l = count($h0_arr);
	}
	if (isset($h_arr[1]))
	{
		if ($h_arr[1] != '')
		{
			$level_r = count(explode("&", $h_arr[1]));
		}
		else
		{
			$level_r = 0;
		}
	}
	else
	{
		$level_r = 0;
	}
	$dw = $i_weight[$i % 10] * pow(0.5, ($level_l + $level_r - 1)) * 9 / pow(10, $p);
	return number_format($dw, 1);;
}

function fetch_baidu($d, $k)
{
	$urlw = urlencode(iconv("UTF-8","GBK//IGNORE",$k));
	$max_srh_page = 2;	//百度搜索结果50条/页，提取2页，也就是只在前100条搜索结果中检查排名，最大值可以设为16
	$baidu_ids = array();	//存储百度系列子站点占据的排名位置
	$baidu_mus = array();	//存储百度开放平台等优质站点占据的排名位置
	$isrank = 0;	//$isrank = 1 当前域名下这个关键词获得排名;	$isrank = 0 当前域名下这个关键词没有排名
	$all_count = 0;	//测试变量，以确认匹配规则不会遗漏任何一条搜索结果
	$dm_weight = 0;	//分析搜索结果页面中顶级、次级、目录、内页的情况，粗略反映一个关键字的竞争激烈程度，非常不准，仅供参考
	for ($page_no = 1; $page_no <= $max_srh_page; $page_no++)
	{
		if ($page_no > 16) break;
		$fail_try = 1;
		$pn = ($page_no - 1) * 50;
		$url = "http://www.baidu.com/s?wd={$urlw}&pn={$pn}&rn=50";
		$snoopy = new Snoopy;
//		$snoopy->proxy_host = "127.0.0.1";	//采集可选代理IP，以免频繁抓百度反被百度咬
//		$snoopy->proxy_port = "80";			//proxy代理所用端口
		$snoopy->fetch($url);
		$contents = iconv("GBK","UTF-8//IGNORE",$snoopy->results);
		unset($snoopy);
//		echo $contents;
		if (!preg_match("/<span>此内容系百度根据您的指令自动搜索的结果/i",$contents,$out))
		{
			if ($fail_try > 5)
			{
				continue;
			}
			else
			{
				$fail_try++;
				$page_no--;
				sleep(30);
				continue;
			}
		}
		if (!isset($ebaidu))
		{
			$ebaidu = array('lt' => 0, 'lb' => 0, 'r' => 0);	//记录百度推广数量，分为左上、左下、右侧
			if (preg_match_all("/<tr><td class=\"f EC_PP\"><a id=\"aw\d+\"/i", $contents, $out_lt))
			{
				$ebaidu['lt'] = count($out_lt[0]);
			}
			if (preg_match_all("/<table id=\"40\d+\".*?class=\"EC_mr15\">/i", $contents, $out_lt))
			{
				$ebaidu['lt'] = count($out_lt[0]);
			}
			if (preg_match_all("/<table width=\"65%\".*?class=\"EC_mr15\">/i", $contents, $out_lb))
			{
				$ebaidu['lb'] = count($out_lb[0]);
			}
			if (preg_match_all("/<div id=\"bdfs\d+\" class=\"EC_PP\".*?><a id=dfs\d+/i", $contents, $out_r))
			{
				$ebaidu['r'] = count($out_r[0]);
			}
		}
		if (preg_match_all("/((<table cellpadding=\"0\" cellspacing=\"0\".*?id=\"(\d+)\" mu=\"(.*?)\">)|(<table id=\"(\d+)\"  cellpadding=\"0\" cellspacing=\"0\" mu=\"(.*?)\">))[\s|\S]*?((<a.*?href=\".*?\".*?>(.*?)<\/a>)|(<div id=\"app_.*?\"><\/div>))/i", $contents, $out_mu))
		{
			foreach ($out_mu[0] as $om_key => $om_val)
			{
				$om_id1 = $out_mu[3][$om_key];
				$om_href1 = $out_mu[4][$om_key];
				$om_id2 = $out_mu[6][$om_key];
				$om_href2 = $out_mu[7][$om_key];
				$om_title = strip_tags($out_mu[10][$om_key]);
				$baidu_mus[] = $om_id1 . $om_id2;
				$dm_weight = $dm_weight + get_dm_weight($om_href1 . $om_href2, $om_id1 . $om_id2);
				if (preg_match("/:\/\/(\w*?\.)*?baidu\.com\//i", $om_href1 . $om_href2, $om_domain))
				{
					$baidu_ids[] = $om_id1 . $om_id2;
				}
				if (preg_match("/:\/\/(\w*?\.)*?{$d}\//i", $om_href1 . $om_href2, $om_domain))
				{
					echo '<div style="clear:both"></div><span class="s_kw"><a href="http://www.baidu.com/s?wd=' . $urlw . '">' . $k . '</a></span><span class="s_rank">' . $om_id1 . $om_id2 . '</span><span class="s_wt"></span><span class="s_title"><a href="' . $om_href1 . $om_href2 . '">' . $om_title . '</a></span><span class="s_cache"></span>';
					$isrank = 1;
				}
			}
		}
		if (preg_match_all("/<table cellpadding=\"0\" cellspacing=\"0\" class=\"result\" id=\"(\d+)\"><tr><td class=f><h3 class=\"t\">(<font.*?<\/font>)?<a.*?href=\"(.*?)\" target=\"_blank\">(.*?)<\/a><\/h3><font size=\-1>.*?<span class=\"g\">.*? ((\d{4}\-\d{1,2}\-\d{1,2})|(\d+小时前)|(\d+分钟前)) .*?<\/span>.*?<br><\/font><\/td><\/tr><\/table>/i", $contents, $out_all))
		{
			foreach ($out_all[0] as $o_key => $o_val)
			{
				$o_id = $out_all[1][$o_key];
				$o_href = $out_all[3][$o_key];
				$o_title = strip_tags($out_all[4][$o_key]);
				$o_cache = $out_all[6][$o_key] . $out_all[7][$o_key] . $out_all[8][$o_key];
				$dm_weight = $dm_weight + get_dm_weight($o_href, $o_id);
				if (preg_match("/:\/\/(\w*?\.)*?baidu\.com\//i", $o_href, $o_domain))
				{
					$baidu_ids[] = $o_id;
				}
				if (preg_match("/:\/\/(\w*?\.)*?{$d}\//i", $o_href, $o_domain))
				{
					echo '<div style="clear:both"></div><span class="s_kw"><a href="http://www.baidu.com/s?wd=' . $urlw . '">' . $k . '</a></span><span class="s_rank">' . $o_id . '</span><span class="s_wt">' . $dm_weight . '%</span><span class="s_title"><a href="' . $o_href . '">' . $o_title . '</a></span><span class="s_cache">' . $o_cache . '</span>';
					$isrank = 1;
				}
			}
		}
		//$all_count用来检查上述正则匹配是否匹配到所有搜索结果，特别关注百度系列站点、百度开放平台以及百度应用等有别于普通搜索结果
		if (isset($out_mu[0])) $all_count = $all_count + count($out_mu[0]);
		if (isset($out_all[0])) $all_count = $all_count + count($out_all[0]);
//		echo '<br />总共找到' . $all_count . '个匹配<br />';
		if (!preg_match("/<a href=\"s\?wd=.*?>下一页<\/a>.*?<\/p>/i",$contents,$out))
		{
			break;
		}
	}
	if (count($baidu_mus) >= 1)
	{
		$bmus = implode(",", $baidu_mus);
	}
	else
	{
		$bmus = '';
	}
	if (count($baidu_ids) >= 1)
	{
		$bids = implode(",", $baidu_ids);
	}
	else
	{
		$bids = '';
	}
	if ($isrank == 1)
	{
		echo '<span class="s_feng">上' . $ebaidu['lt'] . '下' . $ebaidu['lb'] . '右' . $ebaidu['r'] . '</span><span class="s_baidu">' . $bids . '</span><span class="s_mu">' . $bmus . '</span>';
	}
	else
	{
		echo '<div style="clear:both"></div><span class="s_kw"><a href="http://www.baidu.com/s?wd=' . $urlw . '">' . $k . '</a></span><span class="s_rank">0</span><span class="s_wt">' . $dm_weight . '%</span><span class="s_title"></span><span class="s_cache"></span><span class="s_feng">上' . $ebaidu['lt'] . '下' . $ebaidu['lb'] . '右' . $ebaidu['r'] . '</span><span class="s_baidu">' . $bids . '</span><span class="s_mu">' . $bmus . '</span>';
	}
	unset($ebaidu);
}
//逐个域名与关键字采集百度排名信息并显示
set_include_path(".");
include "Snoopy.class.php";
set_time_limit(0);
ob_flush(); flush(); ob_end_clean(); ob_implicit_flush(1);
echo '<div id="kgrid">';
echo '<span class="s_kw">关键字</span><span class="s_rank">排名</span><span class="s_wt">竞争度</span><span class="s_title">网页标题</span><span class="s_cache">百度快照</span><span class="s_feng">百度推广数量</span><span class="s_baidu">百度占位</span><span class="s_mu">百度mu占位</span>';
foreach ($kwlist as $d_ks)
{
	$dm = $d_ks['domain'];
	echo '<div style="clear:both"></div><span class="s_bar">域名：' . $dm . '</span>';
	foreach ($d_ks['kword'] as $k)
	{
		fetch_baidu($dm, $k);
	}
}
echo '</div>';
?>
</div><!--div main end-->
</div><!--div wrap end-->
<?php
tongji();
?>
</body>
</html>
