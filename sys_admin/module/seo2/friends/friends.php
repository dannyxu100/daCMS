<?php
$hu = 'friends';
eval('$__file__=__FILE__;');
define('ROOT_PATH',$__file__ ? dirname($__file__).'/' : './');
require '../global.php';
$ulink  = $urlsname = $name = $outs = $ali = $pic = $ati = array();
$domain = $_POST['domain']?$_POST['domain']:trim($_GET['domain']);
if($domain){
	is_domain($domain) or exit("<script language='javascript'>alert(\"请输入正确的域名,例如：chinaccnet.com\");setTimeout(\"window.location='friends.php?domain=chinaccnet.com'\",0);</script>");
	$cnt=0;
    while($cnt < 10 && ($code=@file_get_contents('http://'.$domain))===FALSE){$cnt++;}
	$charset = "/charset=(.*)/";
	preg_match($charset,$code,$charsetarr);
	$charset2 = strtolower(substr($charsetarr[1],0,2));
	if($charset2 != 'gb'){
		require_once('require/chinese.php');
		$chs  = new Chinese('utf-8','GB2312');
		$code = $chs->Convert($code);
	}
	$pat1 = "/<a(.*?)<\/a>/i";
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
	//百度收录
	$site_url = 'http://www.baidu.com/s?wd=site%3A';
	$baids    = "/<font color=\"#008000\">(.*)<\/font> - <a href=\"(.*)\"  target=\"_blank\"  class=\"m\">百度快照<\/a>/Usi";
	$site_pattern = "/找到相关网页(.*)篇/";
	$baidu = "http://www.baidu.com/s?wd=";
	$times = "/\d{4}-\d{1,2}-\d{1,2}/";
	$s0 = $site_url.$domain;
	$s1 = $s0.'&lm=1';
	$cnt2=0;
    while($cnt2 < 10 && ($c0=@file_get_contents($s0))===FALSE){$cnt2++;}	
	$cnt3=0;
    while($cnt3 < 10 && ($c1=@file_get_contents($s1))===FALSE){$cnt3++;}	
	preg_match($site_pattern,$c0,$a0);
	preg_match($site_pattern,$c1,$a1);
	@require_once('../pr/prfunction.php');
	$prs = '&nbsp;&nbsp;<img src="../images/pagerank'.GetPR($domain).'.gif" align="absmiddle" /> ';
	preg_match($baids,$c0,$kuaizhao);
	preg_match($times,$kuaizhao[0],$btime);
	//图片链接个数
	for($j=0;$j<sizeof($outs);$j++){
		if($ali[$j]){
			if($name[$j] == '图片链接'){
			array_push($pic,$name[$j]);
			}
			array_push($ati,$name[$j]);
		}
	}
	$text = sizeof($ali)-sizeof($pic);
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
<script language="javascript" src="../js/ajax.js"></script>
<script language="javascript">
var i = 0;
window.onload=function aa(){
	if($('domain').value != ""){
	    $('seo_result').style.display ="";
		var size = $('sizes').value;
		i++;
		if(i<=size){
			var lurl = $('lurl'+i).innerHTML;
			var domain = $('domain').value;
			talktoServer('shows.php?action=baidushoulu&lurl='+lurl+'&domain='+domain,'baidushoulu'+i,"html");
			talktoServer('shows.php?action=prs&lurl='+lurl+'&domain='+domain,'prs'+i,"html");
			talktoServer('shows.php?action=baidukuaizhao&lurl='+lurl+'&domain='+domain,'baidukuaizhao'+i,"html");
			talktoServer('shows.php?action=fanlianjie&lurl='+lurl+'&domain='+domain,'fanlianjie'+i,"html");
			setTimeout("aa()",3000);
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
		  $('bian').innerHTML = "<a href=\"javascript:clicks(1)\">[点击查看]</a>";
		}
	}
}
function clicks(id){
	  var size2 = $('sizes').value;
	  for(var k=1;k<=size2;k++){
	  fl = $('fanlianjie'+k).innerHTML;
	  if(fl.substr(0,3)=='有反链'){
	  	if(id==1){
	  		$('bian').innerHTML = "<a href=\"javascript:clicks(2)\">[查看全部]</a>";
		  	$('j'+k).style.display="none";
		  	$('ati'+k).style.display="none";
		  	$('lin'+k).style.display="none";
		  	$('baidushoulu'+k).style.display="none";
		  	$('prs'+k).style.display="none";
		  	$('baidukuaizhao'+k).style.display="none";
		  	$('fanlianjie'+k).style.display="none";
	  	}else{
	  		$('bian').innerHTML = "<a href=\"javascript:clicks(1)\">[点击查看]</a>";
	  		$('j'+k).style.display="";
		  	$('ati'+k).style.display="";
		  	$('lin'+k).style.display="";
		  	$('baidushoulu'+k).style.display="";
		  	$('prs'+k).style.display="";
		  	$('baidukuaizhao'+k).style.display="";
		  	$('fanlianjie'+k).style.display="";
	  	}
	  }
	}
}
</script>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>友情链接查询工具</h1>
      <div class="box1" style="text-align:center;">
      <form method="POST" action="">
          <span class="info3" > 请输入要查询的域名：
           <font color="green"><b>HTTP://</b></font><input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $domain;?>"/>
            <input name="btnS" class="but" type="submit" value="查询"  id="sub"/>
          </span>
          </form>
          <div id="seo_result" style="display:none">
          <table border="1" width="100%" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0" bordercolorlight="#BBD7E6">
<tr><td rowspan="3"><a target="_blank" href="<?php echo "http://".$domain?>"><?php echo $domain?></a></td><td>百度收录：<a target="_blank" href="<?php echo $s0;?>"><?php echo $a0[1];?></a></td><td>百度今日收录：<a target="_blank" href="<?php echo $s1;?>"><?php echo $a1[1];?></a></td><td>百度首页位置：<a target="_blank" href="<?php echo $s0;?>">--</a></td><td><?php echo $prs;?></td></tr>
<tr><td>出站链接：<?php echo sizeof($ali);?>个</td><td>图片链接：<?php echo sizeof($pic);?>个</td><td>文字链接：<?php echo $text;?>个</td><td>百度快照：<a target="_blank" href="<?php echo $haves;?>"><?php echo $btime[0];?></a></td></tr>
<tr><td>反向链接：<span id="flcount"><img src="../images/loading2.gif"></span>个</td><td>图片链接：<span id="piccount"><img src="../images/loading2.gif"></span>个</td><td>文字链接：<span id="textcount"><img src="../images/loading2.gif"></span>个</td><td>出站链接中有<span id="noo"><img src="../images/loading2.gif"></span>个没有本站链接<span id="bian"></span></td></tr>
</table>
<br/>
<table border="1" width="100%" bordercolordark="#FFFFFF" cellspacing="0" cellpadding="0" bordercolorlight="#BBD7E6">
<tr><td>序号</td><td>站点</td><td>链接地址</td><td>百度收录</td><td>PR</td><td>百度快照</td><td>对方链接是否有本站的链接</td></tr><input type="hidden" name="sizes" id="sizes" value="<?php echo sizeof($ulink);?>">
<?php
for($j=0;$j<sizeof($ulink);$j++){
?>
<tr>
<td><span id="j<?php echo $j+1;?>"><?php echo $j+1;?></span></td>
<td><span id="ati<?php echo $j+1;?>"><?php echo $ati[$j];?></span></td>
<td><span id="lin<?php echo $j+1;?>"><a href="<?php echo 'http://'.$ulink[$j];?>" target="_blank"><span id="lurl<?php echo $j+1;?>"><?php echo $ulink[$j];?></span></a></span></td>
<td><span id="baidushoulu<?php echo $j+1;?>"><img src="../images/loading2.gif"></span></td>
<td><span id="prs<?php echo $j+1;?>"><img src="../images/loading2.gif"></span></td>
<td><span id="baidukuaizhao<?php echo $j+1;?>"><img src="../images/loading2.gif"></span></td>
<td><span id="fanlianjie<?php echo $j+1;?>"><img src="../images/loading2.gif"></span></td></tr>
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
           <p>通过本工具可以批量查询指定网站的友情链接在百度的收录、百度快照、PR以及对方是否链接本站，可以识破骗链接。</p>
           <p>1.反向链接：指对方网站上有指向当前查询页面的链接。</p>
           <p>2.交叉链接说明：譬如你有网站A投放别人的链接，而别人网站上放的友情链接是你的B站或者C站。那么你在查询网站中输入网址A，同时在交叉链接中输入网址B和C，工具会自动检测对方有没有投放你的站点B或者C。</p>
        </span>
    </div>
  </div>
</div>
<?php @require_once('../foot.php');?>