<?php
	// include_once "log.php";
	// error_reporting(-1);
	
	date_default_timezone_set('ETC/GMT-8');
	
class DB{
	private $m_CONNSTR = Array(
		0 => Array("host"=>"localhost", "user"=>"root", "pwd"=>"", "db"=>"dacms"),
		"dacms" => Array("host"=>"localhost", "user"=>"root", "pwd"=>"", "db"=>"dacms")
	);
	
	private $m_host;
	private $m_db;
	private $m_user;
	private $m_pwd;
	
	private $m_pdo;
	private $m_paramlist;
	
	public $m_error_msg;
	public $m_log = true;
	
	/**构造函数
	*/
	function DB($n=0){
		$this->m_host =& $this->m_CONNSTR[$n]["host"];
		$this->m_db =& $this->m_CONNSTR[$n]["db"];
		$this->m_user =& $this->m_CONNSTR[$n]["user"];
		$this->m_pwd =& $this->m_CONNSTR[$n]["pwd"];
		
		$this->init();
	}

	/**初始化并链接数据库
	*/
	private function init(){
		$this->m_pdo = new PDO(
			"mysql:host=".$this->m_host.";dbname=".$this->m_db,
			$this->m_user,
			$this->m_pwd,
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",		//设置数据库信息编码
				PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,				//启动异常信息
				PDO::ATTR_EMULATE_PREPARES => false,					//禁用prepared statements的仿真效果, 禁止了所有可能的恶意SQL注入攻击
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC		//设置只需要以字段名 作为返回数据集的索引
			)
		);
		
