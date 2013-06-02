<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

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
			if ($html = self::get_html($url, $config)) {
				if ($config['sourcetype'] == 4) { //RSS
					$xml = pc_base::load_sys_class('xml');
					$html = $xml->xml_unserialize($html);
					
					if (pc_base::load_config('system', 'charset') == 'gbk') {
						$html = array_iconv($html, 'utf-8', 'gbk');
						
					}
					$data = array();
					if (is_array($html['rss']['channel']['item'])){
						foreach ($html['rss']['channel']['item'] as $k=>$v) {
							$data[$k]['url'] = $v['link'];
							$data[$k]['title'] = $v['title'];
							
						}
					}
					
				} else {
					$html = self::cut_html($html, $config['url_start'], $config['url_end']);
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
						
						if (preg_match('/href=[\'"]?([^\'" ]*)[\'"]?/i', $v, $match_out)) {
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
							
						} else {
							continue;
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
			$urlinfo = parse_url($baseurl);		//解析一个 URL 并返回一个关联数组，包含在 URL 中出现的各种组成部分

			$baseurl = $urlinfo['scheme'].'://'.$urlinfo['host'].(substr($urlinfo['path'], -1, 1) === '/' ? substr($urlinfo['path'], 0, -1) : str_replace('\\', '/', dirname($urlinfo['path']))).'/';
			if (strpos($url, '://') === false) {
				if ($url[0] == '/') {
					$url = $urlinfo['scheme'].'://'.$urlinfo['host'].$url;
				} else {
					if ($config['page_base']) {		//??????????????
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
			) 
			*/
			set_time_limit(300);
			$page = intval($page) ? intval($page) : 0;
			
			$html = "";
			
			if ($html = self::get_html($url)) {
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
				
				/* if ($page == 0) {
					self::$url = $url;
					self::$config = $config;
					$data['content'] = preg_replace('/<img[^>]*src=[\'"]?([^>\'"\s]*)[\'"]?[^>]*>/ie', "self::download_img('$0', '$1')", $data['content']);

					//下载内容中的图片到本地
					if (empty($page) && !empty($data['content']) && $config['down_attachment'] == 1) {

						pc_base::load_sys_class('attachment','',0);
						$attachment = new attachment('collection', '0', get_siteid());
						$data['content'] = $attachment->download('content', $data['content'], $config['watermark']);
					}
				} */
				
				return self::strtr_words($data);	//伪原创字符替换
			}
			return null;
		}

		/**
		 * 获取远程HTML
		 * @param string $url    获取地址
		 */
		protected static function get_html($url) {
			if (!empty($url) && $html = @file_get_contents($url)) {
				return $html;
			} else {
				return false;
			}
		}

		/**
		 * HTML切取
		 * @param string $html    要进入切取的HTML代码
		 * @param string $start   开始
		 * @param string $end     结束
		 */
		protected static function cut_html($html, $start, $end) {
			if (empty($html)) return false;
			$html = str_replace(array("\r", "\n"), "", $html);
			$start = str_replace(array("\r", "\n"), "", $start);
			$end = str_replace(array("\r", "\n"), "", $end);
			$html = explode(trim($start), $html);
			if(is_array($html)) $html = explode(trim($end), $html[1]);
			return $html[0];
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
		 * 转换图片地址为绝对路径，为下载做准备。
		 * @param array $out 图片地址
		 */
		protected static function download_img($old, $out) {
			
		}
		
		/**
		 * 伪原创词库替换
		 * @param string $str 源内容
		 */
		protected static function strtr_words($str){
			return $str;
			$words=array();
			$content = @file_get_contents(rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/sys_collect/words.txt");		//打开词库

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
	}
?>