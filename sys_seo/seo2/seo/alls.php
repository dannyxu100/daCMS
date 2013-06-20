<?php
eval('$__file__=__FILE__;');
define('ROOT_PATH',$__file__ ? dirname($__file__).'/' : './');
//搜索引擎反向链接及收录
include '../robot.php';
require '../global.php';
$domain = isset($_POST['domain'])?$_POST['domain']:isset($_GET['domain'])?$_GET['domain']:"";
$domain = strtolower($domain);
$domain = $domain?$domain:'chinaccnet.com';
is_domain($domain) or exit( "<script language=javascript>alert('请输入正确的域名！');location.href='alls.php';</script>");
//META信息检测结果
$url = 'http://'.trim($domain);
$content = @file_get_contents($url);
$charset = "/charset=(.*)/";
preg_match($charset,$content,$charsetarr);
$charset2 = strtolower(substr($charsetarr[1],0,2));
if($charset2 != 'gb'){
	require_once('require/chinese.php');
	$chs     = new Chinese('utf-8','GB2312');
	$content = $chs->Convert($content);
}
$pat1  = "/<title>(.*)<\/title>/si";
preg_match_all($pat1, $content, $array);
$title = $array[1][0];
$tt    = $title?mb_strlen($title,'gbk'):'0';
$pat2  = "/meta content=\"(.+)\" name=\"keywords\"/Ui";
$pat4  = "/meta name=\"keywords\" content=\"(.+)\"/Ui";
preg_match_all($pat2, $content, $array2);
preg_match_all($pat4, $content, $array4);
$keywords = !empty($array2[1][0])?$array2[1][0]:$array4[1][0];
$k    = $keywords?mb_strlen($keywords,'gbk'):'0';
$pat3 = "/<meta content=\"(.+)\" name=\"description\"/Ui";
$pat5 = "/<meta name=\"description\" content=\"(.+)\"/Ui";
preg_match_all($pat3, $content, $array3);
preg_match_all($pat5, $content, $array5);
$description = !empty($array3[1][0])?$array3[1][0]:$array5[1][0];
$d = $description?mb_strlen($description,'gbk'):'0';
//搜索蜘蛛、机器人模拟
$bods = "/<body>(.*)<\/body>/is";
preg_match_all($bods, $content, $array4);
$pat4 = "/>(.*)</U";
preg_match_all($pat4, $array4[0][0], $array5);
$body = "";
for($i=0;$i<sizeof($array5[1]);$i++){
	$body .= $array5[1][$i]." ";
}
$pat44 = "/>(.*)</Us";
preg_match_all($pat44, $array4[0][0], $array55);
$body2 = "";
for($i=0;$i<sizeof($array55[1]);$i++){
	$body2 .= $array55[1][$i]." ";
}
//关键词密度
$keys  = explode(',', $keywords );
if($keys[0]){
	$keyss = "<br/><table border=1 width=100% bordercolordark=#FFFFFF cellspacing=0 cellpadding=0 bordercolorlight=#BBD7E6><tr bgcolor=#D8F0FC><td>关键词</td><td>出现频率</td><td>2%≦密度≦8%</td><td>百度排名</td><td>Google排名</td></tr>";
	$body2 = preg_replace(array("/\s/","<br/>"),array("",),$body2);
	for($t=0;$t<sizeof($keys);$t++){
		$keys[$t]  = preg_replace(array("/\s/","<br/>"),array("",),$keys[$t]);
		$keys1 = "/".$keys[$t]."/";
		preg_match_all($keys1,$body2,$densti);
		$a1 = mb_strlen($body2,'gbk');
		$a2 = mb_strlen($keys[$t],'gbk');
		$a3 = sizeof($densti[0]);
		$a4 = $a2*$a3;
		$a5 = @(round($a4/$a1*100,1)."%");
		$text     = $keys[$t];
		$output   = '';
		$tab_text = str_split($text); 
		foreach ($tab_text as $id=>$char){
		  $hex = dechex(ord($char));
		  $output .= '%' . $hex;
		}
		$keyss .= "<tr><td><div id=keys".$t.">".$keys[$t]."</div></td><td>".$a3."</td><td>".$a5."</td><td><div name=cha1 id=cha".$t."><a href=http://www.baidu.com/s?wd=".$output." target=_blank>查看</a></div></td><td><a href=http://www.google.com.hk/search?q=".$output." target=_blank>查看</a></td></tr>";
		@unlink($densti);
	}
	$keyss .= "</table>";
}
//PR
@require_once('../pr/prfunction.php');
$PR = '<img src="../images/pagerank'.GetPR($domain).'.gif" align="absmiddle" /> '.$domain;
$body = strlen($body)>800 ? substr($body,0,800).'…………' : $body;
@require_once('../cache.php');
if(file_exists("../cache/seo.php")){
	@require_once("../cache/seo.php");
    $urls = filehave($urls,$domain);
}else{
	$urls = fileno($domain);
}
writeover("../cache/seo.php","<?php\r\n\$urls=".vvar_export($urls).";\r\n?>");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?php echo $domain;?>的SEO综合查询-站长工具 - 中国站长社区 Powered by cnzzsq.com</title>
<link href="/sys_admin/module/seo2/images/toolsite.css" rel="stylesheet" type="text/css" />
<script src="/sys_admin/module/seo2/images/globals.js" type="text/javascript"></script>
<script src="/sys_admin/module/seo2/images/home.js" type="text/javascript"></script>
<script type="text/javascript">
function $(ID) {
	return document.getElementById(ID);
}
	var xmlHttp;
	function creatXMLHttpRequest() {
		if(window.ActiveXObject) {
			xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
		} else if(window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		}
	}

	function startRequest() {
		var queryString;
		var domain = document.getElementById('domain').value;
		queryString = "domain=" + domain;
		creatXMLHttpRequest();
		xmlHttp.open("POST","?action=do","true");
		xmlHttp.onreadystatechange = handleStateChange;
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xmlHttp.send(queryString);
	}

	function handleStateChange() {
		if(xmlHttp.readyState == 1) {
			document.getElementById('result').style.cssText = "";
			document.getElementById('result').innerText = "Loading...";
		}
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) {
				document.getElementById('result').style.cssText = "";
				var allcon =  xmlHttp.responseText;
				document.getElementById('result').innerHTML = allcon;
			}
		}
	}

