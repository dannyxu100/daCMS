<?php
error_reporting(0);
function HashURL($url){
	$SEED   = "Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE. Yes, I'm talking to you, scammer.";
    $Result = 0x01020345;
    for ($i=0; $i<strlen($url); $i++){
        $Result ^= ord($SEED{$i%87}) ^ ord($url{$i});
        $Result  = (($Result >> 23) & 0x1FF) | $Result << 9;
    }
    return sprintf("8%x", $Result);
}
function GetPR($url){	
	$gurl     = "http://www.google.com/search?client=navclient-auto&features=Rank:&q=info:".$url.'&ch='.HashURL($url);
	$gcontent = @file_get_contents($gurl);
	if(strlen($gcontent)==11){
		return substr($gcontent,9,1);
	}elseif(strlen($gcontent)==12){
		return substr($gcontent,9,2);
	}else{
		return 0;
	}
}
$current_url = $_SERVER['QUERY_STRING'];
$current_url = str_replace("http://","",$current_url);
$current_url = str_replace("https://","",$current_url);
$current_url = trim($current_url);
if(preg_match("/^([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i",$current_url)){
	$pr = GetPR($current_url);
}else{
	$pr = 0;
}
?>

