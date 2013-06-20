<?php
@require_once('header.php');
@include_once('friendlink/qqwry.php');
@include_once('ip/ip.php');
?>
<script language="javascript">
 function chec(){
 	var dom = $('Site_Domain').value;
 	$('dom').value = dom;
 	var len =document.getElementsByName("searchtype").length;
 	var j = '';
 	for(var i=1;i<=len;i++){
 		if ($('searchtype'+i).checked)
 		{
 			j = j+$('searchtype'+i).value+',';
 		}
 	}
 	j = j.substr(0,j.length-1);
 	$('choosea').value = j;
 }
 function checs(){
 	var dom = $('Link_Domain').value;
 	$('dom1').value = dom;
 	var len =document.getElementsByName("searchtypes").length;
 	var j = '';
 	for(var i=1;i<=len;i++){
 		if ($('searchtypes'+i).checked)
 		{
 			j = j+$('searchtypes'+i).value+',';
 		}
 	}
 	j = j.substr(0,j.length-1);
 	$('che1').value = j;
 }
 function radis(){
 	for(var t=0;t<4;t++){
 		if($('md'+t).checked){
 			$('Md5Type').value=t;
 		}
 	}
 }
 function ss(){
 	window.location.href="seo/alls.php?domain="+$('addr_more').value;
 }
 function checkEngines(zt) {
   if(zt){
   	for(var k=1;k<8;k++){
   		$('searchtype'+k).checked = true;
   	}
   }else{
   	for(var k=1;k<8;k++){
   		$('searchtype'+k).checked = false;
   	}
   }
}
 function checkEngines2(zt) {
   if(zt){
   	for(var k=1;k<5;k++){
   		$('searchtypes'+k).checked = true;
   	}
   }else{
   	for(var k=1;k<5;k++){
   		$('searchtypes'+k).checked = false;
   	}
   }
}
</script>
<div class="main">
    <div class="box">
      <div id="b_1">
        <div id="Show_User_Ip">
        <div class="sotopleft"><?php echo $ips?></div>
        </div>
        <div class="box1" style="text-align:center;">
         <div style="padding:5px 0; font-size:15px;"> <font color="green"><b>HTTP://</b></font> <input name="addr_more" type="text" id="addr_more" url="true" class="input" size="35" onKeyDown="if(event.keyCode==13) ss();" />
         </div>
           <input onclick="window.open('dels/dels.php?domain='+getid('addr_more').value)" name="button" type="button" class="but" value="域名删除时间" />
           <input onclick="window.open('baidu/baidu.php?domain='+getid('addr_more').value)" type="button" class="but" value="百度收录"  />
          <input onclick="window.open('whois/?domain='+getid('addr_more').value)" name="button" type="button" class="but" value="Whois 查询" />
          <input onclick="window.open('ip/?domain='+getid('addr_more').value)" name="button" type="button" class="but" value="IP 查询" />
          <input onclick="window.open('pr/pr.php?domain='+getid('addr_more').value)" name="button" type="button" class="but" value="PR 查询" />
          <input onclick="window.open('http://alexa.chinaccnet.com/?domain='+getid('addr_more').value)" name="button" type="button" class="but" value="Alexa 排名" />
          <input onclick="window.open('friends/friends.php?domain='+getid('addr_more').value)" name="button" type="button" class="but" value="友情链接检测" />
          <input onclick="location.href='seo/alls.php?domain='+getid('addr_more').value;" name="button" type="button" class="but" value="SEO综合查询" style=" color:#eb6100;" />
        </div>
	  </div>
      </div>
    </div>
	
    <div class="box" id="Content_0">
    <div class="col">
    <div id="b_2">   
              <h1>搜索引擎收录情况查询</h1>         
              <form action="ssyqsl/ssyqsl.php" method="POST">
              <input type="hidden" name="dom" id="dom">
              <input type="hidden" name="choosea" id="choosea">
              <div class="box1">网站地址：<input name="Site_Domain" id="Site_Domain" type="text" url="true" class="input" size="30" value=""/>
              <input name="button" type="submit" class="but" value="查询" onclick="chec();"/>
	          <span class="info">
	            <input id="searchtype1" type="checkbox" name="searchtype" value="1" checked="checked" /><label for="site1">百度</label>
	            <input id="searchtype2" type="checkbox" name="searchtype" value="2" checked="checked" /><label for="site2">Google</label>
	            <input id="searchtype3" type="checkbox" name="searchtype" value="3" checked="checked" /><label for="site4">雅虎</label>
	            <input id="searchtype4" type="checkbox" name="searchtype" value="4" checked="checked" /><label for="site8">搜搜</label>
	            <input id="searchtype5" type="checkbox" name="searchtype" value="5" checked="checked" /><label for="site16">有道</label>
	            <input id="searchtype6" type="checkbox" name="searchtype" value="6" checked="checked" /><label for="site32">必应</label>
	            <input id="searchtype7" type="checkbox" name="searchtype" value="7" checked="checked" /><label for="site8192">搜狗</label>
	            <input id="chk" name="chk" type="checkbox" checked="checked" onclick="checkEngines(this.checked);" />
