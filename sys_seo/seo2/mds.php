<?php
$hu   = 'mds';
$mds  = $_POST['mds']?$_POST['mds']:$_GET['mds'];
$mds  = $mds?$mds:"md5";
$typ  = $_POST['Md5Type'];
$mds1 = strtoupper(md5($mds));
$mds2 = strtolower($mds1);
$mds3 = substr($mds1,8,16);
$mds4 = strtolower($mds3);
if($typ == '3'){
	$results  = "加密后的结果：<input type=text class=input size=40 value=".$mds4.">";
}elseif($typ == '1'){
	$results =  "加密后的结果：<input type=text class=input size=40 value=".$mds2.">";
}elseif($typ == '2'){
	$results = "加密后的结果：<input type=text class=input size=40 value=".$mds3.">";
}else{
	$results = "加密后的结果：<input type=text class=input size=40 value=".$mds1.">";
}
@require_once('header.php');
?>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>MD5加密工具</h1>
      <div class="box1" style="text-align:center;"> 
	  <form action="" method="post">
          <span class="info3" > 请输入欲加密的字符串：
            <input name="mds" type="text" id="mds" class="input" size="35" url="true" value="<?php echo $mds;?>"/>
            <input id="md32l" name="Md5Type" value="0" <?php if($typ==0) echo "checked";?> type="radio" /><label for="md32l">32位[大]</label>
      <input id="md32s" name="Md5Type" value="1" <?php if($typ==1) echo "checked";?> type="radio" /><label for="md32s">32位[小]</label>
      <input id="md16l" name="Md5Type" value="2" <?php if($typ==2) echo "checked";?> type="radio" /><label for="md16l">16位[大]</label>
      <input id="md16s" name="Md5Type" value="3" <?php if($typ==3) echo "checked";?> type="radio" /><label for="md16s">16位[小]</label> <input name="btnS" class="but" type="submit" value="加密"  id="sub"/>
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
    <div class="box">
      <div id="b_14">
        <h1>工具简介</h1>
        <div class="box1">
            <span class="info2">
               <p>MD5加密
            </p>
            </span>
        </div>
      </div>
</div>
<?php @require_once('foot.php');?>