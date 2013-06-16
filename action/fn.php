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

	
	/**格式化伪静态参数
	*/
	function fn_urlstatic( $arr="" ){
		if( "" == $arr ){
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
			return;
		}
		else{
			$path = is_array($arr)?$arr["url"]:$arr;
			
			if( WC_ISSTATIC ){
				$path = explode( "?", $path );
				$file = $path[0];
				if( empty($path[1]) ){
					return $file;
				}
				$param = explode( "&", $path[1] );
				
				foreach( $param as $key=>$value ){
					// $url[] = $key ."-". $value;
					$url[] = str_replace("=", "-", $value);
				}
				
				$tmpurl = implode( "/", $url );
				return $file."/".$tmpurl .".htm";
			}
			else{
				if( !empty($path) ){
					return $path;
				}
				else{
					return "#";
				}
			}
		}
	}
	
	/**seo标题
	*/
	function fn_title($arr){
		foreach( $arr as $key=>$value ){
			if(!empty($value)) return $value;
		}
		return WC_NAME;
	}
	
	/**seo标题
	*/
	function fn_keywords($arr){
		foreach( $arr as $key=>$value ){
			if(!empty($value)) return $value;
		}
		return WC_KEYWORDS;
	}
	
	/**seo标题
	*/
	function fn_description($arr){
		foreach( $arr as $key=>$value ){
			if(!empty($value)) return $value;
		}
		return WC_DESCRIPTION;
	}
?>
