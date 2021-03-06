<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	
	$sql = "update web_articletype set at_name=:atname ";
	$db->param(":atname", $_POST["atname"]);
	
	if( isset($_POST["atimg"]) )
	{
		$sql .= ", at_img=:atimg ";
		$db->param(":atimg", $_POST["atimg"]);
	}
	if( isset($_POST["atstyle"]) )
	{
		$sql .= ", at_style=:atstyle ";
		$db->param(":atstyle", $_POST["atstyle"]);
	}
	if( isset($_POST["atsort"]) )
	{
		$sql .= ", at_sort=:atsort ";
		$db->param(":atsort", $_POST["atsort"]);
	}
	if( isset($_POST["atlistnum"]) )
	{
		$sql .= ", at_listnum=:atlistnum ";
		$db->param(":atlistnum", $_POST["atlistnum"]);
	}
	if( isset($_POST["aturl"]) ){
		$sql .= ", at_url=:aturl";
		$db->param(":aturl", $_POST["aturl"]);
	}
	if( isset($_POST["atcontent"]) ){
		$sql .= ", at_content=:atcontent";
		$db->param(":atcontent", urldecode($_POST["atcontent"]));
	}
	if( isset($_POST["atkeywords"]) )
	{
		$sql .= ", at_keywords=:atkeywords ";
		$db->param(":atkeywords", $_POST["atkeywords"]);
	}
	if( isset($_POST["atdescription"]) )
	{
		$sql .= ", at_description=:atdescription ";
		$db->param(":atdescription", $_POST["atdescription"]);
	}
	if( isset($_POST["atremark"]) )
	{
		$sql .= ", at_remark=:atremark ";
		$db->param(":atremark", $_POST["atremark"]);
	}
	
	$sql .= " where at_id=:atid";
	$db->param(":atid", $_POST["atid"]);

	$res = $db->update($sql);
	// echo $db->geterror();

	$db->close();

	echo $res?$res:"FALSE";
?>