function copyToClipboard(txt) {   
     if(window.clipboardData) {   
         window.clipboardData.clearData();   
         window.clipboardData.setData("Text", txt);   
     } else if(navigator.userAgent.indexOf("Opera") != -1) {   
          window.location = txt;   
     } else if (window.netscape) {   
          try {   
               netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");   
          } catch (e) {   
               alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");   
          }
          var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);   
          if (!clip)
               return;
          var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);   
          if (!trans)   
               return;   
          trans.addDataFlavor('text/unicode');   
          var str = new Object();   
          var len = new Object();   
          var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);   
          var copytext = txt;   
          str.data = copytext;   
          trans.setTransferData("text/unicode",str,copytext.length*2);   
          var clipid = Components.interfaces.nsIClipboard;   
          if (!clip)   
               return false;   
          clip.setData(trans,null,clipid.kGlobalClipboard);
     }   
}
function killErrors() {
return true;
}
window.onerror = killErrors;

</script>
</head>
<body>
<div class="wrap"> 
<div class="top-nav">
    <div class="top-menu">
    <a href="http://www.chinaccnet.com/" target="_parent">中电云集数据中心</a> | 
    <a href="http://www.yunads.com" target="_blank"><b>云广告联盟</b></a> |
    <a href="http://www.yundns.com/" target="_blank">云集互联</a> | 
    <a href="/sys_admin/module/seo2/" target="_blank">站长工具</a> | 
    <a href="http://www.xnzjpc.com/" target="_blank">虚拟主机评测</a> |
	<a href="http://www.cnzzsq.com/" target="_blank">中国站长社区</a> |
	<a href="http://www.cnzzsq.com/phpcode" target="_blank">PHP源码下载</a> | 
	<a href="http://www.yundns.com" target="_blank"><font color="red">20人合租第二期热销中.. </font></a>
    </div>
 </div>
  <div class="top">
    <div class="topbanner"><script type="text/javascript">
  u_a_client="38";
  u_a_width="468"; 
  u_a_height="60"; 
  u_a_zones="572"; 
  u_a_type="0"; 
</script>
<script src="http://www.yunads.com/i.js"></script></div>
    <div class="banneright">
