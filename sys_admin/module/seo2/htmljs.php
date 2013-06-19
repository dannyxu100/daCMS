<?php
$hu = 'htmljs';
@require_once('header.php');
?>
<div class="main">
          <div class="box">
            <div id="c">
              <h1>HTML/JS互转</h1>
              <div class="box1" style="text-align:center;"> 
<script src="images/globals.js?ver=20100621" type="text/javascript"></script>
<script src="js/Html_JS.js" type="text/javascript"></script>
<div class="box">
    <div id="b_1">        
        <div class="box1" style="text-align:center">
            <div class="info1"> 
                 <div class="Gbtop">
                    <div class="WStop1">
                    <div class="WStop2">HTML源代码转换JavaScript代码工具</div>
                    </div>
                    <div style="padding:5px;"> 
                      <div class="WSIn">
                        <div class="WSTitle">请将 <strong>Html</strong> 源代码拷贝到下面表单中:</div>
                        <div class="WSt">
                            <textarea id="osource" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;" onfocus="change()"  onkeyup="change()"></textarea>
                        </div>
                        <span  class="WSTitle">下面表单中是相应的 <strong>Js</strong> 代码: </span> <br />
                        <span  class="WSt">
                            <textarea id="oresult2" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;"></textarea>
                       </span>
                      </div>
                      </div>
                </div>
                <div class="Gbtop">
                   <div class="WStop1">
                     <div class="WStop2">JavaScript源代码转换HTML代码工具</div>
                   </div>
                   <div style="padding:5px;"> 
                      <div class="WSIn">
                         <span class="WSTitle">请将 <strong>Js</strong> 源代码拷贝到下面表单中:</span><br />
                         <span class="WSt">
                            <textarea id="oresult" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;" onfocus="rechange()" onkeyup="rechange()"></textarea>
                         </span>
                        <span class="WSTitle">下面表单中是相应的 <strong>Html</strong> 代码: </span><br />
                        <span class="WSt">
                           <textarea id="re" style=" border:1px solid #c5e2f2; width:800px; height:150px; overflow:visible;"></textarea>
                        </span>
                    </div>
                 </div>
            </div>
            </div>
        </div>
    </div>
</div>    
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
               <p>HTML/JS互转
            </p>
            </span>
        </div>
      </div>
</div>
<?php @require_once('foot.php');?>