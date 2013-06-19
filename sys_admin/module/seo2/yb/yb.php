<?php
$hu = 'yb';
@require_once('../header.php');
set_time_limit(0);
$q    = trim($_GET['q']); //关键词
$page = intval($_GET['p']); //页数
if($page==0) $page = 1;
$r_num   = 0; //结果个数
$p_num   = 40; //每页结果的数据条数
$result  = "";
$shengpy = array('B','T','H','S','N','L','J','H','S','J','Z','A','F','J','S','H','H','H','G','G','H','C','S','G','Y','X','S','G','Q','N','X','X','A','T');
$sheng = array('北京','天津','河北','山西','内蒙古','辽宁','吉林','黑龙江','上海','江苏','浙江','安徽','福建','江西','山东','湖南','湖北','河南','广东','广西','海南','重庆','四川','贵州','云南','西藏','陕西','甘肃','青海','宁夏','新疆','香港','澳门','台湾');
if($q){	
	if (!@file_exists($keydb)){
		$dreamdb = file("pc.dat");//读取区号文件
		$count   = count($dreamdb);//计算行数
		for($i=0; $i<$count; $i++) {
			$keyword    = explode(" ",$q);//拆分关键字
			$dreamcount = count($keyword);//关键字个数
			$detail     = explode("\t",$dreamdb[$i]);
			for ($ai=0; $ai<$dreamcount; $ai++){
				switch ($_GET['w']){
					case "sheng":
						@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[0]\");");break;
					case "diqu":
						@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[1]\");");break;
					case "shi":
						@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[2]\");");break;
					case "cun":
						@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[3]\");");break;
					case "youbian":
						@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[4]\");");break;
					case "quhao":
						@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[5]\");");break;
					default:
						@eval("\$found = eregi(\"$keyword[$ai]\",\"$dreamdb[$i]\");");break;
				}
				if(($found)){
					$r_num++;
					if(fmod($r_num, $p_num)==0) $r .= "\n";
					$r .= '<tr height="24"><td><a href="?q='.urlencode($detail[0]).'&w=sheng">'.$detail[0].'</a></td><td><a href="?q='.urlencode($detail[1]).'&w=diqu">'.$detail[1].'</a></td><td><a href="?q='.urlencode($detail[2]).'&w=shi">'.$detail[2].'</a></td><td><a href="?q='.urlencode($detail[3]).'&w=cun">'.$detail[3].'</a></td><td><a href="?q='.$detail[4].'&w=youbian">'.$detail[4].'</a></td><td><a href="?q='.trim($detail[5],"\n\r").'&w=quhao">'.trim($detail[5],"\n\r").'</a></td></tr>';
					if($r_num>=$p_num*($page-1)+1 && $r_num<=$p_num*$page){
						$result .= '<tr height="24"><td><a href="?q='.urlencode($detail[0]).'&w=sheng">'.$detail[0].'</a></td><td><a href="?q='.urlencode($detail[1]).'&w=diqu">'.$detail[1].'</a></td><td><a href="?q='.urlencode($detail[2]).'&w=shi">'.$detail[2].'</a></td><td><a href="?q='.urlencode($detail[3]).'&w=cun">'.$detail[3].'</a></td><td><a href="?q='.$detail[4].'&w=youbian">'.$detail[4].'</a></td><td><a href="?q='.trim($detail[5],"\n\r").'&w=quhao">'.trim($detail[5],"\n\r").'</a></td></tr>';
					}
					break;
				}
			}
			$p = ceil($r_num/$p_num); //结果实际页数
		}		
		$fp = @fopen($keydb,"a");
		@fwrite($fp,$r_num."\n".$r);
		@fclose($fp);
	}else{
		$dreamdb=file($keydb);
		$r_num = trim($dreamdb[0],"\n\r");
		$p = ceil($r_num/$p_num); //结果实际页数
		if($page>$p) $page=$p;
		$result = $dreamdb[$page];
	}
	for($i=1; $i<=$p; $i++){
		$post_l .= '<a href="?q='.urlencode($q).'&p='.$i;
		if($_GET['w']) $post_l .= '&act='.$_GET['w'];
		if($i==$page){
			$post_l .= '"><font color="red">['.$i.']</font></a> ';
		}else{
			$post_l .= '">['.$i.']</a> ';
		}
	}
	$post_l = '<tr><td align="center" style="font-size:14px;padding:10px;" bgcolor="#F0F0F0">分页：'.$post_l.' (共计'.$r_num.'个，每页'.$p_num.'个)</td></tr>';
	$result = '<table width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #98A7B8;"><tr><td style="background:#F0F0F0;padding:0 5px;color:#014198;" height="26" valign="middle"><b>找到'.$r_num.'个与 <a href="./?q='.urlencode($q).'"><font color="#c60a00">'.$q.'</font></a> 相关的邮编区号</b></td></tr><tr><td><table cellpadding="4" cellspacing="4" width="100%" style="text-align:center"><tr style="text-align:center;font-weight:bold;" height="26" bgcolor="#efefef"><td width="80">省</td><td>地区</td><td>市县</td><td>乡镇村</td><td width="80">邮政编码</td><td width="60">电话区号</td></tr>'.$result.'</table></td></tr>'.$post_l.'</table>';
}
switch ($_GET['w']){
	case "sheng":
		$qw = "省份: ";	break;
	case "diqu":
		$qw = "地区: ";	break;
	case "shi":
		$qw = "市县: ";  break;
	case "cun":
		$qw = "村镇乡: ";break;
	case "youbian":
		$qw = "邮编: ";  break;
	case "quhao":
		$qw = "区号: ";  break;
	default:break;
}
if($q){
	echo "<title>".$qw.$q." - 国内邮政编码区号查询 5Glive.com</title>";
	echo '<meta name="keywords" content="'.$q.','.$q.'邮编,'.$q.'区号,'.$q.'邮政编码,'.$q.'电话区号,查询" />';
	echo '<meta name="description" content="'.$q.'邮政编码区号查询www.5glive.com，本邮编区号查询系统拥有'.$q.'最全最新的邮编区号数据（6万多条），可以查询'.$q.'精确到'.$q.'的街道村镇的邮编区号，支持模糊查询，输入省名、市名、县名或村名即可查到'.$q.'相关邮编区号，也可以由邮编或区号反查地理位置。" />';
}else{
	echo "<title>国内邮政编码区号查询 5Glive.com</title>";
	echo '<meta name="keywords" content="国内,邮编,邮政编码,区号,电话区号,查询" />';
	echo '<meta name="description" content="国内邮政编码区号查询www.5glive.com，本邮编区号查询系统拥有全国最全最新的邮编区号数据（6万多条），可以查询精确到街道村镇的邮编区号，支持模糊查询，输入省名、市名、县名或村名即可查到相关邮编区号，也可以由邮编或区号反查地理位置。" />';
}
?>
<div class="main">
          <div class="box">
            <div id="c">
              <h1>邮编区号查询</h1>
              <div class="box1" style="text-align:center;">             
                  </span><div class="t" id="seo_result">