<label for="chk">全选</label>              
              </span>
              </div>
              </form>
            </div>		
    </div>    	  
    <div class="col2">
    <form action="ssyqfl/ssyqfl.php" method="POST">
    <div id="b_3">
              <h1>搜索引擎反向链接情况查询</h1>
            <div class="box1">网站地址：<input name="ctl00$Main$Link_Domain" id="Link_Domain" type="text" url="true" class="input" size="30"  value="" />
              <input type="hidden" name="dom1" id="dom1">
              <input type="hidden" name="che1" id="che1">
                  <input name="button2" type="submit" class="but" value="查 询" onclick="checs();"/>
                  <span class="info">
                    <input type="checkbox" id="searchtypes1" name="searchtypes" value="1" checked="checked" /><label for="link1">百度</label>
                    <input id="searchtypes2" type="checkbox" name="searchtypes" value="2" checked="checked" /><label for="link2">Google</label>
                    <input id="searchtypes3" type="checkbox" name="searchtypes" value="3" checked="checked" /><label for="link4">雅虎</label>
                    <input id="searchtypes4" type="checkbox" name="searchtypes" value="4" checked="checked" /><label for="link16">有道</label>
                    <input id="chk2" name="chk2" type="checkbox" checked="checked" onclick="checkEngines2(this.checked);" />
<label for="chk">全选</label>
              </div>
              </form>
            </div>	
    </div>	   	  
    </div>
    <div class="box" id="Content_1">
    <div class="col">
    <div id="b_4">
              <h1>关键词排名查询</h1>
              <div class="box1">网站地址：<input name="s" id="s" url="true" type="text" class="input" size="30"/>
              &nbsp;&nbsp;<select name="t" id="ctl00_Main_SEnginType" style="width:90px; height:26px;"> 
                 <option selected="selected" value="1">Baidu</option> 
                 <option value="2">Google</option>
                 </select>
             <br/> 关&nbsp;&nbsp;键&nbsp;词：<input name="kw" id="kw" type="text" class="input" size="30" />
              <input onclick="window.open('keys/keys.php?domain='+getid('s').value+'&keys='+getid('kw').value+'&val='+getid('ctl00_Main_SEnginType').value);"  name="button" type="button" class="but" value="查 询" />
              </div>             
            </div>	
    </div>
    <div class="col2">
    <div id="b_5">
              <h1>页面关键词密度查询</h1>
              <div class="box1">网站地址：<input name="DAddress" id="durl" url="true" type="text" class="input" size="30" value=""  /><br />
	      关&nbsp;&nbsp;键&nbsp;词：<input name="DKeyWords" words="true" id="DKeyWords" type="text" class="input" size="30" />
	      <input name="button" type="button" onclick="window.open('density.php?keys='+getid('DKeyWords').value+'&url='+getid('durl').value)" class="but" value="查 询" />
          </div>
            </div>		
    </div>	 	   	  
    </div>
<div style="clear:both;"></div>
<div style="margin-top:-5px!import; margin-top:0px;margin-bottom:5px;">
<div style="clear:both;"></div>
</div>
<div class="box" id="Content_2">
<form action="mds.php" method="POST">
  <div id="b_11">
      <h1>MD5加密</h1><input type="hidden" name="Md5Type" id="Md5Type">     
      <div class="box1">请输入欲加密的字符串：<input name="mds" id="mds" type="text" class="input" size="43" />
          <input id="md0" name="Md5Types" value="0" checked="checked" type="radio"/><label for="md32l">32位[大]</label>
          <input id="md1" name="Md5Types" value="1" type="radio" /><label for="md32s">32位[小]</label>
          <input id="md2" name="Md5Types" value="2" type="radio" /><label for="md16l">16位[大]</label>
          <input id="md3" name="Md5Types" value="3" type="radio" /><label for="md16s">16位[小]</label>
          <input name="" class="but" type="submit" onclick="radis();" value="加 密" />
      </div>          
    </div>
    </form>
</div>
<div class="box" id="Content_3">
  <div class="col">	
    <div id="b_6">
      <h1>搜索引擎模拟抓取页面</h1>      
      <div class="box1">页面地址：<input url="true" name="txtSiteUrl" id="txtSiteUrl" type="text" class="input" size="30" value=""/>
       <input name="button" type="button" onclick="window.open('esearch.php?domain='+getid('txtSiteUrl').value)" class="but" value="查 询" />
      </div>      
    </div>			
    <div id="b_7">
      <h1>字符到ASCII码 转换工具</h1>
      <div class="box1">输入一个字符：<input name="asciitxt" id="asciitxt" type="text" class="input" size="25"  />
      <input name="button" type="button" class="but" onclick="var v=document.getElementById('asciitxt').value;if(v&&v.length>0){alert('字符：'+v.charAt(0)+' 的ASCII码为：'+v.charCodeAt(0));}" value="显示该键值" />	      
      </div>
    </div>
  </div>
  <div class="col2">	
    <div id="b_8">
      <h1>网页 META 信息检测</h1>          
      <div class="box1">页面地址：<input name="txtSiteUrl" id="metaurl" url="true" type="text" class="input"  size="30" value=""  />
      <input name="button" type="button" onclick="window.open('meta.php?domain='+getid('metaurl').value)" class="but" value="查 询" />
      </div>          
    </div>		
    <div id="b_13">
      <h1>测试死链接/全站PR查询</h1>
      <form id="formlink" action="/Links/Default.aspx" method="post" target="_blank">
      <div class="box1">网站地址：<input name="DAddress" id="linkurl" url="true" type="text" class="input" size="30" value=""/>
      <input name="button" type="button" onclick="window.open('webs/webs.php?domain='+getid('linkurl').value)" class="but" value="查 询" />      
     </div>
    </form>
  </div>
  </div>	  	  
</div>
<div class="box">
  <div id="b_15">
    <h1>自助友情链接</h1>  
  </div>
</div>
</div>
<?php @require_once('foot.php');?>