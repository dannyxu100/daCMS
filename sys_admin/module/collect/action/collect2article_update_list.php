<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");

	$arratids = preg_split("/,/", $_POST["atids"]);
	
	$db = new DB("dacms");
	$set = $db->getlist("select * from sys_collect where c_id in(".$_POST["cids"].")");
	
	$sql = "insert into web_article(a_atid, a_title, a_title2, a_sort, a_count, 
	a_keywords, a_description, a_img, a_content, a_createdate, a_updatedate) 
	
	values(:atid, :atitle, :atitle2, :asort, :acount, 
	:akeywords, :adescription, :aimg, :acontent, :date, :date2)";

	$count = 0;
	if( 0<count($arratids) && 0<count($set) ){
		$db->tran();
		
		for($i=0; $i<count($arratids); $i++){
			if( "" == $arratids[$i]) continue;
			
			for($j=0; $j<count($set); $j++){
				$db->param(":atid", $arratids[$i]);
				$db->param(":asort", 0);
				$db->param(":acount", 0);
				$db->param(":aimg", "");
				$db->param(":atitle", $set[$j]["c_title"]);
				$db->param(":atitle2", $set[$j]["c_title"]);
				$db->param(":akeywords", $set[$j]["c_keywords"]);
				$db->param(":adescription", $set[$j]["c_description"]);
				$db->param(":acontent", $set[$j]["c_content"]);
				$db->param(":date", $now);
				$db->param(":date2", $now);
				
				$db->insert($sql);
				// Log::out($db->geterror());
				
				$db->paramclear();
				$db->update("update sys_collect set c_isused='TRUE' where c_id=".$set[$j]["c_id"]);
				$count++;
			}
		}
		
		// Log::out($db->geterror());
		if($db->geterror()){
			$db->back();
			echo 'FALSE';
		}
		else{
			$db->commit();
			echo count($count);
		}
	}
	else{
		echo 'FALSE';
	}
	$db->close();
?>