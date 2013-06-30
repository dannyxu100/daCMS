<?php
	/**获取cookie值
	*/
	function fn_getcookie( $name, $cookie="COOKIE_FROM_DACMS" ){
		if( !isset($_COOKIE[$cookie]) ){
			return null;
		}
		$arrcookie = explode('|', urldecode($_COOKIE[$cookie]));
		
		for($i=0; $i<count($arrcookie); $i++){
			$arr = explode(':', $arrcookie[$i]);
			
			if( $name != $arr[0] ) continue;
			
			return $arr[1];
		}
		return null;
	}

	/**格式化伪静态参数
	*/
	function fn_urlstatic( $arr="" ){
		if( "" == $arr ){			//get处理
			if( !empty($_SERVER['PATH_INFO']) ){
				$pathinfo=substr( $_SERVER['PATH_INFO'], 1 );
				$pathinfo=str_replace( ".html", "", $pathinfo );
				$path=explode( "/", $pathinfo );
				$param;
				
				for( $i=0,$len=count( $path ); $i<$len; $i++ ){
					$param = explode( "-", $path[$i] );
					if( isset( $param[1] ) ){
						$_GET[$param[0]] = $param[1]; 
					}
				}
			}
		}
		else{						//set处理
			$path = is_array($arr)?$arr["url"]:$arr;
			
			if( WC_ISSTATIC ){		//判断是否开启伪静态
				if( $path 
				&& 0 !== strpos( $path, "/") 
				&& 0 !== strpos( $path, "http")  
				&& 0 !== strpos( $path, "#") ){			//处理相对路径
					$path = "../". $path;
				}
				
				$arrtmp = explode( "?", $path );
				$file = $arrtmp[0];
				
				if( empty($arrtmp[1]) ){
					return $path;
				}
				$param = explode( "&", $arrtmp[1] );
				
				if( 0 < count($param) ){
					foreach( $param as $key=>$value ){
						// $url[] = $key ."-". $value;
						$url[] = str_replace("=", "-", $value);
					}
					
					// Log::out($file);
					$tmpurl = implode( "/", $url );
					return $file."/".$tmpurl .".html";
				}
				else{
					return $path;
				}
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