<table width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #98A7B8;" id="top"><tr><td align="center" style="font-size:12px;padding:0 0 10px 0;line-height:150%;">     <form action="" method="get" name="f1">
            <span class="info3" > 请输入要查询的城市名称：
            <input name="q" type="text" id="q" class="input" size="40" url="true" onmouseover="this.select()" value="<?php echo $q ?>"/><input name="a" type="hidden" id="a" value="search">
            <input name="btnS" class="but" type="submit" value="开始查询"  id="sub" />
          </form>查询省名、市名、县名、村名的时候请去掉<font color="red">省市县村</font>后缀<br>如查询“湖南省”，请输入“湖南”，支持邮编或区号反查地理位置<br>例：<a href="?q=%BA%FE%C4%CF&w=sheng">湖南</a> <a href="?q=%B3%A4%C9%B3&w=diqu">长沙</a> <a href="?q=%B3%A4%C9%B3%CA%D0&w=shi">长沙市</a> <a href="?q=%D3%EA%BB%A8%CD%A4&w=cun">雨花亭</a> <a href="?q=410004&w=youbian">410004</a> <a href="?q=0731&w=quhao">0731</a></td></tr>
<tr><td style="background:#F0F0F0;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b>高级查询</b></td></tr><tr><td align="center" valign="middle" style="padding:20px;">
<table style="font-size:14px;" width="100%" align="center">
<tr>
<td width="50%"><form action="" method="get" name="f1">　　按省名查：<select name="q" id="q" style="width:100px">
<?php
$count = count($sheng);
for($i=0;$i<$count;$i++){
	echo '<option value="'.$sheng[$i].'"';
	if($_GET['w']=="sheng" && $sheng[$i]==$q) echo ' selected';
	echo '>'.$shengpy[$i].' '.$sheng[$i].'</option>';
}
?>
</select><input name="w" id="w" type="hidden" value="sheng" /> <input type="submit" value=" 查找 " /></form></td><td width="50%"><form action="" method="get" name="f1">　按地区名查：<input name="q" id="q" type="text" size="18" delay="0" value="<?php if($_GET['w']=="diqu") echo $q; ?>" style="width:100px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" onmouseover="this.select()" /><input name="w" id="w" type="hidden" value="diqu" /> <input type="submit" value=" 查找 " /></form></td>
</tr>
<tr>
<td><form action="" method="get" name="f1">　按县市名查：<input name="q" id="q" type="text" size="18" delay="0" value="<?php if($_GET['w']=="shi") echo $q; ?>" style="width:100px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" onmouseover="this.select()" /><input name="w" id="w" type="hidden" value="shi" /> <input type="submit" value=" 查找 " /></form></td><td><form action="" method="get" name="f1">按乡镇村名查：<input name="q" id="q" type="text" size="18" delay="0" value="<?php if($_GET['w']=="cun") echo $q; ?>" style="width:100px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" onmouseover="this.select()" /><input name="w" id="w" type="hidden" value="cun" /> <input type="submit" value=" 查找 " /></form></td>
</tr>
<tr>
<td><form action="" method="get" name="f1">　　按邮编查：<input name="q" id="q" type="text" size="18" delay="0" value="<?php if($_GET['w']=="youbian") echo $q; ?>" style="width:100px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" onmouseover="this.select()" /><input name="w" id="w" type="hidden" value="youbian" /> <input type="submit" value=" 查找 " /></form></td><td><form action="" method="get" name="f1">　　按区号查：<input name="q" id="q" type="text" size="18" delay="0" value="<?php if($_GET['w']=="quhao") echo $q; ?>" style="width:100px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" onmouseover="this.select()" /><input name="w" id="w" type="hidden" value="quhao" /> <input type="submit" value=" 查找 " /></form></td>
</tr>
</table>
</td></tr></table><br />
<?php
if($q!=""){
	echo $result;
}else{	
	echo $result;
?>
<table width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #98A7B8;"><tr><td style="background:#F0F0F0;padding:0 5px;color:#014198;" height="26" valign="middle"><b>点击省份名称查询</b></td></tr><tr><td align="center">
<div style="font-size:middle;">
<div style="position:relative; width: 500px; height: 500px;">
<p><img alt="中国地图" longdesc="../images/map.gif" src="../images/map.gif" width="578" height="478" /></p>
<div style="position:absolute; left: 0px; top: 0px; width: 500px; height: 438px;"></div>
<div style="position:absolute; left:276px; top: 305px; width: 46px; height: 11px;"><a href="?q=四川&w=sheng" title="四川">四川</a></div>
<div style="position:absolute; left:335px; top: 320px; width: 46px; height: 11px;"><a href="?q=重庆&w=sheng" title="重庆">重庆</a></div>
<div style="position:absolute; left:418px; top: 174px; width: 46px; height: 11px;"><a href="?q=北京&w=sheng" title="北京">北京</a></div>
<div style="position:absolute; left:437px; top: 196px; width: 46px; height: 11px;"><a href="?q=天津&w=sheng" title="天津">天津</a></div>
<div style="position:absolute; left:494px; top: 289px; width: 46px; height: 11px;"><a href="?q=上海&w=sheng" title="上海">上海</a></div>
<div style="position:absolute; left:123px; top: 285px; width: 46px; height: 11px;"><a href="?q=西藏&w=sheng" title="西藏">西藏</a></div>
<div style="position:absolute; left:113px; top: 158px; width: 46px; height: 11px;"><a href="?q=新疆&w=sheng" title="新疆">新疆</a></div>
<div style="position:absolute; left:197px; top: 229px; width: 46px; height: 11px;"><a href="?q=青海&w=sheng" title="青海">青海</a></div>
<div style="position:absolute; left:394px; top: 263px; width: 46px; height: 11px;"><a href="?q=河南&w=sheng" title="河南">河南</a></div>
<div style="position:absolute; left:400px; top: 204px; width: 46px; height: 11px;"><a href="?q=河北&w=sheng" title="河北">河北</a></div>
<div style="position:absolute; left:262px; top: 384px; width: 46px; height: 11px;"><a href="?q=云南&w=sheng" title="云南">云南</a></div>
<div style="position:absolute; left:327px; top: 360px; width: 46px; height: 11px;"><a href="?q=贵州&w=sheng" title="贵州">贵州</a></div>
<div style="position:absolute; left:378px; top: 221px; width: 46px; height: 11px;"><a href="?q=山西&w=sheng" title="山西">山西</a></div>
<div style="position:absolute; left:485px; top: 154px; width: 46px; height: 11px;"><a href="?q=辽宁&w=sheng" title="辽宁">辽宁</a></div>
<div style="position:absolute; left:509px; top: 124px; width: 46px; height: 11px;"><a href="?q=吉林&w=sheng" title="吉林">吉林</a></div>
<div style="position:absolute; left:320px; top: 224px; width: 46px; height: 11px;"><a href="?q=宁夏&w=sheng" title="宁夏">宁夏</a></div>
<div style="position:absolute; left:461px; top: 263px; width: 46px; height: 11px;"><a href="?q=江苏&w=sheng" title="江苏">江苏</a></div>
<div style="position:absolute; left:479px; top: 321px; width: 46px; height: 11px;"><a href="?q=浙江&w=sheng" title="浙江">浙江</a></div>
<div style="position:absolute; left:445px; top: 294px; width: 46px; height: 11px;"><a href="?q=安徽&w=sheng" title="安徽">安徽</a></div>
<div style="position:absolute; left:458px; top: 358px; width: 46px; height: 11px;"><a href="?q=福建&w=sheng" title="福建">福建</a></div>
<div style="position:absolute; left:429px; top: 335px; width: 46px; height: 11px;"><a href="?q=江西&w=sheng" title="江西">江西</a></div>
<div style="position:absolute; left:344px; top: 270px; width: 46px; height: 11px;"><a href="?q=陕西&w=sheng" title="陕西">陕西</a></div>
<div style="position:absolute; left:218px; top: 180px; width: 46px; height: 11px;"><a href="?q=甘肃&w=sheng" title="甘肃">甘肃</a></div>
<div style="position:absolute; left:336px; top: 178px; width: 50px; height: 11px;"><a href="?q=内蒙古&w=sheng" title="内蒙古">内蒙古</a></div>
<div style="position:absolute; left:355px; top: 398px; width: 46px; height: 11px;"><a href="?q=广西&w=sheng" title="广西">广西</a></div>
<div style="position:absolute; left:440px; top: 230px; width: 46px; height: 11px;"><a href="?q=山东&w=sheng" title="山东">山东</a></div>
<div style="position:absolute; left:388px; top: 303px; width: 46px; height: 11px;"><a href="?q=湖北&w=sheng" title="湖北">湖北</a></div>
<div style="position:absolute; left:383px; top: 348px; width: 46px; height: 11px;"><a href="?q=湖南&w=sheng" title="湖南">湖南</a></div>
<div style="position:absolute; left:407px; top: 395px; width: 46px; height: 11px;"><a href="?q=广东&w=sheng" title="广东">广东</a></div>
<div style="position:absolute; left:363px; top: 456px; width: 46px; height: 11px;"><a href="?q=海南&w=sheng" title="海南">海南</a></div>
<div style="position:absolute; left:509px; top: 76px; width: 46px; height: 11px;"><a href="?q=黑龙江&w=sheng" title="黑龙江">黑龙江</a></div>
<div style="position:absolute; left:451px; top: 403px; width: 46px; height: 11px;"><a href="?q=香港&w=sheng" title="香港">香港</a></div>
<div style="position:absolute; left:420px; top: 415px; width: 46px; height: 11px;"><a href="?q=澳门&w=sheng" title="澳门">澳门</a></div>
<div style="position:absolute; left:498px; top: 386px; width: 46px; height: 11px;"><a href="?q=台湾&w=sheng" title="台湾">台湾</a></div>
<div style="position:absolute; left: 254px; top: 93px; width: 120px; height: 20px; color:#669933; font-size: 16px;">请点击省份名称进入查询</div>
</div>
</div>
</td></tr></table>
<?php
}
?>
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
      <p style="line-height:150%">本邮编区号查询系统拥有<strong>全国最全最新的邮编区号数据</strong>（6万多条），可以查询精确到街道村镇的邮编区号，支持模糊查询，输入省名、市名、县名或村名即可查到相关邮编区号，也可以由邮编或区号反查地理位置。<br>　　我国采用四级六位编码制，前两位表示省、市、自治区，第三位代表邮区，第四位代表县、市，最后两位代表投递邮局，最后两位是代表从这个城市哪个投递区投递的，即投递区的位置。<br>　　例如：邮政编码“410004”，“41”代表湖南省，“00”代表省会长沙，“04”代表所在投递区。 </p>
        </span>
    </div>
  </div>
</div>
<?php @require_once('../foot.php');?>