<ul><li><a href="http://www.chinaccnet.com/server01.php" target="_blank"><font color="blue">中电云集服务器3600元/年</font></a></li>
<li><a href="http://www.chinaccnet.com/haiwai.php" target="_blank"><font color="red">中电云集1.3G美国空间199元</font></a></li>
<li><a href="http://www.chinaccnet.com/xianggang.php" target="_blank"><font color="blue">中电云集免备案香港空间上线</font></a></li>
</ul>
	</div>
  </div>
  <div class="menu"><a href="http://www.cnzzsq.com/">首页</a> <a href="/sys_admin/module/seo2/" class="select">站长工具</a> 
   <a onmouseover="mouseover(this, 3)" onmouseout="mouseout()" style="cursor:pointer;">网站信息查询</a> 
   <a onmouseover="mouseover(this, 4)" onmouseout="mouseout()" style="cursor:pointer;">SEO信息查询</a> 
   <a onmouseover="mouseover(this, 5)" onmouseout="mouseout()" style="cursor:pointer;">域名/IP类查询</a> 
   <a onmouseover="mouseover(this, 6)" onmouseout="mouseout()" style="cursor:pointer;">代码转换工具</a> 
   <a onmouseover="mouseover(this, 7)" onmouseout="mouseout()" style="cursor:pointer;">其他工具</a>
	<a href="http://bbs.cnzzsq.com/read.php?tid=96" target="_blank">站长工具源码下载</a>
<a href="http://bbs.cnzzsq.com/" target="_blank"><font color="red">讨论区</font></a>
  </div>
  <!--sub menu-->
  <div id="menu3" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="http://alexa.cnzzsq.com" target="_blank">ALEXA排名查询</a></li>
    <li><a href="/sys_admin/module/seo2/webs/webs.php" target="_blank">站内链接分析</a></li>
    <li><a href="/sys_admin/module/seo2/density.php">关键词密度检测</a></li>
    <li><a href="/sys_admin/module/seo2/meta.php">META信息检测</a></li>
    <li><a href="/sys_admin/module/seo2/pr/outpr.php">PR输出值查询</a></li>
    <li><a href="/sys_admin/module/seo2/yuan.php">查看网页源代码</a></li>
    </ul>
  </div>
  <div id="menu4" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="/sys_admin/module/seo2/friends/friends.php">友情链接检测</a></li>
    <li><a href="/sys_admin/module/seo2/keys/keys.php">关键词排名查询</a></li>
    <li><a href="/sys_admin/module/seo2/baidu/baidu.php">百度近日收录</a></li>
    <li><a href="/sys_admin/module/seo2/google/google.php">Google收录</a></li>
    <li><a href="/sys_admin/module/seo2/ssyqsl/ssyqsl.php">网站收录查询</a></li>
    <li><a href="/sys_admin/module/seo2/ssyqfl/ssyqfl.php">反向链接查询</a></li>
    <li><a href="/sys_admin/module/seo2/pr/pr.php">PR查询</a></li>
    <li><a href="/sys_admin/module/seo2/esearch.php">机器人模拟</a></li>
    </ul>
  </div>
  <div id="menu5" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="/sys_admin/module/seo2/dels/dels.php">域名删除时间</a></li>
    <li><a href="/sys_admin/module/seo2/ip/">IP查询</a></li>
    <li><a href="/sys_admin/module/seo2/whois/">WHOIS查询</a></li>
    <li><a href="/sys_admin/module/seo2/friendlink/friendlink.php">友情链接IP查询</a></li>
    </ul>
   </div>
   <div id="menu6" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
     <ul>
      <li><a href="/sys_admin/module/seo2/mds.php?mds=md5">MD5加密</a></li>
      <li><a href="/sys_admin/module/seo2/js.php">JS加密/解密</a></li>
      <li><a href="/sys_admin/module/seo2/htmljs.php">HTML/JS互转</a></li>
      <li><a href="/sys_admin/module/seo2/unicode.php">Unicode转换</a></li>
      <li><a href="/sys_admin/module/seo2/utf.php">Utf-8编码转换</a></li>
      <li><a href="/sys_admin/module/seo2/htmlubb.php">HTML/UBB互转</a></li>
      <li><a href="/sys_admin/module/seo2/unix.php">Unix时间戳转换</a></li>
     </ul>
   </div>
    <div id="menu7" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
     <ul>
      <li><a href="/sys_admin/module/seo2/ids.php">身份证号码查询</a></li>
      <li><a href="/sys_admin/module/seo2/shouji/index.php">手机号码归属地</a></li>
      <li><a href="/sys_admin/module/seo2/yb/yb.php">邮编区号查询</a></li>
      <li><a href="/sys_admin/module/seo2/countryym.php">国家域名查找</a></li>
     </ul>
   </div> 
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript">
window.onload=function ajaxs(){	
	for(var i=1;i<7;i++){
	   talktoServer('ajax.php?action=a'+i+'&lurl='+$('domain').value,'a'+i,"html");
	}
}
</script>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>SEO综合查询</h1>
      <div class="box1" style="text-align:center;"> 
      <form action="" method="POST">
          <span class="info3" > 请输入要查询的域名：
           <font color="green"><b>HTTP://</b></font> <input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $domain;?>"/>
            <input name="btnS" class="but" type="submit" value="查询"  id="sub"/>
            </form>
          </span>
