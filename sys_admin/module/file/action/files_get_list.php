<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set('ETC/GMT-8');
	$rootdir = str_replace(array('/', '\\', '//', '\\\\'), DIRECTORY_SEPARATOR, rtrim($_SERVER['DOCUMENT_ROOT'],"/"));
	
	//获取用户单击页面上的目录链接生成的新的目录信息
	if( !isset($_POST["currentdir"]) || empty($_POST["currentdir"]) ){
		// $dir=getcwd();
		$dir=$_SERVER['DOCUMENT_ROOT'];
	}
	else{
	   $dir=urldecode($_POST["currentdir"]);
	}
	
	//改变目录
	chdir($dir);
	
	//打开目录
	$dh=opendir($dir);
	
	$filelist = array();
	$filecount = 0;
	$file;
	
	$arr1 = array();
	$arr2 = array();
	//循环读取目录中的目录及文件, 并整理文件夹和文件的顺序
	while($item = readdir($dh))
	{
		if(is_dir($item)){
			array_push($arr1, $item);
		}
		else{
			array_push($arr2, $item);
		}
	}
	closedir($dh);  //关闭目录
	$arrfiles = array_merge($arr1, $arr2);
	
	
	foreach ($arrfiles as $item){
		$file = array(
			"self" => null,
			"dir" => null,
			"f_name" => null,
			"f_type" => null,
			"f_size" => null,
			"f_createdate" => null,
			"f_updatedate" => null
			
		);
		
		$file["self"] = $_SERVER['PHP_SELF'];
		$file["f_name"] = iconv("GB2312", "UTF-8", $item); // 系统编码
		$file["f_createdate"] = date("Y/m/d H:i:s", filectime($item));	//取得文件创建的时间
		$file["f_updatedate"] = date("Y/m/d H:i:s", filemtime($item));	//取得文件最后修改的时间
		
		if(is_dir($item)){						//如果是目录
			$file["f_type"] = "folder";
			$file["f_size"] = "&nbsp;";
			
			if($item=="."){			//对当前目录
				$file["dir"] = getcwd();
				$file["f_name"] = "current";
			}
			else if($item==".."){	//对上一级目录
				$file["dir"] = getcwd()."\\..";
				if( getcwd() === $rootdir ){
					$file["f_name"] = 'root';
				}
				else{
					$file["f_name"] = 'back';
				}
			}
			else{					//对子目录
				$file["dir"] = getcwd()."\\$item";
			}
		}
		else{									//如果是文件
			$file["f_type"] = substr($item,strrpos($item,".")+1);	//截取文件类型
			$file["f_size"] = sprintf("%.2f", filesize($item)/1024)." KB";
			$file["dir"] = getcwd();
			
			$filecount++;
		}
		
		array_push($filelist, $file);
	}
	
	
	$res = array(
		"ds1"=>$filelist				//记录集
	);
	
	echo json_encode($res);
?>