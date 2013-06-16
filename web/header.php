<?php
	// error_reporting(0);
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/config.php";
	
	$sql = "select * from web_nav order by n_level asc, n_sort asc";
	
	$db = new DB("dacms");
	$set = $db->getlist($sql);
	$db->close();
	
	$navset1 = array();
	$navset2 = array();
	$navset3 = array();
	foreach( $set as $i=>$item ){
		if( 1 == $item["n_level"] ){
			$navset1[] = $item;
		}
		else if( 2 == $item["n_level"] ){
			$navset2[] = $item;
		}
		else if( 3 == $item["n_level"] ){
			$navset3[] = $item;
		}
	}
	
	$smarty->assign('navset1', $navset1);
	$smarty->assign('navset2', $navset2);
	$smarty->assign('navset3', $navset3);

?>