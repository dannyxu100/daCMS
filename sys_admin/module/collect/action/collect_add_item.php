<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/Collect.class.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	$now = date("Y-m-d H:i:s");
	$rid = $_POST["rid"];
	$urls = preg_split("/¡õ/", $_POST["urls"]);
	$titles = preg_split("/¡õ/", $_POST["titles"]);
	
	$db = new DB("dacms");
	$set = $db->getone("select * from sys_collectrule where r_id=".$_POST["rid"]);
	
	if(is_array($set) && 0<count($set)){
		$config = array(
			"title_rule" => $set["r_titlerule"],
			"title_html_rule" => $set["r_titleclear"],
			"keywords_rule" => $set["r_keywordsrule"],
			"keywords_html_rule" => $set["r_keywordsclear"],
			"description_rule" => $set["r_descriptionrule"],
			"description_html_rule" => $set["r_descriptionclear"],
			// "author_rule" => $set["r_authorrule"],
			// "author_html_rule" => $set["r_authorclear"],
			// "comeform_rule" => $set["r_comeformrule"],
			// "comeform_html_rule" => $set["r_comeformclear"],
			// "time_rule" => $set["r_timerule"],
			// "time_html_rule" => $set["r_timeclear"],
			"content_rule" => $set["r_contentrule"],
			"content_html_rule" => $set["r_contentclear"],
			"content_page_rule" => $set["r_splittype"],
			"content_page_start" => $set["r_splitrange1"],
			"content_page_end" => $set["r_splitrange2"],
			"content_nextpage" => $set["r_splitnexttag"],
			"down_attachment" => $set["r_downloadimg"]
		);
	}
	
	$collect;
	$count = 0;
	
	if( 0<count($urls) ){
		$db->tran();
		for($i=0; $i<count($urls); $i++){
			$param1 = array();
			array_push($param1, array(":c_rid", $rid));
			array_push($param1, array(":c_url", $urls[$i]));
			$db->paramlist($param1);

			if( 0 >= $db->getcount("select * from sys_collect where c_rid=:c_rid and c_url=:c_url") ){
				
				$collect = Collect::get_content( $urls[$i], $config, 0 );
				
				$param2 = array();
				array_push($param2, array(":c_rid", $rid));
				array_push($param2, array(":c_date", $now));
				array_push($param2, array(":c_url", $urls[$i]));
				array_push($param2, array(":c_title", $collect["title"]));
				array_push($param2, array(":c_keywords", $collect["keywords"]));
				array_push($param2, array(":c_description", $collect["description"]));
				array_push($param2, array(":c_content", $collect["content"]));
				$db->paramlist($param2);
				$db->insert("insert into sys_collect(c_rid, c_url, c_title, c_keywords, c_description, c_content, c_date ) 
				values(:c_rid, :c_url, :c_title, :c_keywords, :c_description, :c_content, :c_date )");
				
				$count++;
			}
		}

		if($db->geterror()){
			$db->back();
			$db->close();
			echo 'FALSE';
		}
		else{
			$db->commit();
			$db->close();
			echo $count;
		}
	}
	else{
		$db->close();
		echo 'FALSE';
	}
	
?>