<?php
$hu = 'webs';
@require_once('../header.php');
?>
<script language='javascript' src="../js/ajax.js"></script>
<script type="text/javascript" src="ajax2.js"></script>
<script language="javascript">
window.onload=function doseo() {
    if($('domain').value != ""){
		$('seo_result').style.display = "";
		$('testlinkstatus').innerHTML="<input class=\"but\" type=\"button\" value=\"开始测试\" onclick=\"javascript:ceshi(0);\" />";
		$('seo_result').innerHTML = '&nbsp;<img src="../images/loading.gif" width="94" height="15" align="absmiddle" alt="正在加载,请稍候...&#10;如果长时间未响应，请尝试重新查询"/> Loading...';
		$('seo_result').style.display = '';
		makeRequest('domain='+$('domain').value+'&val='+$('selects').value);
    }
}
function ceshi(i){
    var sizes = $('counts').value;
    i++;
    if(i<=sizes){
		$('testlinkstatus').style.display="none";
		$('test'+i).style.display="";
		talktoServer('testlink.php?testlink='+$('link'+i).innerHTML,'test'+i,"html");
		setTimeout("ceshi("+i+")",800);
    }else{
    	var die=0;
    	for(var k=1;k<sizes;k++){
    		fl = $('test'+k).innerHTML;
    		var re = new RegExp('^(.*> × <.*)$');
			  	if(fl.match(re)){
				   die++;
				   }
    	}
    	var res = "测试完成！贵站共有链接："+sizes+"个，死链接："+die+"个。";
    	alert(res);
    	$('testlinkstatus').innerHTML=res;
    	$('testlinkstatus').style.display="";
    }
}
</script>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>死链接检测/全站PR查询</h1>
      <div class="box1" style="text-align:center;">
          <span class="info3" > 请输入要查询的域名：
           <font color="green"><b>HTTP://</b></font> <input name="domain" type="text" id="domain" class="input" size="25" url="true" value="<?php echo $_GET['domain'];?>"/>&nbsp;&nbsp;<select onchange="doseo()" id="selects"><option value="1">所有链接</option><option value="2">站内链接</option><option value="3">站外链接</option></select>
            <input name="btnS" class="but" type="submit" value="查询"  id="sub" onclick="doseo()"/>&nbsp;&nbsp;
          <span id="testlinkstatus"> <input class="but" type="button" value="开始测试" onclick="javascript:ceshi(0);" /></span>
		  <div id="seo_result" style="display:none">
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
               <p>通过本工具可以快速测试网站的死链接。死链接 - 也称无效链接，即那些不可达到的链接。一个网站存在死链接不是什么好事，首先一个网站如果存在大量的死链接，必将大大损伤网站的整体形象，再者搜索引擎蜘蛛是通过链接来爬行搜索，如果太多链接无法到达，不但收录页面数量会减少，而且你的网站在搜索引擎中的权重会大大降低。该查询可以遍历指定网页的所有链接，并分析每个链接的有效性，找出死链接。 </p> </span>
        </div>
      </div>
</div>
<?php @require_once('../foot.php');?>