<?php
header("Content-Type:text/html;charset=gb2312");
@require_once('prfunction.php');
@require_once('../global.php');
$url = $_GET['domain'];
if($url){
	$ptr = "<table width=100%><tr><td align=right>域名&nbsp;&nbsp;&nbsp;&nbsp;</td><td align=left>&nbsp;&nbsp;&nbsp;&nbsp;PR</td><tr/>";
	$domain = explode(",",trim($url));
	for($i=0;$i<sizeof($domain);$i++){
		if(strlen($domain[$i])>1){
			$p[$i] = GetPR(trim($domain[$i]));
			$ptr  .= "<tr><td align=right><a href=http://".$domain[$i]." target=_blank><font color=red>".$domain[$i]."</font></a>：</td><td align=left><img src=../images/pagerank".$p[$i].".gif>&nbsp;真实的PR</td></tr>";
			if($_GET['xz'] == 1){
				$qw[$i] = str_replace("www.","",$domain[$i]);
				$cnt=0;
                while($cnt < 15 && ($ejym = @file_get_contents("http://www.baidu.com/s?wd=".$qw[$i]."&rn=100"))===FALSE) $cnt++;
				preg_match_all("/<font color=\"#008000\">(.*)\.<b>/Ui",$ejym,$arr);
				$arr[1] = array_unique($arr[1]);
				for($j=0;$j<sizeof($arr[1]);$j++){
					if(strpos($arr[1][$j],'.com') === false && strpos($arr[1][$j],'.') === false && strlen($arr[1][$j])>1){
						$url2[$j] = $arr[1][$j].".".$qw[$i];
						$pt[$i]   = GetPR(trim($url2[$j]));
						$ptr .= "<tr><td align=right><a href=http://".$url2[$j]." target=_blank>".$url2[$j]."</a>：</td><td align=left><img src=../images/pagerank".$pt[$i].".gif>&nbsp;真实的PR</td></tr>";
					}
				}
			}
		}
	}
	$ptr .= "</table>";
}else{
	$ptr = "请先输入正确的域名！例如：chinaccnet.com,yundns.com";
}
echo $ptr;
?>