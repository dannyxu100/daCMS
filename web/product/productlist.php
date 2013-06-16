<?php
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/Pager.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/footer.php";
	
	
	$ptid = $_GET["ptid"];
	
	/***** 获取数据 *******/
	$db = new DB("dacms");
	
	//所属分类信息
	$sql = "select * from web_producttype where pt_id=:ptid";
	$db->param(":ptid", $ptid);
	$producttype = $db->getone($sql);
	
	//子类
	$sql = "select * from web_producttype where pt_pid=:ptid order by pt_sort";
	$db->param(":ptid", $ptid);
	$producttype2 = $db->getlist($sql);
	
	//记录总数
	$sql = "select count(p_id) as total from web_product where p_ptid=:ptid";
	$db->param(":ptid", $ptid);
	$count = $db->getone($sql);
	
	//记录集
	$sql = "select * from web_product where p_ptid=:ptid order by p_sort asc, p_id desc limit :start, :len";
	if( isset($_GET["pageindex"]) && !empty($_GET['pageindex'])){	//分页
		$pageindex = intval($_GET['pageindex']);
	}
	else{
		$pageindex = 1;
	}
	if( isset($_GET["pagesize"]) && !empty($_GET['pagesize'])){
		$pagesize = intval($_GET['pagesize']);
	}
	else{
		$pagesize = $producttype["pt_listnum"]?$producttype["pt_listnum"]:10;
	}
	$start = ($pageindex-1)*$pagesize;
	$len = $pagesize;
	$db->param(":start", $start);
	$db->param(":len", $len);
	$db->param(":ptid", $ptid);
	$productset = $db->getlist($sql);
	$db->close();

	/************* 分页代码 *************/
	$pager = new Pager( $count["total"], $pageindex, $pagesize, "/web/product/productlist.php?ptid=".$ptid );
	$smarty->assign('pager_Total',$pager->m_total);
	$smarty->assign('pager_Number',$pager->m_number);
	$smarty->assign('pager_Prev',$pager->m_prevhtml);
	$smarty->assign('pager_Links',$pager->m_linkshtml);
	$smarty->assign('pager_Next',$pager->m_nexthtml);
	

	$smarty->assign('producttype', $producttype);
	$smarty->assign('producttype2', $producttype2);
	$smarty->assign('productset', $productset);
	
	$smarty->display('productlist.htm');

	
?>