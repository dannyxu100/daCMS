<?php
	/**获取cookie值
	*/
	function fn_getcookie( $name ){
		$arrcookie = explode('|', urldecode($_COOKIE["COOKIE_FROM_DACMS"]));
		
		for($i=0; $i<count($arrcookie); $i++){
			$arr = explode(':', $arrcookie[$i]);
			
			if( $name != $arr[0] ) continue;
			
			return $arr[1];
		}
		return "null";
	}

	
	//格式化伪静态参数
	function fn_sethtmlurl($arr){
		foreach( $arr as $key=>$value ){
			$url[] = $key ."-". $value;
		}

		$tmpurl = implode( "/", $url );
		return "/".$tmpurl .".htm";
	}
	
	//解析伪静态参数
	function fn_gethtmlurl(){
		if( !empty($_SERVER['PATH_INFO']) ){
			$pathinfo=substr( $_SERVER['PATH_INFO'], 1 );
			$pathinfo=str_replace( ".htm", "", $pathinfo );
			$path=explode( "/", $pathinfo );
			$param;
			
			for( $i=0,$len=count( $path ); $i<$len; $i++ ){
				$param = explode( "-", $path[$i] );
				$_GET[$param[0]] = $param[1]; 
			}
		}
	}
?>
