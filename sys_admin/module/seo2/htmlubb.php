<?php
$hu = 'htmlubb';
@require_once('header.php');
?>
<div class="main"> 
<script src="js/Html_Ubb.js" type="text/javascript"></script>
<div class="box">
    <div id="b_1">
        <h1><div class="titleft">HTML/UBB代码转换工具</div></h1>
        <div class="box1" style="text-align:center">
            <div class="info1"> 
                 <div class="Gbtop">
                    <div class="WStop1">
                    <div class="WStop2">HTML源代码转换UBB代码工具</div>
                    </div>
                    <div style="padding:5px;"> 
                      <div class="WSIn">
                        <div class="WSTitle">请将 <strong>Html</strong> 源代码拷贝到下面表单中:</div>
                        <div class="WSt">
                            <textarea id="Hsource" onfocus="htmltoubb()" onkeyup="htmltoubb()"style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;"></textarea>
                        </div>
                        <span  class="WSTitle">下面表单中是相应的 <strong>UBB</strong> 代码: </span> <br />
                        <span  class="WSt">
                            <textarea id="Uresult" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;"></textarea>
                       </span>
                      </div>
                      </div>
                </div>
                <div class="Gbtop">
                   <div class="WStop1">
                     <div class="WStop2">UBB源代码转换HTML代码工具</div>
                   </div>
                   <div style="padding:5px;"> 
                      <div class="WSIn">
                         <span class="WSTitle">请将 <strong>UBB</strong> 源代码拷贝到下面表单中:</span><br />
                         <span class="WSt">
                            <textarea id="Usource" onfocus="ubbtohtml()" onkeyup="ubbtohtml()" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;"></textarea>
                         </span>
                        <span class="WSTitle">下面表单中是相应的 <strong>Html</strong> 代码: </span><br />
                        <span class="WSt">
                           <textarea id="Hresult" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;"></textarea>
                        </span>
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
<p>UBB源代码转换HTML代码</p>
</span>
</div>
</div>
<?php @require_once('foot.php');?>