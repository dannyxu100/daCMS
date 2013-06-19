<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/Xml.class.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	define('SITE_URL', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''));
	
	/********************* 采集类 **********************/
	class Collect {
		protected static $url, $config;

		/**
		 * 获取文章网址
		 * @param string $url           采集地址
		 * @param array $config         配置
		 */
		public static function get_url_lists($url, $config) {
			/* 
			$config = array(
				"sourcetype" => 序列网址  多网址  单网址  RSS,
				"url_start" => url获取范围(开始位置代码),
				"url_end" => url获取范围(结束位置代码),
				"url_contain" => 网址过滤(必须包含的字符),
				"url_except" => 网址过滤(不能包含的字符)
			) 
			*/
			// Log::out($url);
			// Log::out(self::get_html($url, $config));
			if ($html = self::get_html($url, $config)) {
				if ("RSS" == $config['sourcetype']) { 			//RSS
					$xml = new Xml();
					$html = $xml->xml_unserialize($html);	//xml转数组
					
					$encode = mb_detect_encoding($html, array("ASCII", "GB2312", "GBK", "UTF-8", "BIG5")); 		//判断编码方式
					$html = self::array_iconv( $encode, 'UTF-8', $html );
					
					// if ( !empty($config['codeset']) && ('UTF-8' != $config['codeset']) ) {
						// $html = self::array_iconv( $config['codeset'], 'UTF-8', $html );
					// }
					
					$data = array();
					if (is_array($html['rss']['channel']['item'])){
						foreach ($html['rss']['channel']['item'] as $k=>$v) {
							$data[$k]['id'] = count($data);
							$data[$k]['url'] = $v['link'];
							$data[$k]['title'] = $v['title'];
						}
					}
					
				} else {
					$html = self::cut_html($html, $config['url_start'], $config['url_end']);
					// Log::out($html);
					// Log::out( $config['codeset'] );
					$encode = mb_detect_encoding($html, array("ASCII", "GB2312", "GBK", "UTF-8", "BIG5")); 		//判断编码方式
					$html = self::array_iconv( $encode, 'UTF-8', $html );
					
					// if ( !empty($config['codeset']) && ('UTF-8' != $config['codeset']) ) {
						// $html = iconv( $config['codeset'], 'UTF-8', $html );
					// }
					
					$html = str_replace(array("\r", "\n"), '', $html);
					$html = str_replace(array("</a>", "</A>"), "</a>\n", $html);

					preg_match_all('/<a([^>]*)>([^\/a>].*)<\/a>/i', $html, $out);
					if(str_replace(' rel="nofollow"','',$out[1])){					//无需追踪目标页
						$out[1]=str_replace(' rel="nofollow"','',$out[1]);
						$out[1]=str_replace('class="b_more_add"',"",$out[1]);		//更多按钮
						$out[1]=str_replace(' ','',$out[1]);
						$out[1]=str_replace("\t","",$out[1]);
					}
					
					$data = array();
					$temp = array();
				
					foreach ($out[1] as $k=>$v) {		
						// Log::out($out[2][$k].'-------'.$out[1][$k].'-------'.$out[0][$k]);
						
						if ( !preg_match('/href=[\'"]?([^\'" ]*)[\'"]?/i', $v, $match_out) ) {
							continue;
						}
						else {
							if ($config['url_contain']) {					//url地址必须包含字符
								if (strpos($match_out[1], $config['url_contain']) === false) {
									continue;
								}
							}

							if ($config['url_except']) {					//url地址不能包含字符
								if (strpos($match_out[1], $config['url_except']) !== false) {
									continue;
								}
							}
							
							$url2 = $match_out[1];	
							$url2 = self::url_check($url2, $url, $config);
							
							// Log::out($url2);
							if( !empty($temp[$url2]) ){		//筛除数组中的重复的链接
								continue;
							}
							else{
								$temp[$url2] = true;
							}
							
							array_push($data, array(
								"id" => count($data),
								"url" => $url2,
								"title" => strip_tags($out[2][$k])			//剥去 HTML、XML 以及 PHP 的标签
							));
							
						}
					}

				}
				
				return $data;
				
			} else {
				return false;
			}
		}

		/**
		 * URL地址检查
		 * @param string $url      需要检查的URL
		 * @param string $baseurl  基本URL
		 * @param array $config    配置信息
		 */
		protected static function url_check($url, $baseurl, $config) {
			$urlinfo = parse_url($baseurl);			//解析一个 URL 并返回一个关联数组，包含在 URL 中出现的各种组成部分

			$baseurl = $urlinfo['scheme'].'://'.$urlinfo['host'].(substr($urlinfo['path'], -1, 1) === '/' ? substr($urlinfo['path'], 0, -1) : str_replace('\\', '/', dirname($urlinfo['path']))).'/';
			if (strpos($url, '://') === false) {
				if ($url[0] == '/') {
					$url = $urlinfo['scheme'].'://'.$urlinfo['host'].$url;
				} else {
					if ( !empty($config['page_base']) ) {		//判断网站是否有base配置
						$url = $config['page_base'].$url;
					} else {
						$url = $baseurl.$url;
					}
				}
			}
			return $url;
		}
		
		
		/**
		 * 采集内容
		 * @param string $url    采集地址
		 * @param array $config  配置参数
		 * @param integer $page  分页采集模式
		 */
		public static function get_content($url, $config, $page = 0) {
			/* 
			$config = array(
				"title_rule" => 文章标题("[content]"为通配符),
				"title_html_rule" => 文章标题(替换字符),
				"keywords_rule" => 关键词("[content]"为通配符),
				"keywords_html_rule" => 关键词(替换字符),
				"description_rule" => 描述("[content]"为通配符),
				"description_html_rule" => 描述(替换字符),
				"author_rule" => 作者("[content]"为通配符),
				"author_html_rule" => 作者(替换字符),
				"comeform_rule" => 来源("[content]"为通配符),
				"comeform_html_rule" => 来源(替换字符),
				"time_rule" => 发布日期("[content]"为通配符),
				"time_html_rule" => 发布日期(替换字符),
				"content_rule" => 内容("[content]"为通配符),
				"content_html_rule" => 内容(替换字符),
				"content_page_start" => 内容分页代码开始位置,
				"content_page_end" => 内容分页代码结束位置,
				"content_page_rule" => 内容分页类型,
				"content_nextpage" => 内容分页下一页标志,
				"down_attachment" => 是否下载图片附件
			) 
			*/
			set_time_limit(300);
			$page = intval($page) ? intval($page) : 0;
			
			$html = "";
			
			if ($html = self::get_html($url)) {
				$encode = mb_detect_encoding($html, array("ASCII", "GB2312", "GBK", "UTF-8", "BIG5")); 		//判断编码方式
				$html = self::array_iconv( $encode, 'UTF-8', $html );
				
				// if ( !empty($config['codeset']) && ('UTF-8' != $config['codeset']) ) {
					// $html = self::array_iconv( $config['codeset'], 'UTF-8', $html );
				// }
				
				if (empty($page)) {
					//获取标题
					if ($config['title_rule']) {
						$title_rule = self::format_rule($config['title_rule']);
						$data['title'] = self::replace_rule(self::cut_html($html, $title_rule[0], $title_rule[1]), $config['title_html_rule']);
					}
					//获取关键词
					if ($config['keywords_rule']) {
						$title_rule = self::format_rule($config['keywords_rule']);
						$data['keywords'] = self::replace_rule(self::cut_html($html, $title_rule[0], $title_rule[1]), $config['keywords_html_rule']);
					}
					//获取描述
					if ($config['description_rule']) {
						$title_rule = self::format_rule($config['description_rule']);
						$data['description'] = self::replace_rule(self::cut_html($html, $title_rule[0], $title_rule[1]), $config['description_html_rule']);
					}

				/* 	//获取作者
					if ($config['author_rule']) {
						$author_rule =  self::format_rule($config['author_rule']);
						$data['author'] = self::replace_rule(self::cut_html($html, $author_rule[0], $author_rule[1]), $config['author_html_rule']);
					}

					//获取来源
					if ($config['comeform_rule']) {
						$comeform_rule =  self::format_rule($config['comeform_rule']);
						$data['comeform'] = self::replace_rule(self::cut_html($html, $comeform_rule[0], $comeform_rule[1]), $config['comeform_html_rule']);
					}

					//获取时间
					if ($config['time_rule']) {
						$time_rule =  self::format_rule($config['time_rule']);
						$data['time'] = strtotime(self::replace_rule(self::cut_html($html, $time_rule[0], $time_rule[1]), $config['time_html_rule']));
					}

					if (empty($data['time'])) $data['time'] = SYS_TIME;

					//对自定义数据进行采集
					if ($config['customize_config'] = string2array($config['customize_config'])) {
						foreach ($config['customize_config'] as $k=>$v) {
							if (empty($v['rule'])) continue;
							
							$rule =  self::format_rule($v['rule']);
							$data[$v['en_name']] = self::replace_rule(self::cut_html($html, $rule[0], $rule[1]), $v['html_rule']);
						}
					} */
				}
				
				//获取内容
				if ($config['content_rule']) {
					$content_rule =  self::format_rule($config['content_rule']);
					$data['content'] = self::replace_rule(self::cut_html($html, $content_rule[0], $content_rule[1]), $config['content_html_rule']);
				}
				
				//处理分页
				if (in_array($page, array(0,2)) && !empty($config['content_page_start']) && !empty($config['content_page_end'])) {
					$oldurl[] = $url;
					$tmp[] = $data['content'];
					$page_html = self::cut_html($html, $config['content_page_start'], $config['content_page_end']);
					
					//上下页模式
					if ($config['content_page_rule'] == 2 && in_array($page, array(0,2)) && $page_html) {
						preg_match_all('/<a[^>]*href=[\'"]?([^>\'" ]*)[\'"]?[^>]*>([^<\/]*)<\/a>/i', $page_html, $out);
						if (!empty($out[1]) && !empty($out[2])) {
							foreach ($out[2] as $k=>$v) {
								if (strpos($v, $config['content_nextpage']) === false) continue;
								if ($out[1][$k] == '#') continue;
								$out[1][$k] = self::url_check($out[1][$k], $url, $config);
								if (in_array($out[1][$k], $oldurl)) continue;
								$oldurl[] = $out[1][$k];
								$results = self::get_content($out[1][$k], $config, 2);
								if (!in_array($results['content'], $tmp)) $tmp[] = $results['content'];
							}
						}
					}

					//全部罗列模式
					if ($config['content_page_rule'] == 1 && $page == 0 && $page_html) {
						preg_match_all('/<a[^>]*href=[\'"]?([^>\'" ]*)[\'"]?/i', $page_html, $out);
						if (is_array($out[1]) && !empty($out[1])) {

							$out = array_unique($out[1]);
							foreach ($out as $k=>$v) {
								if ($out[1][$k] == '#') continue;
								$v = self::url_check($v, $url, $config);
								$results = self::get_content($v, $config, 1);
								if (!in_array($results['content'], $tmp)) $tmp[] = $results['content'];
							}
						}

					}
					// $data['content'] = $config['content_page'] == 1 ? implode('[page]', $tmp) : implode('', $tmp);
					$data['content'] = implode('', $tmp);
				}
				
				if ($page == 0) {
					self::$url = $url;
					self::$config = $config;
					
					// $data['content'] = preg_replace('/<img[^>]*src=[\'"]?([^>\'"\s]*)[\'"]?[^>]*>/ie', "self::download_img_1('$0', '$1')", $data['content']);
					
					//下载内容中的图片到本地
					if (empty($page) && !empty($data['content']) && $config['down_attachment'] == 1) {
						$data['content'] = self::download_img_2('content', $data['content']);
					}
				} 
				
				return self::strtr_words($data);	//伪原创字符替换
			}
			return null;
		}

		/**
		 * 获取远程HTML
		 * @param string $url    获取地址
		 */
		protected static function get_html($url) {
			if( function_exists("curl_init") ){					//判断curl是否开启
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);

				//设置URL，可以放入curl_init参数中
				curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");

				//设置UA
				$timeout = 30;
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

				//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。 如果不加，即使没有echo,也会自动输出
				$html = curl_exec($ch);

				//释放
				curl_close($ch);
				return $html;
			}
			
			if( function_exists("file_get_contents") ){	//判断file_get_contents是否开启
				if (!empty($url) && $html = @file_get_contents($url)) {
					return $html;
				}
			}
			return false;
		}
		
		/**
		 * HTML切取
		 * @param string $html    要进入切取的HTML代码
		 * @param string $start   开始
		 * @param string $end     结束
		 */
		protected static function cut_html($html, $start, $end) {
			if ( empty($html) ) return false;
			// Log::out($start);
			// Log::out($end);
			$html = str_replace(array("\r", "\n"), "", $html);
			if( !empty($start) ){
				$start = str_replace(array("\r", "\n"), "", $start);
				$html = explode(trim($start), $html);
			}
			
			// Log::out(is_array($html));
			if( is_array($html) ){
				if( !empty($end) ){
					$end = str_replace(array("\r", "\n"), "", $end);
					$html = explode(trim($end), $html[1]);
					return $html[0];
				}
				else{
					return $html[1];
				}
			}
			
			return $html;
		}

		/**
		* 替换代码
		* @param string $html  HTML代码
		* @param array $rule 过滤规则
		*/
		protected static function replace_rule($html, $rule) {
			if (empty($rule)) return $html;
			
			$rule = explode("\n", $rule);			//一行一条规则
			$patterns = $replace = array();
			$p = 0;
			
			foreach ($rule as $k=>$v) {
				if (empty($v)) continue;
				$c = explode('[|]', $v);			//"[|]"为替换内容,对应分隔符, 如<object>[|]。
				$patterns[$k] = '/'.str_replace('/', '\/', $c[0]).'/i';
				$replace[$k] = $c[1];
				$p = 1;
			}
			return $p ? @preg_replace($patterns, $replace, $html) : false;
		}

		/**
		* 格式化采集规则
		* @param $rule 采集规则
		*/
		protected static function format_rule( $rule ) {
			$list = explode('[content]', $rule);		//"[content]"为被捕获内容通配符
			if (is_array($list)){
				foreach ($list as $k=>$v) {
					$list[$k] = str_replace(array("\r", "\n"), '', trim($v));
				}
			}
			return $list;
		}
		
		
		/**
		 * 附件下载
		 * Enter description here ...
		 * @param $field 预留字段
		 * @param $value 传入下载内容
		 * @param $watermark 是否加入水印
		 * @param $absurl 绝对路径
		 * @param $basehref 
		 */
		protected static function download_img_2($field, $value, $watermark = '0', $absurl = '', $basehref = '') {
			//date("YmdHis") . '_' . rand(10000, 99999)
			$dir = '/uploads/attached/image/'. date("Ymd") .'/';
			
			$uploadpath = $dir;
			$uploaddir = rtrim($_SERVER['DOCUMENT_ROOT'],"/").$dir;
			$string = self::new_stripslashes($value);
			
			if(!preg_match_all("/(href|src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $string, $matches))
				return $value;
			
			$remotefileurls = array();
			foreach($matches[3] as $matche)
			{
				if(strpos($matche, '://') === false)
					continue;
				
				self::dir_create($uploaddir);
				$remotefileurls[$matche] = self::fillurl($matche, $absurl, $basehref);
			}
			
			unset($matches, $string);		//释放变量
			
			$remotefileurls = array_unique($remotefileurls);		//去除重复
			$oldpath = $newpath = array();
			
			foreach($remotefileurls as $k=>$file) {
				if(strpos($file, '://') === false || strpos($file, SITE_URL) !== false)
					continue;
				
				$fileext = self::fileext($file);
				$file_name = basename($file);
				$filename = date("YmdHis") . '_' . rand(10000, 99999).'.'.$fileext;
				
				$newfile = $uploaddir.$filename;
				
				if(copy($file, $newfile)) {
					$oldpath[] = $k;
					$newpath[] = $uploadpath.$filename;
					@chmod($newfile, 0777);
				}
			}
			return str_replace($oldpath, $newpath, $value);
		}
		
		/**
		 * 转换图片地址为绝对路径，为下载做准备。
		 * @param array $out 图片地址
		 */
		protected static function download_img_1($old, $out) {
			if (!empty($old) && !empty($out) && strpos($out, '://') === false) {
				return str_replace($out, self::url_check($out, self::$url, self::$config), $old);
			} else {
				return $old;
			}
			
		}
		
		/**
		 * 伪原创词库替换
		 * @param string $str 源内容
		 */
		protected static function strtr_words($str){
			// return $str;		//暂时不使用伪原创
			
			$words=array();
			$content = @file_get_contents(rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/sys_admin/module/collect/words.txt");		//打开词库

			$content = str_replace( "\r", "",$content); 							//去掉换行符(以便兼容Linux主机)
			$content = preg_split("/\n/", $content, -1, PREG_SPLIT_NO_EMPTY);		//\n分割字符
			
			foreach($content as $k=>$v){
				if($k!=0){
					$str_data = explode("→",$v);			//关键词分割符
					$words += array($str_data[0] => $str_data[1]);
				}
			}
			
			if( is_array( $str ) ){							//如果是数组
				$arr = array();
				foreach($str as $k=>$v){
					$arr[$k] = strtr($v, $words);
				}
				return $arr;
			}
			
			return strtr($str, $words);						//返回结果
		}
		
		/**
		 * 返回经stripslashes处理过的字符串或数组
		 * @param $string 需要处理的字符串或数组
		 * @return mixed
		 */
		protected static function new_stripslashes($string) {
			if(!is_array($string)) return stripslashes($string);
			foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
			return $string;
		}
		
		/**
		* 转化 \ 为 /
		* 
		* @param	string	$path	路径
		* @return	string	路径
		*/
		protected static function dir_path($path) {
			$path = str_replace('\\', '/', $path);
			if(substr($path, -1) != '/') $path = $path.'/';
			return $path;
		}
		
		/**
		* 创建目录
		* 
		* @param	string	$path	路径
		* @param	string	$mode	属性
		* @return	string	如果已经存在则返回true，否则为flase
		*/
		protected static function dir_create($path, $mode = 0777) {
			if(is_dir($path)) return TRUE;
			$ftp_enable = 0;
			$path = self::dir_path($path);
			$temp = explode('/', $path);
			$cur_dir = '';
			$max = count($temp) - 1;
			for($i=0; $i<$max; $i++) {
				$cur_dir .= $temp[$i].'/';
				if (@is_dir($cur_dir)) continue;
				@mkdir($cur_dir, 0777,true);
				@chmod($cur_dir, 0777);
			}
			return is_dir($path);
		}
		
		/**
		 * 取得文件扩展
		 *
		 * @param $filename 文件名
		 * @return 扩展名
		 */
		protected static function fileext($filename) {
			return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
		}
		
		/**
		* 补全网址
		*
		* @param	string	$surl		源地址
		* @param	string	$absurl		相对地址
		* @param	string	$basehref	网址
		* @return	string	网址
		*/
		protected static function fillurl($surl, $absurl, $basehref = '') {
			if($basehref != '') {
				$preurl = strtolower(substr($surl,0,6));
				if($preurl=='http://' || $preurl=='ftp://' ||$preurl=='mms://' || $preurl=='rtsp://' || $preurl=='thunde' || $preurl=='emule://'|| $preurl=='ed2k://')
				return  $surl;
				else
				return $basehref.'/'.$surl;
			}
			$i = 0;
			$dstr = '';
			$pstr = '';
			$okurl = '';
			$pathStep = 0;
			$surl = trim($surl);
			if($surl=='') return '';
			
			$urls = @parse_url(SITE_URL);
			$HomeUrl = !empty($urls['host'])?$urls['host']:"";
			$BaseUrlPath = $HomeUrl.$urls['path'];
			$BaseUrlPath = preg_replace("/\/([^\/]*)\.(.*)$/",'/',$BaseUrlPath);
			$BaseUrlPath = preg_replace("/\/$/",'',$BaseUrlPath);
			
			$pos = strpos($surl,'#');
			if($pos>0) $surl = substr($surl,0,$pos);
			if($surl[0]=='/') {
				$okurl = 'http://'.$HomeUrl.'/'.$surl;
			} elseif($surl[0] == '.') {
				if(strlen($surl)<=2) return '';
				elseif($surl[0]=='/') {
					$okurl = 'http://'.$BaseUrlPath.'/'.substr($surl,2,strlen($surl)-2);
				} else {
					$urls = explode('/',$surl);
					foreach($urls as $u) {
						if($u=="..") $pathStep++;
						else if($i<count($urls)-1) $dstr .= $urls[$i].'/';
						else $dstr .= $urls[$i];
						$i++;
					}
					$urls = explode('/', $BaseUrlPath);
					if(count($urls) <= $pathStep)
					return '';
					else {
						$pstr = 'http://';
						for($i=0;$i<count($urls)-$pathStep;$i++) {
							$pstr .= $urls[$i].'/';
						}
						$okurl = $pstr.$dstr;
					}
				}
			} else {
				$preurl = strtolower(substr($surl,0,6));
				if(strlen($surl)<7)
				$okurl = 'http://'.$BaseUrlPath.'/'.$surl;
				elseif($preurl=="http:/"||$preurl=='ftp://' ||$preurl=='mms://' || $preurl=="rtsp://" || $preurl=='thunde' || $preurl=='emule:'|| $preurl=='ed2k:/')
				$okurl = $surl;
				else
				$okurl = 'http://'.$BaseUrlPath.'/'.$surl;
			}
			$preurl = strtolower(substr($okurl,0,6));
			if($preurl=='ftp://' || $preurl=='mms://' || $preurl=='rtsp://' || $preurl=='thunde' || $preurl=='emule:'|| $preurl=='ed2k:/') {
				
				return $okurl;
				
			} else {
				$okurl = preg_replace('/^(http:\/\/)/i','',$okurl);
				$okurl = preg_replace('/\/{1,}/i','/',$okurl);
			
				return 'http://'.$okurl;
			}
		}
		
		/**
		* 字符串/二维数组/多维数组编码转换
		* @param string $in_charset 
		* @param string $out_charset 
		* @param mixed $data 
		**/
		protected static function array_iconv( $in_charset, $out_charset, $data ){
			if (!is_array($data)){
				$output = iconv($in_charset, $out_charset, $data);
			}elseif(count($data)===count($data, 1)){//判断是否是二维数组
				foreach($data as $key => $value){
					$output[$key] = iconv($in_charset, $out_charset, $value);
				}
			}else{
				eval('$output = '.iconv($in_charset, $out_charset, var_export($data, TRUE)).';');
			}
			return $output;
		}

	}
?>