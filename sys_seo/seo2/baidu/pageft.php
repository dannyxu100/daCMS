<?php
function page_slice($total,$page,$page_size = '',$url = '',$max_length = ''){
	//$url   :传递的地址,默认为当前页面
	//$max_length:分页代码时候,中间的分页数的一半
	$page = ($page < 1) ? 1 : $page ;
	$page_size = $page_size ? $page_size : 10;
	$url = $url ? $url :$_SERVER['PHP_SELF'];
	$max_length = $max_length ? $max_length : 5 ;
	$start = $page ? ($page - 1) * $page_size : 0;
	$total_page = ceil($total/$page_size);
	$page_table = '';
	$page_table = '<table id="page_slice"><tr>';
	if($page == 1 ){
		$page_table .= '<td class="current_page">1</td>';
	}
	else{
		$page_table .= '<td><a href="'.$url.'&page=1">[1]</a></td>';
	}
	if($total_page < $max_length*2){
		$loop_start = 2;
		$loop_end = $total_page-1;
	}
	else{
		$loop_start = $page - $max_length;
		$loop_start = ($loop_start <2) ? 2 :$loop_start;
		$loop_end = $page + $max_length;
		$loop_end = ($loop_end < $max_length * 2) ? $max_length * 2:$loop_end;
		$loop_end = ($loop_end > $total_page) ? $total_page-1 :$loop_end;
	}
	$link_start = (($loop_start - $max_length) < 2) ? 2 :$loop_start - $max_length;
	$link_end = (($loop_end + $max_length) > $total_page) ? $total_page :$loop_end + $max_length;
	if($loop_start > 2){
		$page_table .= '<td><a href="'.$url.'&page='.$link_start.'">...</a></td>';
	}
	for($i = $loop_start ; $i <= $loop_end ; $i++){
		if($page == $i){
			$page_table .= '<td class="current_page">'.$i.'</td>';
		}
		else{
			$page_table .= '<td><a href="'.$url.'&page='.$i.'">['.$i.']</a></td>';
		}
	}
	if($loop_end < $total_page-1){
		$page_table .= '<td><a href="'.$url.'&page='.$link_end.'">...</a></td>';
	}
	if($total_page!=1){
		if($page == $total_page){
			$page_table .= '<td class="current_page">末页</td>';
		}
		else{
			$page_table .= '<td><a href="'.$url.'&page='.$total_page.'">[末页]</a></td>';
		}
	}
	return $page_table;
}
?>