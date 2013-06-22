<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	
	$sql = "update web_producttype set pt_name=:ptname ";
	$db->param(":ptname", $_POST["ptname"]);
	
	if( isset($_POST["ptimg"]) )
	{
		$sql .= ", pt_img=:ptimg ";
		$db->param(":ptimg", $_POST["ptimg"]);
	}
	if( isset($_POST["ptstyle"]) )
	{
		$sql .= ", pt_style=:ptstyle ";
		$db->param(":ptstyle", $_POST["ptstyle"]);
	}
	if( isset($_POST["ptsort"]) )
	{
		$sql .= ", pt_sort=:ptsort ";
		$db->param(":ptsort", $_POST["ptsort"]);
	}
	if( isset($_POST["ptlistnum"]) )
	{
		$sql .= ", pt_listnum=:ptlistnum ";
		$db->param(":ptlistnum", $_POST["ptlistnum"]);
	}
	if( isset($_POST["pturl"]) ){
		$sql .= ", pt_url=:pturl";
		$db->param(":pturl", $_POST["pturl"]);
	}
	if( isset($_POST["ptcontent"]) ){
		$sql .= ", pt_content=:ptcontent";
		$db->param(":ptcontent", urldecode($_POST["ptcontent"]));
	}
	if( isset($_POST["ptkeywords"]) )
	{
		$sql .= ", pt_keywords=:ptkeywords ";
		$db->param(":ptkeywords", $_POST["ptkeywords"]);
	}
	if( isset($_POST["ptdescription"]) )
	{
		$sql .= ", pt_description=:ptdescription ";
		$db->param(":ptdescription", $_POST["ptdescription"]);
	}
	if( isset($_POST["ptremark"]) )
	{
		$sql .= ", pt_remark=:ptremark ";
		$db->param(":ptremark", $_POST["ptremark"]);
	}
	
	$sql .= " where pt_id=:ptid";
	$db->param(":ptid", $_POST["ptid"]);

	$res = $db->update($sql);
	// echo $db->geterror();

	$db->close();

	echo $res?$res:"FALSE";
?>