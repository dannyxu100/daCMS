<?php
header("content-Type: text/html; charset=GB2312");
define('IN_SEO', TRUE);
$hu = 'friendlink';
require '../global.php';
$ulink  = $urlsname = $name = $outs = $ali = $pic = $ati = array();
$domain = $_POST['domain']?$_POST['domain']:trim($_GET['domain']);
if($domain){
 is_domain($domain) or exit("<script language='javascript'>alert(\"请输入正确的域名,例如：chinaccnet.com\");setTimeout(\"window.location='friends.php?domain=chinaccnet.com'\",0);</script>");
}
$code   = @file_get_contents( 'http://'.$domain);
$pat1   = "/<a(.*?)<\/a>/i";
preg_match_all($pat1, $code, $array);
$urlsname = $array[0];
$pq = '/ href=["\']?([^>"\' ]+)["\']?\s*[^>]*>(.*)<\/a>/si';
for($i=0;$i<sizeof($urlsname);$i++){
	preg_match($pq,$urlsname[$i],$b);
	if($b[2] && strpos($b[1],'javascript') === false){
		  if(strpos($b[2],'img') !== false){
			$b[2] = '图片链接';
		  }
		  if(strpos($b[1],'http') === false){
			$b[1] =  'http://'.$domain.'/'.$b[1];
		  }
		  if(strpos($b[1],"http://www.".$domain) === false && strpos($b[1],"http://".$domain) === false){
			array_push($outs,$b[1]);
		    array_push($name,$b[2]);
		  }
	}
}
$per = "/http:\/\/(.*)/";
for($j=0;$j<sizeof($outs);$j++){
    preg_match_all($per,$outs[$j],$arr);
    if($arr[1][0]){
      $arr10 = explode('/',$arr[1][0]);
      array_push($ali,$arr10[0]);
    }
}
$ali = array_unique($ali);
foreach($ali as $key=>$val){
	$ulink[] = $val;
}
for($j=0;$j<sizeof($outs);$j++){
	if($ali[$j]){
		if($name[$j] == '图片链接'){
		array_push($pic,$name[$j]);
		}
		array_push($ati,$name[$j]);
	}
}
include_once('qqwry.php');
@include_once('../ip/ip.php');
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
<script language="javascript" src="../js/ajax.js"></script>
<script language="javascript">
var i = 0;
window.onload=function aa(){
    if($("domain").value !=""){
    $("seo_result").style.display ="";	
	var size = $('sizes').value;	
	i++;
	if(i<=size){		
		var lurl = $('lurl'+i).innerHTML;
		var domain = $('domain').value;		
		talktoServer('shows.php?action=ips&lurl='+lurl+'&domain='+domain,'ips'+i,"html");
		talktoServer('shows.php?action=wulidizhi&lurl='+lurl+'&domain='+domain,'wulidizhi'+i,"html");
		setTimeout("aa()",1000);
	}else{
		  var fl;
		  var kk = 0;
		  var mm = 0;		
		  for(var k=1;k<=size;k++){
			  fl = $('fanlianjie'+k).innerHTML;
			  if(fl.substr(0,3)=='有反链'){
			  	var re = new RegExp('^(.*>图片链接<.*)$');
			  	if(fl.match(re)){
				   mm++;
				   }
			  	kk++;
			  }
		  }
		  var tt = kk - mm;
		  var no = size - kk;
	      var a1 = $('flcount').innerHTML = kk;
		  var a2 = $('piccount').innerHTML = mm;
		  var a3 = $('textcount').innerHTML = tt;
		  var a4 = $('noo').innerHTML = no;		 
	}
 }else{
   $("seo_result").style.display ="none";
 }
}
</script>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>友情链接IP查询工具</h1>
      <div class="box1" style="text-align:center;"> 
      <form method="POST" action="">
          <span class="info3" > 请输入要查询的域名：
           <font color=green><b>HTTP:// </b></font><input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $domain;?>"/>
            <input name="btnS" class="but" type="submit" value="查询"  id="sub"/>
          </span>
          </form>
          <div id="seo_result" style="display:none">
          <table border="1" width="100%" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0" bordercolorlight="#BBD7E6">
<tr bgcolor="#ECF5FB"><td align="left">您输入的网址为:<?php echo "http://".$domain?>&nbsp;&nbsp;&nbsp;<?php echo $wip;?></td></tr>
</table>
<br/>
<table border="1" width="100%" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0" bordercolorlight="#BBD7E6">
<tr bgcolor="#ECF5FB"><td>序号</td><td>站点</td><td>链接地址</td><td>IP地址</td><td>服务器物理地址</td></tr><input type="hidden" name="sizes" id="sizes" value="<?php echo sizeof($ulink);?>">
<?php
for($j=0;$j<sizeof($ulink);$j++){
?>
<tr>
<td><span id="j<?php echo $j+1;?>"><?php echo $j+1;?></span></td>
<td><span id="ati<?php echo $j+1;?>"><?php echo $ati[$j];?></span></td>
<td><span id="lin<?php echo $j+1;?>"><a href="<?php echo 'http://'.$ulink[$j];?>" target="_blank"><span id="lurl<?php echo $j+1;?>"><?php echo $ulink[$j];?></span></a></span></td>
<td><span id="ips<?php echo $j+1;?>"><img src="../images/loading2.gif"></span></td>
<td><span id="wulidizhi<?php echo $j+1;?>"><img src="../images/loading2.gif"></span></td>
<?php
}
?>
</table>
          </div>
          <div style="width:100%">
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
               <p>通过本工具可以批量查询网站友情链接站点的IP地址、服务器物理地址，帮助站长清楚了解友情链接的服务器物理定位。</p>
            </span>
        </div>
      </div>
</div>
<?php @require_once('../foot.php');?>