<div class="t" id="seo_result">
<?php echo $PR;?>
<br/>
<table border="1" width="100%" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0" bordercolorlight="#BBD7E6">
<tr bgcolor=#D8F0FC><td colspan="5">百度相关</td></tr>
<tr><td>有<?php echo $domain;?>的网页</td><td>百度快照</td><td>今日收录</td><td>最近一周</td><td>最近一月</td></tr>
<tr><td><span id="a1">&nbsp;<img src="../images/loading2.gif"></span></td><td><span id="a2">&nbsp;<img src="../images/loading2.gif"></span></td><td><span id="a3">&nbsp;<img src="../images/loading2.gif"></span></td><td><span id="a4">&nbsp;<img src="../images/loading2.gif"></span></td><td><span id="a5">&nbsp;<img src="../images/loading2.gif"></span></td></tr>
</table>
<br/>
<span id="a6"><table border=1 width=100% bordercolordark=#FFFFFF cellspacing=0 cellpadding=0 bordercolorlight=#BBD7E6>
<tr bgcolor=#D8F0FC><td colspan="9">网址<a href="<?php echo "http://".$domain;?>"><?php echo "http://".$domain;?></a>在各大搜索引擎的收录查询结果</td></tr>
<tr><td>搜索引擎</td><td>谷歌</td><td>百度</td><td>雅虎</td><td>搜狗</td><td>必应</td><td>有道</td><td>搜搜</td></tr>
<tr><td>收录数量</td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td></tr>
<tr><td>反向链接</td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td><td><img src="../images/loading2.gif"></td></tr>
</table></span>
<br/>
<table border="1" width="100%" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0" bordercolorlight="#BBD7E6"><tr bgcolor=#D8F0FC><td colspan="4">网址<a href="<?php echo "http://www.".$domain?>"><?php echo "http://www.".$domain?></a>META信息检测结果如下:</td></tr>
<tr><td width="20%">标签</td><td width="10%">内容长度</td><td width="50%">内容</td><td width="20%">优化建议</td></tr>
<tr><td>标题（Title）</td><td><?php echo $tt;?>个字符</td><td>&nbsp;<?php echo $title;?></td><td>一般不超过80个字符</td></tr>
<tr><td>关键词（KeyWords）</td><td><?php echo $k;?>个字符</td><td>&nbsp;<?php echo $keywords;?></td><td>一般不超过100个字符</td></tr>
<tr><td>描述（Description）</td><td><?php echo $d;?>个字符</td><td>&nbsp;<?php echo $description;?></td><td>一般不超过200个字符</td></tr>
</table>
<?php echo $keyss;?>
<br/>
<table border="1" width="100%" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0" bordercolorlight="#BBD7E6">
<tr bgcolor=#D8F0FC><td>搜索蜘蛛、机器人模拟</td></tr>
<tr><td><?php echo $body; ?> &nbsp; <a href="../esearch.php?domain=<?php echo $domain;?>" target="_blank">点击查看全部</a></td></tr>
</table>
</div>
</div>
<div id="b_14">
<h1>最近查询：</h1>
<div class="box1">
<span class="info2"> 
<table>
<tr><td align="left" style= "word-wrap:break-word;word-break:break-all">
<?php
@require_once('../cache/seo.php');
if($urls){
foreach ($urls as $key=>$v){
	echo "<a href=/sys_admin/module/seo2/seo/alls.php?domain=".$urls[$key].">".$urls[$key]."</a>&nbsp;&nbsp;";
}}?></td></tr>
</table>
</span>
</div>
<div class="box">
  <div id="b_14">
    <h1>工具简介</h1>
    <div class="box1">
        <span class="info2">SEO综合查询</span>
    </div>
  </div>
</div>
<?php @require_once('../foot.php');?>