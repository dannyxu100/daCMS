<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");

	$db = new DB("dacms");
	$sql = "insert into web_product(p_ptid, p_name, p_abstract, p_sort, p_viewcount, 
	p_status, p_code, p_no, p_place, p_stock, p_weight, p_unit, 
	p_costprice, p_vipprice, p_reduceprice, p_saleprice, p_marketprice, 
	p_img, p_content, p_keywords, p_description, 
	p_createdate, p_updatedate) 
	
	values(:pptid, :pname, :pabstract, :psort, :pviewcount, 
	:pstatus, :pcode, :pno, :pplace, :pstock, :pweight, :punit, 
	:pcostprice, :pvipprice, :preduceprice, :psaleprice, :pmarketprice, 
	:pimg, :pcontent, :pkeywords, :pdescription, 
	:pcreatedate, :pupdatedate)";
	
	$db->param(":pptid", $_POST["p_ptid"]);
	$db->param(":pname", $_POST["p_name"]);
	$db->param(":pabstract", $_POST["p_abstract"]);
	$db->param(":psort", $_POST["p_sort"]);
	$db->param(":pviewcount", $_POST["p_viewcount"]);
	$db->param(":pstatus", $_POST["p_status"]);
	$db->param(":pcode", $_POST["p_code"]);
	$db->param(":pno", $_POST["p_no"]);
	$db->param(":pplace", $_POST["p_place"]);
	$db->param(":pstock", $_POST["p_stock"]);
	$db->param(":pweight", $_POST["p_weight"]);
	$db->param(":punit", $_POST["p_unit"]);
	$db->param(":pcostprice", $_POST["p_costprice"]);
	$db->param(":pvipprice", $_POST["p_vipprice"]);
	$db->param(":preduceprice", $_POST["p_reduceprice"]);
	$db->param(":psaleprice", $_POST["p_saleprice"]);
	$db->param(":pmarketprice", $_POST["p_marketprice"]);
	$db->param(":pimg", $_POST["p_img"]);
	$db->param(":pcontent", $_POST["p_content"]);
	$db->param(":pkeywords", $_POST["p_keywords"]);
	$db->param(":pdescription", $_POST["p_description"]);
	$db->param(":pcreatedate", $now);
	$db->param(":pupdatedate", $now);
	
	$res = $db->insert($sql);
	// Log::out($db->geterror());
	$db->close();

	echo $res?$res:"FALSE";
?>