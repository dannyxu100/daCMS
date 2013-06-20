<?php
@include_once('../global.php');
function get_seo_info($domain,$bot,$pn,$keys,$v,$output,$rn){
	global $ROBOT;
	if(!array_key_exists($bot, $ROBOT)) return 'Invalid Robot';
	$content   = '';
	$site_info = '';
	$kws       = '';
	$kw  = $sm = array();
	$content1  = get_content($ROBOT[$bot]['site_url']);
	if(empty($content1)) return 'Unkown Error...';
	$domain2 = substr($domain, 0, 4) == 'www.'?substr($domain, 4):$domain;
	if($bot == "baidu"){
		$c1 = "/<table (border=\"0\")?(\s)?cellpadding=\"0\" cellspacing=\"0\" id=\"(.*)\">(.*)<\/table><br>/Uis";
		$c2 = "/<font color=\"#008000\">(.*)<\/font>/Uis";
		preg_match_all($c1,$content1,$arr1);
		for($wu = 0;$wu<sizeof($arr1[0]);$wu++){
			preg_match_all($c2,$arr1[0][$wu],$arr2);
			array_push($sm ,$arr2[1][0]);
		}	
		$con1 = $arr1[0];
		$con2 = $sm;		
	}else{
		$c1 = "/<li class=g(.*)?>(.*)<\/div>/Uis";
		$c2 = "/<span class=f><cite>(.*)<\/cite>/Uis";
		preg_match_all($c1,$content1,$arr1);
		preg_match_all($c2,$content1,$arr2);
		$con1 = $arr1[2];
		$con2 = $arr2[1];
	}
	for($i=0;$i<sizeof($con1);$i++){
		$con2[$i] = str_replace("</b>","",$con2[$i]);
		$conn[$i] = explode("/",$con2[$i]);
		if(strpos($conn[$i][0],$domain2,0)  !==false){
			$kw[$i] = $con1[$i];
		}
	}
	foreach($kw as $key=>$val){
		$kws .= "第<font color=red> ".($key+1+$pn)." </font>个出现<br/>".$val;
	}
	if(@preg_match($ROBOT[$bot]['site_pattern'], $content1, $matches)) $site_info = $matches[1];
	$domain1 = "keys.php?domain=".$domain."&keys=".$output."&val=".$v."&rn=".$rn;
	$cons = "排名：<a href=".$domain1."&pn=0>1-".$rn."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*1).">".(($rn*1)+1)."-".($rn*2)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*2).">".(($rn*2)+1)."-".($rn*3)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*3).">".(($rn*3)+1)."-".($rn*4)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*4).">".(($rn*4)+1)."-".($rn*5)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*5).">".(($rn*5)+1)."-".($rn*6)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*6).">".(($rn*6)+1)."-".($rn*7)."</a>&nbsp;&nbsp;<a href=".$domain1."&pn=".($rn*7).">".(($rn*7)+1)."-".($rn*8)."</a>";
	$deta = "<font color=red>关键字</font> ".$keys." <font color=red>在网站</font> ".$domain." <font color=red>的</font> ".$bot." <font color=red>收录结果</font> ".($pn+1)."-".($pn+$rn)." <font color=red>名中有</font> ".sizeof($kw)." <font color=red>条记录</font>";
	return $text = $cons."<br/>".$deta."<br/>".$kws;	
}
?>