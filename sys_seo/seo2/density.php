<?php
$hu      = 'density';
$domain  = $_POST['domain']?$_POST['domain']:$_GET['url'];
$keys    = $_POST['keys']?$_POST['keys']:trim($_GET['keys']);
if($domain){
	$bods    = "/<body>(.*)<\/body>/is";
	$content = @file_get_contents("http://".$domain);
	preg_match_all($bods, $content, $array);
	$pat = "/>(.*)</Us";
	preg_match_all($pat, $array[0][0], $arr);
	$a = '';
	for($i=0;$i< sizeof($arr[1]);$i++){
		if($arr[1][$i]){
		$a .= $arr[1][$i];
		}
	}
	$a     = preg_replace(array("/\s/","<br/>"),array("",),$a);
	$keys  = preg_replace(array("/\s/","<br/>"),array("",),$keys);
	$keys1 = "/".$keys."/";
	preg_match_all($keys1,$a,$densti);
	$a1 = mb_strlen($a,'gbk');
	$a2 = mb_strlen($keys,'gbk');
	$a3 = sizeof($densti[0]);
	$a4 = $a2*$a3;
	$a5 = @(round($a4/$a1*100,1)."%");
	$text = $content?"页面文本总长度：".$a1."字符<br/>关键字符长度：".$a2."字符<br/>关键字出现频率：".$a3."次<br/>关键字符总长度：".$a4."字符<br/>密度结果计算：".$a5."<br/>密度建议值：2%≦密度≦8%":"请先输入正确的域名和关键字再进行查询！";	
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
      <h1>关键词密度检测</h1>
      <div class="box1" style="text-align:center;"> 
      <form action="" method="POST">
          <span class="info3" > 请输入要查询的域名：
           <font color="green"><b>HTTP://</b></font> <input name="domain" type="text" id="domain" class="input" size="30" value="<?php echo $domain;?>"/>&nbsp;&nbsp;关键字：<input name="keys" id="keys" value="<?php echo $keys;?>" size="30" class="input">
            <input name="btnS" class="but" type="submit" value="查询"  id="sub"/>
          </span></form>
<div>
<?php echo $text;?>
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
@require_once('cache/cache.php');
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
               通过本工具可以快速检测页面关键词出现的数量和密度，更适合蜘蛛的搜索
            </span>
        </div>
      </div>
</div>
<?php @require_once('foot.php');?>