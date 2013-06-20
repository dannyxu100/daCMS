<?php
header("Content-Type:text/html;charset=GB2312");
error_reporting(7);
set_time_limit(300);
$hu = 'dels';
$domain = trim($_POST['domain']?$_POST['domain']:$_GET['domain']);
$domain = strtolower($domain);
if(substr($domain,0,7) == "http://") {
	$domain = str_replace("http://","",$domain);
}
if(substr($domain,0,4) == "www.") {
	$domain = str_replace("www.","",$domain);
}
if($_POST['btnS']){
	preg_match("/<div class=\"lyTableInfoWrap\">(.+?)<\/div>/is", @file_get_contents('http://www.xinnet.cn/Modules/agent/serv/pages/domain_whois.jsp?domainNameWhois='.$domain.'&noCode=noCode'), $whois); 
	$result1 = $whois[0];
	$pat  = "/Status:\s+?(.*)<br\/>/Usi";
	$pat1 = "/Creation Date:\s+?(.*)<br\/>/Usi";
	$pat11 = "/Registration Date:\s+?(.*)<br\/>/Usi";
	$pat2 = "/Expiration Date:\s+?(.*)<br\/>/Usi";
	preg_match_all($pat, $result1, $array);
	preg_match_all($pat1, $result1, $array1);
	preg_match_all($pat11, $result1, $array11);	
	preg_match_all($pat2, $result1, $array2);
	$result  = $array[0][0];
	$result1 = $array1[0][0]?$array1[0][0]:$array11[0][0];
	$result2 = $array2[0][0];
	$results = $result.$result1.$result2;
	$result  = str_replace("Status","域名状态",$result);
	$results = str_replace("-jan","-1",$results);
	$results = str_replace("-feb","-2",$results);
	$results = str_replace("-mar","-3",$results);
	$results = str_replace("-apr","-4",$results);
	$results = str_replace("-may","-5",$results);
	$results = str_replace("-jun","-6",$results);
	$results = str_replace("-jul","-7",$results);
	$results = str_replace("-aug","-8",$results);
	$results = str_replace("-sep","-9",$results);
	$results = str_replace("-oct","-10",$results);
	$results = str_replace("-nov","-11",$results);
	$results = str_replace("-dec","-12",$results);	
	$b  = "/\d{1,2}-\d{1,2}-\d{4}/";
	$b1 = "/\d{4}-\d{1,2}-\d{1,2}/";
	preg_match_all($b,$results,$arrays);
	preg_match_all($b1,$results,$arrays1);
	$arrays00 = $arrays[0][0]?$arrays[0][0]:$arrays1[0][0];
	$creates = strtotime($arrays00);
	$create  = date('Y-m-d',$creates);
	$arrays01 =$arrays[0][1]?$arrays[0][1]:$arrays1[0][1];
	$overs   = strtotime($arrays01);
	$over    = date('Y-m-d',$overs);
	$nows    = time();
	$exits   = $nows - $creates;
	$starts  = strtotime('1970-7-1');
	$dels    = date('Y-m-d',$overs+(65*3600*100-$starts));
	$dels2   = strtotime($dels) -$nows;
	$day     = floor($dels2/3600/24);
	$dels2   = $dels2-$day*3600*24;
	$hour    = floor($dels2/3600);
	$dels2   = $dels2-$hour*3600;
	$minute  = floor($dels2/60);
	$second1 = $dels2-$minute*60;
	$dels22  = $day."天".$hour."小时".$minute."分".$second1."秒";
	$eyear   = floor($exits/3600/24/365);
	$exits   = $exits-$eyear*365*24*3600;
	$emonth  = floor($exits/3600/24/30);
	$exits   = $exits-$emonth*30*24*3600;
	$eday    = floor($exits/3600/24);
	$edels22 = $eyear."年".$emonth."月".$eday."天";
	if($create == '1970-01-01'){
		$result = '<font color=red><b>链接服务器失败！请检查域名是否正确！</b></font>';
	}else{	
	$result  = $result."域名年龄：".$edels22."<br/>域名创建时间 :".$create.'<br/>域名到期时间 :'.$over."<br/>域名删除时间：".$dels."<br/>域名删除倒计时:".$dels22;
	}
}
@require_once('../header.php');
if($domain){
	@require_once('../cache.php');
	if(file_exists("../cache/cache.php")){
		@require_once("../cache/cache.php");
		$urls = filehave($urls,$domain);
	}else{
	$urls = fileno($domain);
	}
	writeover("../cache/cache.php","<?php\r\n\$urls=".vvar_export($urls).";\r\n?>");
}
?>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>域名删除查询</h1>
      <div class="box1" style="text-align:center;">
      <form action="" method="POST">
          <span class="info3" > 请输入要查询的域名：
            <font color="green"><b>HTTP://</b></font><input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $domain;?>"/>
            <input name="btnS" class="but" type="submit" value="查询"  id="sub">
          </span>
          </form>
           <div id="more" class="div_whois">
               相关查询:
<a href="/tool/dels/dels.php?domain=chinaccnet.com">域名删除时间</a>
<a href="/tool/ip/?domain=chinaccnet.com">IP查询</a>
<a href="/tool/whois/?domain=chinaccnet.com">WHOIS查询</a>
            </div>
          <div style="width:100%">
              <div id="detail" class="info1">
<div id="result" class="div_whois">
<?php echo $result;?>
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
@require_once('../cache/cache.php');
if($urls){
foreach ($urls as $key=>$v){
	echo "<a href=http://".$urls[$key]." target=_blank>".$urls[$key]."</a>&nbsp;&nbsp;";
}}?></td></tr>
</table>
</span>
</div>
    <div class="box">
      <div id="b_14">
        <h1>工具简介</h1>
        <div class="box1">
            <span class="info2">
.com .net .org等国际域名删除时间，通常在域名到期后的第65或75天，凌晨2点30左右会删除<br />
国内域名的删除时间，通常在域名到期后的第15或16天，凌晨4：30会删除<br />
友情提示：域名删除时间仅供参考，谢谢！<br />
            </span>
        </div>
      </div>
</div>
<?php @require_once('../foot.php');?>