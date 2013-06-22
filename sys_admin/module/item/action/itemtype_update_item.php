<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";

	$db = new DB("dacms");
	
	$sql = "update sys_itemtype set ";
	
	if( isset($_POST["itname"]) )
	{
		$sql .= " it_name=:itname ";
		$db->param(":itname", $_POST["itname"]);
	}
	if( isset($_POST["itcode"]) )
	{
		$sql .= ", it_code=:itcode ";
		$db->param(":itcode", $_POST["itcode"]);
	}
	if( isset($_POST["itsort"]) )
	{
		$sql .= ", it_sort=:itsort ";
		$db->param(":itsort", $_POST["itsort"]);
	}
	if( isset($_POST["itremark"]) )
	{
		$sql .= ", it_remark=:itremark ";
		$db->param(":itremark", $_POST["itremark"]);
	}
	
	$sql .= " where it_id=:itid";
	$db->param(":itid", $_POST["itid"]);
	
	$res = $db->update($sql);
	// Log::out($db->geterror());

	$db->close();

	echo $res?$res:"FALSE";
?>