		$this->m_paramlist = array();
	}
	
	/**连接数据库
	*/
	// private function connect(){
	
	// }
	
	function close(){
		unset($this->m_CONNSTR);
		unset($this->m_host);
		unset($this->m_db);
		unset($this->m_user);
		unset($this->m_pwd);
		unset($this->m_pdo);
		unset($this->m_error_msg);
		unset($this->m_paramlist);
	}
	
	function CheckResource(){
		// if(!is_resource($this->link)){
		 // $this->PushError('失去数据库连接资源');
		 // return false;
		// }
		// return true;
	}

	/**设置错误信息
	*/
	private function seterror($msg){
		$this->m_error_msg = "[错误报告]";
		$this->m_error_msg.= "--(".$msg.")";
	}
	
	/**获取错误信息
	*/
	function geterror(){
		return $this->m_error_msg;
	}
	
	/**设置PDO属性值
	*/
	function setattr( $attr, $value ){
		$this->m_pdo->setAttribute($attr, $value);
	}
	
	/**获取PDO属性设置值
	*/
	function getattr( $attr ){
		return $this->m_pdo->getAttribute(constant($attr));
	}
	
	/**执行sql代码段(无参)
	*/
	function runsql($sql){
		$statement = $this->m_pdo->prepare($sql);
		
		try {
			$this->bindparamlist( $statement );
			$res = $statement->execute();		//返回true 或 false
			
			if($this->m_log){					//是否记录数据库操作日志
				DB::dblog("RUNSQL", $sql, $res);
			}
			return $res;
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
	
	/**添加sql参数列表
	*/
	function paramlist( $arrparam ){
		$this->m_paramlist = array();
	
		for( $i=0; $i<count($arrparam); $i++){
			$param = $arrparam[$i];
			array_push($this->m_paramlist, array("name"=>$param[0], "value"=>$param[1], "type"=>$this->getdbtype($param[1])));
		}
	}
	
	/**添加1个sql参数
	*/
	function param( $name, $value ){
		$idx = -1;
		for( $i=0; $i<count($this->m_paramlist); $i++){
			if($name == $this->m_paramlist[$i]["name"]){	//判断参数是否已存在
				$idx = $i;
			}
		}
		if(-1 != $idx){		//覆盖旧参数值
			$this->m_paramlist[$idx] = array("name"=>$name, "value"=>$value, "type"=>$this->getdbtype($value));
		}
		else{				//未设置过
			array_push($this->m_paramlist, array("name"=>$name, "value"=>$value, "type"=>$this->getdbtype($value)));
		}
	}
	
	/**清除sql参数列表
	*/
	function paramclear(){
		$this->m_paramlist = array();
	}
	
	/**根据添加的数据，返回对应的数据库类型
	*/
	function getdbtype($value) {
		if (is_int($value)) {
			return PDO::PARAM_INT;
		} 
		else if (is_bool($value)) {
			return PDO::PARAM_BOOL;
		} 
		else if (is_null($value)) {
			return PDO::PARAM_NULL;
		} 
		else {
			return PDO::PARAM_STR;
		}
	}
	
	/**给PDOstatement对象绑定参数
	*/
	private function bindparamlist( $statement ){
		for( $i=0; $i<count($this->m_paramlist); $i++){
			$param = $this->m_paramlist[$i];
			$statement->bindValue( $param["name"], $param["value"], $param["type"] );
		}
	}
	
	/**查询数据集
	*/
	function getlist($sql){
		$statement = $this->m_pdo->prepare($sql);
		
		try {
			$this->bindparamlist( $statement );
			$statement->execute();
			return $statement->fetchAll();		//从结构集中取出一个包含了所有行的数组
			
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
		
	}

	/**查询一条记录
	*/
	function getone($sql){
		$rows = $this->getlist($sql);
		
		if(is_array($rows) && 0<count($rows)){
			return $rows[0];
		}
		else{
			return null;
		}
	}
	
	/**查询数据数量
	*/
	function getcount($sql){
		$rows = $this->getlist($sql);
		return count($rows);
	}
	
	/**更新数据
	*/
	function update($sql){
		$statement = $this->m_pdo->prepare($sql);
			
		try {
			$this->bindparamlist( $statement );
			$statement->execute();
			$res = $statement->rowCount();		//返回影响行数
			
			if($this->m_log){					//是否记录数据库操作日志
				DB::dblog("UPDATE", $sql, $res);
			}
			
			return $res ;
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
	
	/**删除数据
	*/
	function delete($sql){
		$statement = $this->m_pdo->prepare($sql);
			
		try {
			$this->bindparamlist( $statement );
			$statement->execute();
			$res = $statement->rowCount();		//返回影响行数
			
			if($this->m_log){					//是否记录数据库操作日志
				DB::dblog("DELETE", $sql, $res);
			}
			
			return $res ;
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
	
	/**插入数据
	*/
	function insert($sql){
		$statement = $this->m_pdo->prepare($sql);
			
		try {
			$this->bindparamlist( $statement );
			$statement->execute();
			$res = $this->m_pdo->lastInsertId(); //返回刚插入的一条记录的主键
			
			if($this->m_log){					//是否记录数据库操作日志
				DB::dblog("INSERT", $sql, $res);
			}
			
			return $res; //返回刚插入的一条记录的主键
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
	
	/**启动事务处理
	*/
	function tran(){
		//数据库引擎必须为InnoDB格式(支持事务处理)
		try {
			$this->m_pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);	//关闭自动提交属性
			return $this->m_pdo->beginTransaction();
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return false;
		}
	}
	
	/**提交事务处理
	*/
	function commit(){
		try {
			$res = $this->m_pdo->commit();
			$this->m_pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);	//关闭自动提交属性
			return $res;
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return false;
		}
	}
	
	/**回滚事务处理
	*/
	function back(){
		try {
			$res = $this->m_pdo->rollBack();
			$this->m_pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);	//关闭自动提交属性
			return $res;
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return false;
		}
	}
	
	/**记录数据库操作日志
	*/
	public static function dblog( $type, $sql, $res ){
		$file = $_SERVER['PHP_SELF'];
		$now = date("Y-m-d H:i:s");
		$puid = "";
		$puname = "";
		
		$arrcookie = explode('|', urldecode($_COOKIE["COOKIE_FROM_DACMS"]));
		for($i=0; $i<count($arrcookie); $i++){
			$arrtmp = explode(':', $arrcookie[$i]);
			
			if( "puid" == $arrtmp[0] ){
				$puid = $arrtmp[1];
			}
			if( "puname" == $arrtmp[0] ){
				$puname = $arrtmp[1];
			}
			continue;
		}

		$db = new DB("dacms");
		$statement = $db->m_pdo->prepare("insert into sys_dblog(
		l_puid, l_puname, l_date, l_type, l_file, l_sql, l_res) values(
		:l_puid, :l_puname, :l_date, :l_type, :l_file, :l_sql, :l_res)");

		$db->param(":l_puid", $puid);
		$db->param(":l_puname", $puname);
		$db->param(":l_date", $now);
		$db->param(":l_type", $type);
		$db->param(":l_file", $file);
		$db->param(":l_sql", $sql);
		$db->param(":l_res", $res);

		try {
			$db->bindparamlist( $statement );
			$statement->execute();
		}
		catch (pdoException $e) {
			$db->seterror($e->getMessage());
		}
		
		$db->close();
		
	}
	
}



//兼容魔术引号， 适用各个 PHP 版本的用法
if (get_magic_quotes_gpc()) {
	foreach($_POST as $key=>$value){
		$_POST[$key] = stripslashes($_POST[$key]);
	}
}
?>