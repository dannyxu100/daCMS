<?php
$hu = 'utf';
@require_once('header.php');
?>
<div class="main"> 
<script type="text/javascript"> 
function ConvUtf(obj,btn){
   document.getElementById("result").value=obj.value.replace(/[^\u0000-\u00FF]/g,function($0){return escape($0).replace(/(%u)(\w{4})/gi,"&#x$2;")});
}
function ResChinese(obj,btn)
{
   document.getElementById("content").value=unescape(obj.value.replace(/&#x/g,'%u').replace(/;/g,''));
}
function preview() {
	var win = window.open();
	win.document.open('text/html', 'replace');
	win.document.writeln(content.value);
	win.document.close();
}
</script>
   <div class="box">
      <div id="b_1">
        <h1><div class="titleft">UTF-8编码转换工具</div></h1>
           <div class="box1">
             <div class="info1">              
               <div align="center" style="padding-top:10px;">
                <textarea id="content" name="content" style="width:850px;height:150px;border:1px solid #c5e2f2;overflow:visible;" cols="20" rows="15">请将您要转换的汉文内容粘贴在这里。[由于兼容性问题，此转换功能只能在IE中使用，FIREFOX无效]</textarea>
                </div>
                <div style="margin-left:2px;padding:2px 0px 0px 0px;">
                <input class="but2" id="conv" type="button" style="width:150px;" value="中文 转换 UTF-8 ↓" onclick="ConvUtf(content,this);"/>
                <input class="but2" id="res" type="button" style="width:150px;" value="UTF-8 还原 中文 ↑" onclick="ResChinese(result,this);" />
               </div>
               <div align="center">
                <textarea id="result" name="result" style="width:850px;height:150px;border:1px solid #c5e2f2;overflow:visible;" rows="15"></textarea>
              </div>
               <div style="margin-left:2px;padding:2px 0px 0px 0px;">
               <input class="but2" id="pre" type="button" value="预览转换代码" onclick="preview();" />
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
<p>UTF-8编码转换</p>
</span>
</div>
</div>
<?php @require_once('foot.php');?>