<?php
$hu = "unicode";
@require_once('header.php');
?>
<div class="main">
<script src="images/globals.js?ver=20100621" type="text/javascript"></script>
<script src="js/Unicode.js" type="text/javascript"></script>
<div class="box">
<div id="b_1">
    <h1><div class="titleft">Unicode编码转换工具</div></h1>
    <div class="box1">
         <div class="info1">
             <div class="WStop">
                <div class="WStop1">
                 <div class="WStop2">Unicode 转换 ASCII，ASCII 转换 Unicode</div>
                </div>
                <div style="padding:5px;"> 
                 <div class="WSIn">
                    <div class="WSt">
                        <textarea id="content" name="content" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;">请把你需要转换的内容粘贴在这里。[由于兼容性问题，此转换功能只能在IE中使用，FIREFOX无效]</textarea>
                    </div>
	                <div class="WSt1">
	                    <input class="but2" type="button" style="width:150px;" value="ASCII 转换 Unicode↓" onclick="AsciiToUnicode();"/>
	                    <input class="but2" type="button" style="width:150px;" value="Unicode 转换 ASCII↓" onclick="UnicodeToAscii();"/>
	                    <input class="but2" type="button" value=" 复 制 " onclick="copy('result')" />
	                    <input class="but2" type="button" value="清空结果" onclick="result.value=''" />
		            </div>
                    <div class="WSt">
                        <textarea id="result" name="result" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;"></textarea>
                    </div>
                     <div class="WSt1">
	                    <input type="button" value="预览转换代码" onclick='preview()' class="but2" />
	                </div>
                 </div>
            </div>
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
 <p>Unicode编码转换</p> 
</span>
</div>
</div>
<?php @require_once('foot.php');?>