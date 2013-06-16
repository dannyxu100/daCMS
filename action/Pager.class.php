<?php
	// include_once "log.php";
	// error_reporting(-1);
	// error_reporting(0);		//屏蔽错误信息
	
/************* 分页类 *************/
class Pager{
	//记录总数，每页显示记录条数，总页数
	public $m_total = 0;
	public $m_number = 0;
	public $m_index = 0;
	public $m_size = 0;
	public $m_url = "";
	public $m_prevhtml = "";
	public $m_nexthtml = "";
	public $m_linkshtml = "";

	public $m_prev = 1;
	public $m_next = 2;
	public $m_countList = 10;		//可显示数字链接按钮个数
	public $m_first = 1;			//第一个数字链接按钮编号
	public $m_last = 10;			//最后一个数字链接按钮编号
	
	private $m_showStart = true;	//显示首尾"..."链接按钮
	private $m_showEnd = true;		//显示首尾"..."链接按钮
	private $m_countStartAndEnd = 2;	//显示首尾边界页面链接按钮的个数
	
	/**构造函数
	*/
	function Pager( $total, $pageindex, $pagesize, $url ){
		$this->m_total = $total;
		$this->m_index = $pageindex;
		$this->m_size = $pagesize;
		$this->m_url = $url;
		
		$this->init();
	}
	
	/**初始化并链接数据库
	*/
	private function init(){
		$this->m_number = ceil($this->m_total/$this->m_size);
		if( !$this->reviseSetting() ){		//修正Pager分页对象的设置参数
			return;
		};

		$this->addLink( "PREV", $this->m_prev );			//添加前一页按钮
		$this->addStartLink();								//添加开始几页按钮

		for( $n=$this->m_first; $n<=$this->m_last; $n++ ){
				$this->addLink( "NUM", $n );				//添加数字链接按钮
		}
		
		$this->addEndLink();								//添加最后几页按钮
		$this->addLink("NEXT", $this->m_next );				//添加下一页按钮
		
	}
	
	
	//修正Pager分页对象的设置参数
	private function reviseSetting(){
		if( !strpos($this->m_url, "?" ) ){
			$this->m_url .= "?pageindex="; 
		}
		else{
			$this->m_url .= "&pageindex="; 
		}
	
		$this->m_index = (( 1 > $this->m_index || $this->m_number < $this->m_index ) ? 1 : $this->m_index);
		$toStart = $this->m_index;
		$toEnd = $this->m_number - $this->m_index + 1;
				
		if( 0 > $this->m_number ) {
			echo "分页错误提示：分页总页数不能小于0";
			return false;
		}
		
		$this->m_prev = 1 > $this->m_index ? 1 : $this->m_index - 1;																		//计算上一页、下一页
		$this->m_next = $this->m_number < $this->m_index ? $this->m_number : $this->m_index + 1;

		
		if( $this->m_countList >= $this->m_number ){		//可显示页数 >= 总页数
			$this->m_first = 1;
			$this->m_last = $this->m_countList = $this->m_number;
			
			$this->m_showStart = false;
			$this->m_showEnd = false;
		}
		else{								//可显示页数 < 总页数
			$isStart = $toStart < $this->m_countList;		//前面的页数不够显示一轮
			$isEnd = $toEnd < $this->m_countList;			//后面的页数不够显示一轮
			$isMidNotEnough = $isStart && $isEnd;			//前后页数都不够一轮显示
			$isMidEnough = !$isStart && !$isEnd;			//前后页数都足够显示一轮

			if( ( $isMidNotEnough && $toStart < $toEnd) || ( $isStart && !$isEnd ) ){	//前后页数都不够，但前面的页数比较少 或 前面的页数不够一轮，但后面的页数足够显示一轮
					$this->m_first = 1;
					$this->m_last = $this->m_countList;
					
					$this->m_showStart = false;
					$this->m_showEnd = true;
			}
			else if( ( $isMidNotEnough && $toStart > $toEnd) || ( !$isStart && $isEnd ) ){	//前后页数都不够，但后面的页数比较少 或 后面的页数不够一轮，但前面的页数足够显示一轮
					$this->m_first = $this->m_number - $this->m_countList + 1;
					$this->m_last = $this->m_number;
					
					$this->m_showStart = true;
					$this->m_showEnd = false;
			}
			else if( $isMidEnough ) {
					$mid = intval( $this->m_countList/2 );
					$this->m_first = $this->m_index - $mid;
					$this->m_last = $this->m_index + ( $this->m_countList - $mid );
					
					$this->m_showStart = true;
					$this->m_showEnd = true;
			}
		}

		return true;
	}

	
	/**添加前几页的快捷数字链接
	*/
	private function addStartLink(){
		if( !$this->m_showStart ) return;
		
		//前几页的快捷数字链接个数,要向前推2页
		$n=1;
		$len = ( $this->m_first > $this->m_countStartAndEnd ? $this->m_countStartAndEnd : $this->m_first - 2 );

		for($n=1; $n<=$len; $n++){
			$this->addLink( "NUM", $n );		//添加数字链接按钮
		}
		$this->addLink( "OMIT" );				//添加"..."省略号
	}

	
	/**添加最后几页的快捷数字链接
	*/
	private function addEndLink(){
		if( !$this->m_showEnd ) return;
		
		//最后几页的快捷数字链接个数,要向后推2页
		$toEnd = $this->m_number - $this->m_last;
		$n = ( $toEnd < $this->m_countStartAndEnd ? $this->m_last + 2 : ($this->m_number - $this->m_countStartAndEnd) + 1 );
		$len = $this->m_number;
		
		$this->addLink( "OMIT" );				//添加"..."省略号
		for(; $n<=$len; $n++){
			$this->addLink( "NUM", $n );		//添加数字链接按钮
		}
	}
	
	//追加Link按钮
	/*
		$type: 可选"PREV"|"NUM"|"NEXT"|"OMIT"
		$num: 页数
	*/
	private function addLink( $type, $num=-1 ){
		switch( $type ){
				case "PREV":
					if( 1 > $num ){
						$this->m_prevhtml = '<span class="current prev">上一页</span>';
					}
					else{
						$this->m_prevhtml = '<a href="'. fn_urlstatic( $this->m_url . $this->m_prev ) .'">« 上一页</a>';
					}
					break;
					
				case "NUM":
					if( $this->m_index == $num ){
						$this->m_linkshtml .= '<span class="current">'. $num .'</span>';
					}
					else{
						$this->m_linkshtml .= '<a href="'. fn_urlstatic( $this->m_url . $num ) .'">'. $num .'</a>';
					}
					break;
					
				case "NEXT":
					if( $this->m_number < $num ){
						$this->m_nexthtml = '<span class="current next">下一页</span>';
					}
					else{
						$this->m_nexthtml = '<a href="'. fn_urlstatic( $this->m_url . $this->m_next).'">下一页 »</a>';
					}
					break;
					
				case "OMIT":
					$this->m_linkshtml .= '<span class="omit">...</span>';
					break;
		}
	}
}
?>