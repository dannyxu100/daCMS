<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	$type = $_POST["type"];
	$arrids = preg_split("/,/", $_POST["ids"]);
	$arrtids = preg_split("/,/", $_POST["tids"]);
	
	$db = new DB("dacms");
	$sql = "insert into web_tagmap(t2c_ttype, t2c_tid, t2c_cid) values(:type, :tid, :cid)";

	$row = 0;
	if( 0<count($arrtids) && 0<count($arrids) ){
		$db->tran();
		
		for($i=0; $i<count($arrids); $i++){
			if( "" == $arrids[$i]) continue;
			
			for($j=0; $j<count($arrtids); $j++){
				
				$db->paramclear();
				if( 0 >= $db->getcount("select t2c_id from web_tagmap where t2c_ttype='".$type."' and t2c_tid=".$arrtids[$j]." and t2c_cid=".$arrids[$i])){
					$db->param(":type", $type);
					$db->param(":tid", $arrtids[$j]);
					$db->param(":cid", $arrids[$i]);
					$db->insert($sql);
					// Log::out($db->geterror());
					$row++;
				}
				
			}
		}
		
		// Log::out($db->geterror());
		if($db->geterror()){
			$db->back();
			echo 'FALSE';
		}
		else{
			$db->commit();
			echo $row;
		}
	}
	else{
		echo 'FALSE';
	}
	$db->close();
?>