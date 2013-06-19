<?php
$hu = 'pr';
@require_once('../header.php');
?>
<script language="javascript" src="../js/ajax.js"></script>
<script language="javascript">
window.onload=function doajax(){
	var domain = $('domain').value;
	var xz = 0;
	if($('ejym').checked == true){
		var xz = 1;
	}
	$('seo_result').innerHTML = '&nbsp;<img src="../images/loading.gif" width="94" height="15" align="absmiddle" alt="正在加载,请稍候...&#10;如果长时间未响应，请尝试重新查询"/> Loading...';
	talktoServer('donow.php?domain='+domain+'&xz='+xz,'seo_result',"html");
}
</script>
<div class="main">
<div class="box">
<div id="c">
  <h1>PR值查询</h1>
  <div class="box1" style="text-align:center;"> 
  <form action='' method='post'>
      <span class="info3" >请输入要查询的域名：
       <font color="green"><b>HTTP://</b></font>
<textarea rows="5" cols="50" style="border: 1px solid rgb(126, 157, 185); background-color: white;" id="domain"  name="domain" autocomplete="off">
<?php echo $_GET['domain'];?>
</textarea><input type="checkbox" id="ejym" value="1"/>查询二级域名(多个用“,”隔开)
        <input name="btnS" class="but" type="button" value="查询" id="sub" onclick="doajax();"/>
        </form>
      </span><div class="t"  id="seo_result">
</div>
      <div style="width:100%"><div>
<div>
     </div>
          <div style="float:right; width:40%; text-align:right; padding-top:9px;">          
          </div>
      </div>
  </div>
</div>
</div>
<div class="box">
  <div id="b_14">
    <h1>工具简介</h1>
    <div class="box1">
        <span class="info2">
          PR值全称为PageRank(网页级别)，取自Google的创始人LarryPage。它是Google排名运算法则（排名公式）的一部分，是Google用于用来标识网页的等级/重要性的一种方法，是Google用来衡量一个网站的好坏的唯一标准。在揉合了诸如Title标识和Keywords标识等所有其它因素之后，Google通过PageRank来调整结果，使那些更具“等级/重要性”的网页在搜索结果中令网站排名获得提升，从而提高搜索结果的相关性和质量。
        </span>
    </div>
  </div>
</div>
<?php @require_once('../foot.php');?>