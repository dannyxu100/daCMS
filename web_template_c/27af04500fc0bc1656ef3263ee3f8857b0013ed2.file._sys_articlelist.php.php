<?php /* Smarty version Smarty-3.1.13, created on 2013-06-25 22:34:53
         compiled from "_sys_articlelist.php" */ ?>
<?php /*%%SmartyHeaderCode:297851c9aa8d67bee6-76089238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27af04500fc0bc1656ef3263ee3f8857b0013ed2' => 
    array (
      0 => '_sys_articlelist.php',
      1 => 1372170698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '297851c9aa8d67bee6-76089238',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c9aa8d6c3f43_22552283',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c9aa8d6c3f43_22552283')) {function content_51c9aa8d6c3f43_22552283($_smarty_tpl) {?><<?php ?>?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/class/Pager.class.php";
	
	
	$atid = $_GET["atid"];
	
	/***** 获取数据 *******/
	$db = new DB("dacms");
	
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

	$smarty->display('_sys_articlelist.htm');

?<?php ?>><?php }} ?>