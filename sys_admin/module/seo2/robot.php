<?php
$ROBOT['google']['name'] = '谷歌';
$ROBOT['google']['site_url'] = 'http://www.google.com/search?hl=zh-CN&q=site%3A';
$ROBOT['google']['site_pattern'] = "/获得(.*) 条结果/";
$ROBOT['google']['link_url'] = 'http://www.google.com/search?hl=zh-CN&q=link%3A';
$ROBOT['google']['link_pattern'] = "/获得(.*) 条结果/";

$ROBOT['baidu']['name'] = '百度';
$ROBOT['baidu']['site_url'] = 'http://www.baidu.com/s?wd=site%3A';
$ROBOT['baidu']['site_pattern'] = "/找到相关网页(.*)篇/";
$ROBOT['baidu']['link_url'] = 'http://www.baidu.com/s?wd=domain%3A';
$ROBOT['baidu']['link_pattern'] = "/找到相关网页(.*)篇/";

$ROBOT['yahoo']['name'] = '雅虎';
$ROBOT['yahoo']['site_url'] = 'http://search.cn.yahoo.com/search?p=site%3A';
$ROBOT['yahoo']['site_pattern'] = "/找到相关网页(.*)条/";
$ROBOT['yahoo']['link_url'] = 'http://search.cn.yahoo.com/search?p=linkdomain%3A';
$ROBOT['yahoo']['link_pattern'] = "/找到相关网页(.*)条/";

$ROBOT['sogou']['name'] = '搜狗';
$ROBOT['sogou']['site_url'] = 'http://www.sogou.com/web?query=site%3A';
$ROBOT['sogou']['site_pattern'] = "/找到 (.*) <!--resultbarnum:(.*)-->个网页/";;
$ROBOT['sogou']['link_url'] = 'http://www.sogou.com/web?query=link%3A';
$ROBOT['sogou']['link_pattern'] = "/找到 (.*) <!--resultbarnum:(.*)-->个网页/";;

$ROBOT['so163']['name'] = '必应';
$ROBOT['so163']['site_url'] = 'http://cn.bing.com/search?q=site%3A';
$ROBOT['so163']['site_pattern'] = "/共 (.*) 条结果/";
$ROBOT['so163']['link_url'] = 'http://cn.bing.com/search?q=link%3A';
$ROBOT['so163']['link_pattern'] = "/共 (.*) 条结果/";

$ROBOT['vnet']['name'] = '有道';
$ROBOT['vnet']['site_url'] = 'http://www.youdao.com/search?q=site%3A';
$ROBOT['vnet']['site_pattern'] = "/共(.*)条结果/";
$ROBOT['vnet']['link_url'] = 'http://www.youdao.com/search?q=link%3A';
$ROBOT['vnet']['link_pattern'] = "/共(.*)条结果/";

$ROBOT['soso']['name'] = '搜搜';
$ROBOT['soso']['site_url'] = 'http://www.soso.com/q?w=site%3A';
$ROBOT['soso']['site_pattern'] = "/搜索到(.*)项结果/";
$ROBOT['soso']['link_url'] = 'http://www.soso.com/q?w=link%3A';
$ROBOT['soso']['link_pattern'] = "/搜索到(.*)项结果/";
?>