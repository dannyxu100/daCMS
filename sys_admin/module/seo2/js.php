<?php
$hu = 'js';
@require_once('header.php');
?>
<div class="main">
          <div class="box">
            <div id="c">
              <h1>JS加密/解密</h1>
              <div class="box1" style="text-align:center;"> 
<script src="images/globals.js?ver=20100621" type="text/javascript"></script>
<script type="text/javascript">
 function jsencode(obj) {
    var v = getid('ipt').value;
    var es = escape(v);
    return String.format("document.write(unescape('{0}'));",es);
 } 
function jsdecode(obj) {
    var v = getid('ipt').value;
    var regex = /unescape\('([a-z%0-9]*)'\)/i;
    if(v.match(regex))
    {
        getid('ipt').value = unescape(RegExp.$1);
    }
 } 
 function test() {
    var win = window.open();
    win.document.open();
    win.document.write(getid('ipt').value);
    win.document.close();
 }
</script>
<div class="box">
  <div id="b_1">
    <div class="box1" style="text-align:center;">
    <span class="info3" >
      <textarea id="ipt" style=" border:1px solid #c5e2f2; width:800px; height:350px; overflow:visible;">请把你需要加密的内容粘贴在这里！</textarea>
    </span>
    <div id="detail">
       <input type="button" class=but onclick="if(this.value=='JS加密'){getid('ipt').value='<script>'+jsencode(this)+'</script>';this.value='JS解密';}else{jsdecode(this);this.value='JS加密';}" value="JS加密"/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="button" class=but onclick="test();" value="测试" />
    </div>
   </div>
  </div>
</div>
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
               <p>JS加密/解密
            </p>
            </span>
        </div>
      </div>
</div>
<?php @require_once('foot.php');?>