<?php
function writeover($filename,$data,$method="rb+",$iflock=1,$chmod=1) {
	touch($filename);
	$handle=fopen($filename,$method);
	if ($iflock) {
		flock($handle,LOCK_EX);
	}
	fwrite($handle,$data);
	if ($method=="rb+") ftruncate($handle,strlen($data));
	fclose($handle);
	$chmod && @chmod($filename,0777);
}

function vvar_export($input,$t=null){
	$output = '';
	if (is_array($input)) {
		$output .= "array(\r\n";
		foreach ($input as $key => $value) {
			$output .= $t."\t".vvar_export($key,$t."\t").' => '.vvar_export($value,$t."\t");
			$output .= ",\r\n";
		}
		$output .= $t.')';
	} elseif (is_string($input)) {
		$output .= "'".str_replace(array("\\","'"),array("\\\\","\'"),$input)."'";
	} elseif (is_int($input) || is_double($input)) {
		$output .= "'".(string)$input."'";
	} elseif (is_bool($input)) {
		$output .= $input ? 'true' : 'false';
	} else {
		$output .= 'NULL';
	}
	return $output;
}

function filehave($urls,$url){
	if($url != ''){
		if(count($urls) == 0){
			$urls = array();
			$urls[0] = $url;
		}
		array_unshift($urls,$url);
		$urls = array_unique($urls);
		if(count($urls)>50){
			array_splice($urls,50);
		}
		return $urls;
	}
}

function fileno($url){
	if($url != ''){
		$urls = array();
		$urls[0] = $url;
		return $urls;
	}
}
?>