<?php
$hu = 'baidu';
@require_once('../header.php');
?>
<script type="text/javascript" src="ajax2.js"></script>
<script type="text/javascript">
 window.onload=function doseo() {
    if($('domain').value !=""){
	 	var a= $('selects').value;	 	
		$('seo_result').innerHTML = '&nbsp;<img src="../images/loading.gif" width="94" height="15" align="absmiddle" alt="正在加载,请稍候...&#10;如果长时间未响应，请尝试重新查询"/> Loading...';
		$('seo_result').style.display = '';		
		makeRequest('domain='+$('domain').value+'&selects='+a+'&pn='+$('pn').value);		
    }
}
</script>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>百度收录查询</h1>
      <div class="box1" style="text-align:center;"> 
          <span class="info3" > 请输入要查询的域名         
            <font color="green"><b>HTTP://</b></font><input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $_GET['domain'];?>"/>
            &nbsp;&nbsp;<select name="selects" id="selects" onchange="doseo();">
            <option value="1" <?php if($_GET['lm']==1){echo "selected";}?>>最近24小时收录情况</option>
            <option value="7" <?php if($_GET['lm']==7){echo "selected";}?>>最近一星期收录情况</option>
            <option value="30" <?php if($_GET['lm']==30){echo "selected";}?>>最近一个月收录情况</option>
            <option value="360" <?php if($_GET['lm']==360){echo "selected";}?>>最近一年收录情况</option>
            <option value="0" <?php if($_GET['lm']==0){echo "selected";}?>>总共收录情况</option>
            </select><input type="hidden" name="pn" id="pn" value="<?php echo ($_GET['page']-1)*10;?>">
            <input name="btnS" class="but" type="button" value="查询"  id="sub" onclick="doseo();"/>
          </span>
           <div id="more" class="div_whois">
               相关查询:
                 <a href="http://alexa.chinaccnet.com">Alexa查询</a> 
<a href="http://whois.chinaccnet.com">whois查询</a> 
<a href="http://ip.chinaccnet.com">域名/IP查询</a>
            </div>
          <div style="width:100%">
              <div id="detail" class="info1">
<div id="result" class="div_whois">
<div class="t" style="display:none" id="seo_result">
</div><div id="pageft"></div>
</div>
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
}
}?></td></tr>
</table>
</span>
</div>
    <div class="box">
      <div id="b_14">
        <h1>工具简介</h1>
        <div class="box1">
            <span class="info2">
               <p>本工具为站长提供指定时间内百度搜索对指定网站的收录情况，包括收录的网页数量和网页的具体情况，让您更好地掌握百度搜索对您的网站收录情况。
</p>  </span>
        </div>
      </div>
</div>
<?php @require_once('../foot.php');?>