<?php
header("Content-Type:text/html;charset=GB2312");
$text   = $_GET['keys'];
$output = '';
$tab_text = str_split($text); 
foreach ($tab_text as $id=>$char){
  $hex = dechex(ord($char));
  $output .= '%' . $hex;
}
echo "<a href=http://www.baidu.com/s?wd=".$output." target=_blank>²é¿´</a>";
?>