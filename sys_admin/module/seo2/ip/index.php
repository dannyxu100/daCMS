<?php
header("Content-Type:text/html;charset=GB2312");
$hu = 'ip';
@require_once('../header.php');
include_once('../friendlink/qqwry.php');
@require_once('ip.php');
?>
<script language="javascript" type="text/javascript">
window.onload=function dis(){
	if(document.getElementById("url").value != ""){
		document.getElementById("status").style.display = "";
	}
}
</script>
<div class="main">
  <div class="box">
    <div id="c">
      <h1>IP查询</h1>
<div class="box1" style="text-align:center;">
<form method="post" action="" name="ipfrom" onsubmit="return checkIP();">
<span class="info3" id="ipp"><?php echo $ips?>
</span>请输入IP或域名：
    <input name="ip" type="text" id="url" isget="false" url="true" class="input" size="40" value="<?php echo $inip?>" />
    <input name="button" isget="false" type="submit"  id="sub" class="but" value="查 询" />
<INPUT TYPE="hidden" name="action" value="2">
           <div id="more" class="div_whois">
               相关查询:
<a href="/tool/dels/dels.php?domain=chinaccnet.com">域名删除时间</a>
<a href="/tool/ip/?domain=chinaccnet.com">IP查询</a>
<a href="/tool/whois/?domain=chinaccnet.com">WHOIS查询</a>
            </div>
    <span id="status" style="display:none" class="info1" style="text-align:center;">
        
        <strong class="red"><?php echo $jieguo?>查询结果: <?php echo $inip?> ==>> <?php echo $ipp1?>  ==>> <a href="javascript:showAddress('<?php echo $ipp2?>');"><?php echo $ipp2?></a> </strong><br />        
         上面三项依次显示的是 : 原始输入内容 ==>> 获取的IP地址 ==>>IP的物理位置<br />
   </span>
</FORM>
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
               通过该工具可以查询指定IP的物理地址或域名服务器的IP和物理地址，及所在国家或城市，甚至精确到某个网吧，机房或学校等；<br />
			   查出的结果仅供参考！
            </span>
        </div>
      </div>
</div>
<?php @require_once('../foot.php');?>