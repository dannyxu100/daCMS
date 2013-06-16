<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);

	$db = new DB("dacms");
	
	$sql = "update web_nav set n_name=:nname ";
	$db->param(":nname", $_POST["nname"]);
	
	if( isset($_POST["nenname"]) )
	{
		$sql .= ", n_enname=:nenname ";
		$db->param(":nenname", $_POST["nenname"]);
	}
	if( isset($_POST["nlevel"]) )
	{
		$sql .= ", n_level=:nlevel ";
		$db->param(":nlevel", $_POST["nlevel"]);
	}
	if( isset($_POST["nimg"]) )
	{
		$sql .= ", n_img=:nimg ";
		$db->param(":nimg", $_POST["nimg"]);
	}
	if( isset($_POST["nurl"]) )
	{
		$sql .= ", n_url=:nurl ";
		$db->param(":nurl", $_POST["nurl"]);
	}
	if( isset($_POST["nurltarget"]) )
	{
		$sql .= ", n_urltarget=:nurltarget ";
		$db->param(":nurltarget", $_POST["nurltarget"]);
	}
	if( isset($_POST["nsort"]) )
	{
		$sql .= ", n_sort=:nsort ";
		$db->param(":nsort", $_POST["nsort"]);
	}
	if( isset($_POST["nremark"]) )
	{
		$sql .= ", n_remark=:nremark ";
		$db->param(":nremark", $_POST["nremark"]);
	}
	
	$sql .= " where n_id=:nid";
	$db->param(":nid", $_POST["nid"]);

	$res = $db->update($sql);

	$db->close();

	echo $res?$res:"FALSE";
?>