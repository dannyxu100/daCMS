<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Pager.class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/footer.php";
	
	
	$atid = $_GET["atid"];
	
	/***** 获取数据 *******/
	$db = new DB("dacms");
	
	//所属分类信息
	$sql = "select * from web_articletype where at_id=:atid";
	$db->param(":atid", $atid);
	$articletype = $db->getone($sql);
	
	//子类
	$sql = "select * from web_articletype where at_pid=:atid order by at_sort";
	$db->param(":atid", $atid);
	$articletype2 = $db->getlist($sql);
	
	//记录总数
	$sql = "select count(a_id) as total from web_article where a_atid=:atid";
	$db->param(":atid", $atid);
	$count = $db->getone($sql);

	//记录集
	$sql = "select * from web_article where a_atid=:atid order by a_sort asc, a_id desc limit :start, :len";
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
		$pagesize = $articletype["at_listnum"]?$articletype["at_listnum"]:10;
	}
	$start = ($pageindex-1)*$pagesize;
	$len = $pagesize;
	$db->param(":start", $start);
	$db->param(":len", $len);
	$db->param(":atid", $atid);
	$articleset = $db->getlist($sql);
	$db->close();
	
	/************* 分页代码 *************/
	$pager = new Pager( $count["total"], $pageindex, $pagesize, "/web/article/articlelist.php?atid=".$atid );
	$smarty->assign('pager_Total',$pager->m_total);
	$smarty->assign('pager_Number',$pager->m_number);
	$smarty->assign('pager_Prev',$pager->m_prevhtml);
	$smarty->assign('pager_Links',$pager->m_linkshtml);
	$smarty->assign('pager_Next',$pager->m_nexthtml);

	$smarty->assign('articletype', $articletype);
	$smarty->assign('articletype2', $articletype2);
	$smarty->assign('articleset', $articleset);
	
	$smarty->display('articlelist.htm');

	
?>