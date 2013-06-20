<?php
header("Content-Type:text/html;charset=GB2312");
$domain = trim($_POST['domain']);
$domain = strtolower($domain);
if(!$domain && $_GET['domain']){
	$domain = strtolower(trim($_GET['domain']));
}
$domain = $domain?$domain:'chinaccnet.com';
if($domain){
	@require_once('../cache.php');
	if(file_exists("../cache/whoischace.php")){
		@require_once("../cache/whoischace.php");
		$urls = filehave($urls,$domain);
	}else{
	$urls = fileno($domain);
	}
	writeover("../cache/whoischace.php","<?php\r\n\$urls=".vvar_export($urls).";\r\n?>");
}
if(substr($domain,0,7) == "http://") {
	$domain = str_replace("http://","",$domain);
}
if(substr($domain,0,4) == "www.") {
	$domain = str_replace("www.","",$domain);
}
if($domain){
	preg_match("/<div class=\"lyTableInfoWrap\">(.+?)<\/div>/is", @file_get_contents('http://www.xinnet.cn/Modules/agent/serv/pages/domain_whois.jsp?domainNameWhois='.$domain.'&noCode=noCode'), $whois);
	$result = $whois[0];
	$result = str_replace("Billing Contact","财务联系",$result);
	$result = str_replace("Technical Contact","技术联系",$result);
	$result = str_replace("Administrative Contact","管理人联系",$result);
	$result = str_replace("Expiration Date","过期时间",$result);
	$result = str_replace("Updated Date","更新时间",$result);
	$result = str_replace("Creation Date","创建时间",$result);
	$result = str_replace("Status","状态",$result);
	$result = str_replace("Name Server","DNS服务器",$result);
	$result = str_replace("Referral URL","相关网站",$result);
	$result = str_replace("Registrar:","注册商:",$result);
	$result = str_replace("Whois Server:","域名服务器:",$result);
	$result = str_replace("no data found!"," ",$result);
	$result = str_replace("-jan","-1月",$result);
	$result = str_replace("-feb","-2月",$result);
	$result = str_replace("-mar","-3月",$result);
	$result = str_replace("-apr","-4月",$result);
	$result = str_replace("-may","-5月",$result);
	$result = str_replace("-jun","-6月",$result);
	$result = str_replace("-jul","-7月",$result);
	$result = str_replace("-aug","-8月",$result);
	$result = str_replace("-sep","-9月",$result);
	$result = str_replace("-oct","-10月",$result);
	$result = str_replace("-nov","-11月",$result);
	$result = str_replace("-dec","-12月",$result);
	$resul2 = "访问此网站：<a href=http://".$domain.">http://".$domain."</a><br/>".$result;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?php echo $domain;?>的Whois信息-站长工具 - 中国站长社区 Powered by cnzzsq.com</title>
<link href="http://tool.cnzzsq.com/images/toolsite.css" rel="stylesheet" type="text/css" />
<script src="http://tool.cnzzsq.com/images/globals.js" type="text/javascript"></script>
<script src="http://tool.cnzzsq.com/images/home.js" type="text/javascript"></script>
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
    <a href="http://tool.cnzzsq.com/" target="_blank">站长工具</a> | 
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
  <div class="menu"><a href="http://www.cnzzsq.com/">首页</a> <a href="http://tool.cnzzsq.com/" class="select">站长工具</a> 
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
    <li><a href="http://tool.cnzzsq.com/webs/webs.php" target="_blank">站内链接分析</a></li>
    <li><a href="http://tool.cnzzsq.com/density.php">关键词密度检测</a></li>
    <li><a href="http://tool.cnzzsq.com/meta.php">META信息检测</a></li>
    <li><a href="http://tool.cnzzsq.com/pr/outpr.php">PR输出值查询</a></li>
    <li><a href="http://tool.cnzzsq.com/yuan.php">查看网页源代码</a></li>
    </ul>
  </div>
  <div id="menu4" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="http://tool.cnzzsq.com/friends/friends.php">友情链接检测</a></li>
    <li><a href="http://tool.cnzzsq.com/keys/keys.php">关键词排名查询</a></li>
    <li><a href="http://tool.cnzzsq.com/baidu/baidu.php">百度近日收录</a></li>
    <li><a href="http://tool.cnzzsq.com/google/google.php">Google收录</a></li>
    <li><a href="http://tool.cnzzsq.com/ssyqsl/ssyqsl.php">网站收录查询</a></li>
    <li><a href="http://tool.cnzzsq.com/ssyqfl/ssyqfl.php">反向链接查询</a></li>
    <li><a href="http://tool.cnzzsq.com/pr/pr.php">PR查询</a></li>
    <li><a href="http://tool.cnzzsq.com/esearch.php">机器人模拟</a></li>
    </ul>
  </div>
  <div id="menu5" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="http://tool.cnzzsq.com/dels/dels.php">域名删除时间</a></li>
    <li><a href="http://tool.cnzzsq.com/ip/">IP查询</a></li>
    <li><a href="http://tool.cnzzsq.com/whois/">WHOIS查询</a></li>
    <li><a href="http://tool.cnzzsq.com/friendlink/friendlink.php">友情链接IP查询</a></li>
    </ul>
   </div>
   <div id="menu6" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
     <ul>
      <li><a href="http://tool.cnzzsq.com/mds.php?mds=md5">MD5加密</a></li>
      <li><a href="http://tool.cnzzsq.com/js.php">JS加密/解密</a></li>
      <li><a href="http://tool.cnzzsq.com/htmljs.php">HTML/JS互转</a></li>
      <li><a href="http://tool.cnzzsq.com/unicode.php">Unicode转换</a></li>
      <li><a href="http://tool.cnzzsq.com/utf.php">Utf-8编码转换</a></li>
      <li><a href="http://tool.cnzzsq.com/htmlubb.php">HTML/UBB互转</a></li>
      <li><a href="http://tool.cnzzsq.com/unix.php">Unix时间戳转换</a></li>
     </ul>
   </div>
    <div id="menu7" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
     <ul>
      <li><a href="http://tool.cnzzsq.com/ids.php">身份证号码查询</a></li>
      <li><a href="http://tool.cnzzsq.com/shouji/index.php">手机号码归属地</a></li>
      <li><a href="http://tool.cnzzsq.com/yb/yb.php">邮编区号查询</a></li>
      <li><a href="http://tool.cnzzsq.com/countryym.php">国家域名查找</a></li>
     </ul>
   </div>   
<div class="main">
  <div class="box">
    <div id="c">
      <h1><a href="http://whois.chinaccnet.com">域名Whois查询工具</a></h1>
      <div class="box1" style="text-align:center;"> 
      <form action="" method="POST">
          <span class="info3" > 请输入要查询的域名：
            <font color="green"><b>HTTP://</b></font><input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $domain?>" onkeydown="if(event.keyCode==13)startRequest();"/>
            <input name="btnS" class="but" type="submit" value="查询"  id="sub"/>
          </span></form>
           <div id="more" class="div_whois">
               相关查询:
<a href="/tool/dels/dels.php?domain=chinaccnet.com">域名删除时间</a>
<a href="/tool/ip/?domain=chinaccnet.com">IP查询</a>
<a href="/tool/whois/?domain=chinaccnet.com">WHOIS查询</a>
            </div>
          <div style="width:100%">
              <div id="detail" class="info1">
<div id="result" class="div_whois">
<?php echo $resul2;?>
</div>
              </div>
              <div style="float:right; width:40%; text-align:right; padding-top:9px;">
              </div>
          </div>
      </div>
    </div>
  </div>
<div id="b_14">
<h1>最近查询：</h1>
<div class="box1">
<span class="info2"> 
<table>
<tr><td align="left" style= "word-wrap:break-word;word-break:break-all">
<?php
@require_once('../cache/whoischace.php');
if($urls){
foreach ($urls as $key=>$v){
	echo "<a href=http://tool.cnzzsq.com/whois/index.php?domain=".$urls[$key].">".$urls[$key]."</a>&nbsp;&nbsp;";
}}?></td></tr>
</table>
</span>
</div>
    <div class="box">
      <div id="b_14">
        <h1>工具简介</h1>
        <div class="box1">
            <span class="info2">
               <p>Whois 简单来说，就是一个用来查询域名是否已经被注册，以及注册域名的详细信息的数据库（如域名所有人、域名注册商、域名注册日期和过期日期等）。通过域名Whois查询，可以查询域名归属者联系方式，以及注册和到期时间,可以用 <b style="color:Red;">whois.chinaccnet.com</b> 访问！</p>
            
            <p><b>关于域名到期删除规则实施的解释：</b></p>
            <p>国际域名：</p>
            <p>(1) 到期当天暂停解析，如果在72小时未续费，则修改域名DNS指向广告页面（停放）。38天内，可以自动续费。续费后，系统自动
恢复原来的DNS，刷新时间大概是24－48小时。</p>
            <p>&nbsp;(2) 39-70天，域名处于赎回期（Redemption），此期间域名无法管理，需手工赎回！
            </p>
            <p>(3) 75天，域名被彻底删除，可以重新注册。</p>
            <p>国内域名：</p>
            <p>(1) 到期当天暂停解析，如果在72小时未续费，则修改域名DNS指向
      广告页面（停放）。35天内，可以自动续费。
            </p>
            <p>(2) 过期后36－48天，将进入13天的高价赎回期，此期间域名无法管
     理。赎回价格（中文1500元/个，英文500元/个）
            </p>
            <p>(3) 过期后48天后仍未续费的，域名将随时被删除。 
            </p>
            </span>
        </div>
      </div>
</div>
<?php @require_once('../foot.php');?>