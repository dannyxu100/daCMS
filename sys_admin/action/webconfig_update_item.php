<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/log.php";
	
	$sql = "update web_config";
	$db = new DB("dacms");
	
	$sql .= " set c_company=:c_company";
	$db->param(":c_company", $_POST["c_company"]);
	
	if( isset($_POST["c_address"]) ){
		$sql .= ", c_address=:c_address";
		$db->param(":c_address", $_POST["c_address"]);
	}
	if( isset($_POST["c_user"]) ){
		$sql .= ", c_user=:c_user";
		$db->param(":c_user", $_POST["c_user"]);
	}
	if( isset($_POST["c_phone"]) ){
		$sql .= ", c_phone=:c_phone";
		$db->param(":c_phone", $_POST["c_phone"]);
	}
	if( isset($_POST["c_telephone"]) ){
		$sql .= ", c_telephone=:c_telephone";
		$db->param(":c_telephone", $_POST["c_telephone"]);
	}
	if( isset($_POST["c_email"]) ){
		$sql .= ", c_email=:c_email";
		$db->param(":c_email", $_POST["c_email"]);
	}
	if( isset($_POST["c_fax"]) ){
		$sql .= ", c_fax=:c_fax";
		$db->param(":c_fax", $_POST["c_fax"]);
	}
	if( isset($_POST["c_zipcode"]) ){
		$sql .= ", c_zipcode=:c_zipcode";
		$db->param(":c_zipcode", urldecode($_POST["c_zipcode"]));
	}
	if( isset($_POST["c_name"]) ){
		$sql .= ", c_name=:c_name";
		$db->param(":c_name", urldecode($_POST["c_name"]));
	}
	if( isset($_POST["c_website"]) ){
		$sql .= ", c_website=:c_website";
		$db->param(":c_website", urldecode($_POST["c_website"]));
	}
	if( isset($_POST["c_icp"]) ){
		$sql .= ", c_icp=:c_icp";
		$db->param(":c_icp", urldecode($_POST["c_icp"]));
	}
	if( isset($_POST["c_img"]) ){
		$sql .= ", c_img=:c_img";
		$db->param(":c_img", urldecode($_POST["c_img"]));
	}
	if( isset($_POST["c_keywords"]) ){
		$sql .= ", c_keywords=:c_keywords";
		$db->param(":c_keywords", urldecode($_POST["c_keywords"]));
	}
	if( isset($_POST["c_description"]) ){
		$sql .= ", c_description=:c_description";
		$db->param(":c_description", urldecode($_POST["c_description"]));
	}
	if( isset($_POST["c_pushemail"]) ){
		$sql .= ", c_pushemail=:c_pushemail";
		$db->param(":c_pushemail", urldecode($_POST["c_pushemail"]));
	}
	if( isset($_POST["c_pushpwd"]) ){
		$sql .= ", c_pushpwd=:c_pushpwd";
		$db->param(":c_pushpwd", urldecode($_POST["c_pushpwd"]));
	}
	if( isset($_POST["c_isstatic"]) ){
		$sql .= ", c_isstatic=:c_isstatic";
		$db->param(":c_isstatic", urldecode($_POST["c_isstatic"]));
	}
	if( isset($_POST["c_remark"]) ){
		$sql .= ", c_remark=:c_remark";
		$db->param(":c_remark", urldecode($_POST["c_remark"]));
	}
	
	$sql .= " where c_id=:c_id ";
	$db->param(":c_id", $_POST["c_id"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>