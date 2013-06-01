<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	/********************* �ɼ��� **********************/
	class Collect {
		protected static $url, $config;

		/**
		 * ��ȡ������ַ
		 * @param string $url           �ɼ���ַ
		 * @param array $config         ����
		 */
		public static function get_url_lists($url, &$config) {
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
					if(str_replace(' rel="nofollow"','',$out[1])){					//����׷��Ŀ��ҳ
						$out[1]=str_replace(' rel="nofollow"','',$out[1]);
						$out[1]=str_replace('class="b_more_add"',"",$out[1]);		//���ఴť
						$out[1]=str_replace(' ','',$out[1]);
						$out[1]=str_replace("\t","",$out[1]);
					}
							
					// $out[1] = array_unique($out[1]);			//�Ƴ������е��ظ���ֵ,�����ؽ������
					// $out[2] = array_unique($out[2]);
					// Log::out(count($out[1]));
					// Log::out(count($out[2]));
					
					$data = array();
				
					foreach ($out[1] as $k=>$v) {
						// Log::out($out[2][$k].'-------'.$out[1][$k].'-------'.$out[0][$k]);
						
						if (preg_match('/href=[\'"]?([^\'" ]*)[\'"]?/i', $v, $match_out)) {
							if ($config['url_contain']) {					//url��ַ��������ַ�
								if (strpos($match_out[1], $config['url_contain']) === false) {
									continue;
								}
							}

							if ($config['url_except']) {					//url��ַ���ܰ����ַ�
								if (strpos($match_out[1], $config['url_except']) !== false) {
									continue;
								}
							}
							$url2 = $match_out[1];	
							$url2 = self::url_check($url2, $url, $config);
							
							array_push($data, array(
								"url" => $url2,
								"title" => strip_tags($out[2][$k])			//��ȥ HTML��XML �Լ� PHP �ı�ǩ
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
		 * URL��ַ���
		 * @param string $url      ��Ҫ����URL
		 * @param string $baseurl  ����URL
		 * @param array $config    ������Ϣ
		 */
		protected static function url_check($url, $baseurl, $config) {
			$urlinfo = parse_url($baseurl);		//����һ�� URL ������һ���������飬������ URL �г��ֵĸ�����ɲ���

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
		 * �ɼ�����
		 * @param string $url    �ɼ���ַ
		 */
		public static function get_content($url) {
			set_time_limit(300);
			
			$html = "";
			
			if ($html = self::get_html($url)) {
				echo $html;
			}
		}

		/**
		 * ��ȡԶ��HTML
		 * @param string $url    ��ȡ��ַ
		 */
		protected static function get_html($url) {
			if (!empty($url) && $html = @file_get_contents($url)) {
				return $html;
			} else {
				return false;
			}
		}

		/**
		 * HTML��ȡ
		 * @param string $html    Ҫ������ȡ��HTML����
		 * @param string $start   ��ʼ
		 * @param string $end     ����
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
		 * ת��ͼƬ��ַΪ����·����Ϊ������׼����
		 * @param array $out ͼƬ��ַ
		 */
		protected static function download_img($old, $out) {
		
		}
	}
?>