<?php
$hu = 'eseach';
eval('$__file__=__FILE__;');
define('ROOT_PATH',$__file__ ? dirname($__file__).'/' : './');
require_once("global.php");
$domain = $_POST['domain']?$_POST['domain']:$_GET['domain'];
if($domain){
    is_domain($domain) or exit( "<script language=javascript>alert('请输入正确的域名！');location.href='esearch.php';</script>");
	$url = 'http://'.trim($domain);
	$content = @file_get_contents($url);
	$charset = "/charset=(.*)/";
	preg_match($charset,$content,$charsetarr);
	$charset2 = strtolower(substr($charsetarr[1],0,2));
	if($charset2 != 'gb'){
		require_once('require/chinese.php');
		$chs = new Chinese('utf-8','GB2312');
		$content = $chs->Convert($content);
	}
	$pat1 = "/<title>(.*)<\/title>/si";
	preg_match_all($pat1, $content, $array);
	$pat2 = "/meta content=\"(.+)\" name=\"keywords\"/Ui";
	$pat9  = "/meta name=\"keywords\" content=\"(.+)\"/Ui";
	preg_match_all($pat2, $content, $array2);
	preg_match_all($pat9, $content, $array9);
	$pat3 = "/<meta content=\"(.+)\" name=\"description\"/Usi";
	$pat8 = "/<meta name=\"description\" content=\"(.+)\"/Usi";
	preg_match_all($pat3, $content, $array3);
	preg_match_all($pat8, $content, $array8);
	$bods = "/<body>(.*)<\/body>/is";
	preg_match_all($bods, $content, $array4);
	$pat4 = "/>(.*)</U";
	preg_match_all($pat4, $array4[0][0], $array5);
	$body = "";
	for($i=0;$i<sizeof($array5[1]);$i++){
		$body .= $array5[1][$i]." ";
	}
	$array2[1][0] = $array2[1][0]?$array2[1][0]:$array9[1][0];
	$array3[1][0] = $array3[1][0]?$array3[1][0]:$array8[1][0];
	$results = "<br/><b>Title: </b>".$array[1][0]."<br/><b>KeyWords: </b>".$array2[1][0]."<br/><b>Description: </b>".$array3[1][0]."<br/><b>Body: </b>".$body;
	@require_once('cache.php');
	if(file_exists("cache/cache.php")){
		@require_once("cache/cache.php");
		$urls = filehave($urls,$domain);
	}else{
	$urls = fileno($domain);
	}
	writeover("cache/cache.php","<?php\r\n\$urls=".vvar_export($urls).";\r\n?>");
}
@require_once('header.php');
?>
<div class="main">
          <div class="box">
            <div id="c">
              <h1>搜索蜘蛛、机器人模拟工具</h1>
              <div class="box1" style="text-align:left;"> 
			  <form action="" method="post">
                  <span class="info3" > 请输入要查询的域名：
                   <font color="green"><b>HTTP://</b></font> <input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $domain;?>"/>
                    <input name="btnS" class="but" type="submit" value="查询"  id="sub"/>
                  </span>
				  </form>
				  <divs style="text-align:left"><?php echo $results;?></div>
                  <div style="width:100%">
                      <div id="detail" class="info1">
<div id="result" class="div_whois">
<div class="t" style="display:none" id="seo_result">
</div>
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
@require_once('cache/cache.php');
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
               <p>通过本工具可以快速模拟搜索引擎蜘蛛访问页面所抓取到的内容信息！
            </p>
            </span>
        </div>
      </div>
</div>
<?php @require_once('foot.php');?>