<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/header.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/web/footer.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Pager.class.php";
	
	$aid = isset($_GET["aid"]) ? $_GET["aid"] : "";
	
	$db = new DB("dacms");
	
	/** 获取文章信息 **/
	$sql = "select * from web_article where a_id=:aid";
	$db->param(":aid", $aid);
	$article = $db->getone($sql);

	
	/** 获取文章分类信息 **/
	$sql = "select * from web_articletype where at_pid=:atid order by at_sort";
	$db->param(":atid", $article["a_atid"]);
	$articletype = $db->getlist($sql);
	
	
	/** 获取文章评论信息 **/
	$db->paramclear();
	$db->param(":c_type", "ARTICLE_COMMENT");
	$db->param(":c_cid", $aid);
	//记录总数
	$sql = "select count(c_id) as total from web_comment where c_type=:c_type and c_cid=:c_cid";
	
	$count = $db->getone($sql);

	//记录集
	$sql = "select * from web_comment, web_vip 
	where c_type=:c_type and c_cid=:c_cid and c_vid=v_id 
	order by c_date desc limit :start, :len";
	
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
		// $pagesize = $articletype["at_listnum"]?$articletype["at_listnum"]:10;
		$pagesize = 20;
	}
	$start = ($pageindex-1)*$pagesize;
	$len = $pagesize;
	$db->param(":start", $start);
	$db->param(":len", $len);
	$commentlist = $db->getlist($sql);
	$db->close();
	
	/************* 分页代码 *************/
	$pager = new Pager( $count["total"], $pageindex, $pagesize, "/web/article/articledetail.php?aid=".$aid );
	$smarty->assign('pager_Total',$pager->m_total);
	$smarty->assign('pager_Number',$pager->m_number);
	$smarty->assign('pager_Prev',$pager->m_prevhtml);
	$smarty->assign('pager_Links',$pager->m_linkshtml);
	$smarty->assign('pager_Next',$pager->m_nexthtml);
	
	$smarty->assign('article', $article);
	$smarty->assign('articletype', $articletype);
	$smarty->assign('commentlist', $commentlist);
	
	$smarty->assign('url', 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]);
	$smarty->assign('pucode', fn_getcookie("pucode", "COOKIE_FROM_DACMSVIP"));
	$smarty->assign('puname', fn_getcookie("puname", "COOKIE_FROM_DACMSVIP"));
	
	
	$smarty->display('articledetail.htm');

?>