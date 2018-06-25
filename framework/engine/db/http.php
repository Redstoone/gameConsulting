<?php
/**
 * 客户端引挈
 * @作者 qinggan <admin@phpok.com>
 * @版权 深圳市锟铻科技有限公司
 * @主页 http://www.phpok.com
 * @版本 4.x
 * @授权 http://www.phpok.com/lgpl.html PHPOK开源授权协议：GNU Lesser General Public License
 * @时间 2018年02月09日
**/

/**
 * 安全限制，防止直接访问
**/
if(!defined("PHPOK_SET")){
	exit("<h1>Access Denied</h1>");
}

class db_http extends db
{
	private $lastdata;
	private $keycode;
	private $token;
	public function __construct($config=array())
	{
		include_once(FRAMEWORK.'libs/token.php');
		include_once(FRAMEWORK.'libs/curl.php');
		parent::__construct($config);
		$this->keycode = isset($config['keycode']) ? $config['keycode'] : '';
		$this->kec("`","`");
		$this->connect();
	}

	public function __destruct()
	{
		if($this->conn && is_object($this->conn)){
			$this->conn = null;
		}
		if($this->token && is_object($this->token)){
			$this->token = null;
		}
	}

	/**
	 * 显示密钥或设置密钥
	 * @参数 $keycode 密钥 
	**/
	public function keycode($keycode='')
	{
		if($keycode){
			$this->keycode = $keycode;
		}
		return $this->keycode;
	}

	/**
	 * 类型设置
	 * @参数 $type ，为 num 时使用 num ，返之为 assoc
	**/
	public function type($type='')
	{
		return $this->type;
	}

	/**
	 * 数据库连接
	**/
	public function connect()
	{
		$this->token = new token_lib();
		$this->conn = new curl_lib();
		return $this->conn;
	}

	/**
	 * 设置参数
	**/
	public function set($name,$value)
	{
		$this->$name = $value;
	}

	/**
	 * 执行SQL
	**/
	public function query($sql,$loadcache=true)
	{
		$this->_time();
		$info = $this->_curl($sql,'query');
		$tmptime = $this->_time();
		$this->_count();
		if($this->debug){
			$this->debug($sql,$tmptime);
		}
		return $info;
	}

	/**
	 * 获取列表数据
	 * @参数 $sql 要查询的SQL
	 * @参数 $primary 绑定主键
	**/
	public function get_all($sql='',$primary="")
	{
		if($sql){
			$this->_time();
			$this->lastdata = $this->_curl($sql,'all');
			$this->_time();
		}
		if(!$this->lastdata){
			return false;
		}
		if(!$primary){
			return $this->lastdata;
		}
		$rslist = array();
		foreach($this->lastdata as $key=>$value){
			if($value[$primary]){
				$rslist[$value[$primary]] = $value;
			}
		}
		return $rslist;
	}

	/**
	 * 获取一条数据
	 * @参数 $sql 要执行的SQL
	**/
	public function get_one($sql='')
	{
		if($sql){
			$this->_time();
			$this->lastdata = $this->_curl($sql,'one');
			$this->_time();
			if(!$this->lastdata){
				return false;
			}
		}
		return $this->lastdata;
	}

	/**
	 * 返回最后插入的ID
	**/
	public function insert_id()
	{
		return true;
	}


	/**
	 * 写入操作
	 * @参数 $sql 要插入的SQL或数组
	 * @参数 $tbl 数据表名称
	 * @参数 $type 插放入方式，仅限 $sql 为数组时有效，当为布尔值时表示是否前缀，此时type默认为 insert
	 * @参数 $prefix 是否检查前缀
	**/
	public function insert($sql,$tbl='',$type='insert',$prefix=true)
	{
		if(is_array($sql) && $tbl){
			if(is_bool($type)){
				$prefix = $type;
				$type = 'insert';
			}
			return $this->insert_array($sql,$tbl,$type,$prefix);
		}
		return $this->_curl($sql,'insert');
	}

	/**
	 * 数组写入操作
	 * @参数 $data 数组
	 * @参数 $tbl 表名
	 * @参数 $type 写入方式
	 * @参数 $prefix 是否检查前缀
	**/
	public function insert_array($data,$tbl,$type="insert",$prefix=true)
	{
		if(!$tbl || !$data || !is_array($data)){
			return false;
		}
		if($prefix && substr($tbl,0,strlen($this->prefix)) != $this->prefix){
			$tbl = $this->prefix.$tbl;
		}
		$sql = $this->_insert_array($data,$tbl,$type);
		return $this->insert($sql);
	}
	
	/**
	 * 返回行数
	 * @参数 $sql 要执行的SQL语句
	 * @参数 $is_count 是否计算数量，仅限 sql 中使用 count() 时有效
	**/
	public function count($sql="",$is_count=true)
	{
		if(!$sql){
			return $this->lastdata;
		}
		return $this->_curl($sql,'count');
	}

	/**
	 * 返回被筛选出来的字段数目
	 * @参数 $sql 要执行的SQL语句
	**/
	public function num_fields($sql="")
	{
		if($sql){
			return $this->_curl($sql,'num_fields');
		}
		return false;
	}

	/**
	 * 显示表字段，仅限字段名，没有字段属性
	 * @参数 $table 表名
	 * @参数 $prefix 是否检查数据表前缀
	 * @返回 无值或表字段数组
	**/
	public function list_fields($table,$prefix=true)
	{
		if($prefix && substr($table,0,strlen($this->prefix)) != $this->prefix){
			$table = $this->prefix.$table;
		}
		$rs = $this->get_all("SHOW COLUMNS FROM ".$table);
		if(!$rs){
			return false;
		}
		foreach($rs as $key=>$value){
			$rslist[] = $value["Field"];
		}
		return $rslist;
	}

	/**
	 * 取得明细的字段管理
	 * @参数 $table 表名
	 * @参数 $check_prefix 是否检查数据表前缀
	**/
	public function list_fields_more($table,$check_prefix=true)
	{
		if($check_prefix && substr($table,0,strlen($this->prefix)) != $this->prefix){
			$table = $this->prefix.$table;
		}
		$rs = $this->get_all("SHOW FULL COLUMNS FROM ".$table);
		if(!$rs){
			return false;
		}
		foreach($rs as $key=>$value){
			$tmp = array();
			foreach($value as $k=>$v){
				$tmp[strtolower($k)] = $v;
			}
			$rslist[$value["Field"]] = $tmp;
		}
		return $rslist;
	}

	/**
	 * 显示数据库表
	**/
	public function list_tables()
	{
		$list = $this->get_all("SHOW TABLES");
		if(!$list){
			return false;
		}
		$rslist = array();
		foreach($list as $key=>$value){
			$tbl = current($value);
			$rslist[] = $tbl;
		}
		return $rslist;
	}

	/**
	 * 显示表名
	 * @参数 $table_list 数组，整个数据库中的表
	 * @参数 $i 顺序ID
	**/
	public function table_name($table_list,$i)
	{
		return $table_list[$i];
	}

	/**
	 * 字符转义
	 * @参数 $char 要转义的字符
	**/
	public function escape_string($char)
	{
		if(!$char){
			return false;
		}
		return addslashes($char);
	}

	/**
	 * 取得数据库服务版本
	 * @参数 $type 支持server和client两种类型
	**/
	public function version($type="server")
	{
		return VERSION;
	}

	/**
	 * 创建主表操作
	 * @参数 $tblname 表名称
	 * @参数 $pri_id 主键ID
	 * @参数 $note 表摘要
	 * @参数 $engine 引挈，默认是 MYISAM
	**/
	public function create_table_main($tblname,$pri_id='',$note='',$engine='')
	{
		if(!$engine){
			$engine = 'MYISAM';
		}
		if(!$pri_id){
			$pri_id = 'id';
		}
		$sql  = "CREATE TABLE IF NOT EXISTS `".$tblname."`(`".$pri_id."` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',";
		$sql .= "PRIMARY KEY (`".$pri_id."`) ) ";
		$sql .= "ENGINE=".$engine." DEFAULT CHARACTER SET utf8 COMMENT='".$note."' AUTO_INCREMENT=1;";
		return $this->query($sql);
	}

	/**
	 * 增加或修改表字段
	 * @参数 $tblname 表名称，带前缀
	 * @参数 $data 要更新的表信息，包括字段有：id 表ID，type类型，length长度，unsigned是否无符号，notnull是否非空，default默认值，comment备注
	 * @参数 $old 旧表字段ID，如果检查不能，表示新增
	**/
	public function update_table_fields($tblname,$data,$old='')
	{
		if(!$tblname || !$data || !is_array($data)){
			return false;
		}
		$check = $this->list_fields_more($tblname,false);
		if(!$check){
			return false;
		}
		if(!$oldid){
			$old = $data['id'];
		}
		if(!$data['type']){
			$data['type'] = 'varchar';
		}
		$sql = "ALTER TABLE `".$tblname."` ";
		if($check[$old]){
			$sql .= "CHANGE `".$old."` `".$data['id']."` ";
		}else{
			$sql .= "ADD `".$data['id']."` ";
		}
		$sql .= strtoupper($data['type']);
		if($data['type'] == 'varchar'){
			$sql .= "(255)";
		}else{
			if($data['length']){
				$sql.= "(".$data['length'].")";
			}

		}
		$sql .= " ";
		if($data['unsigned']){
			$sql .= "UNSIGNED ";
		}
		if($data['notnull']){
			$sql .= "NOT NULL ";
			if($data['default'] != ''){
				$sql .= "DEFAULT '".$data['default']."' ";
			}else{
				if($data['type'] == 'varchar'){
					$sql .= "DEFAULT '' ";
				}
			}
		}else{
			$sql .= "NULL ";
		}
		if($data['comment']){
			$sql .= "COMMENT '".$data['comment']."' ";
		}
		return $this->query($sql);
	}

	/**
	 * 创建更新索引
	 * @参数 $tblname 表名
	 * @参数 $indexname 索引名，也可以是字段名
	 * @参数 $fields 字段名，支持字段数组，留空使用索引名
	 * @参数 $old 删除旧索引
	**/
	public function update_table_index($tblname,$indexname,$fields='',$old='')
	{
		$sql = "ALTER TABLE ".$tblname." ";
		if($old){
			$sql .= "DROP INDEX `".$old."`,";
		}
		if(!$fields){
			$fields = $indexname;
		}
		if(is_array($fields)){
			$fields = implode("`,`",$fields);
		}
		$sql .= "ADD INDEX `".$indexname."`(`".$fields."`)";
		return $this->query($sql);
	}

	/**
	 * 删除表字段
	 * @参数 $tblname 表名称
	 * @参数 $id 要删除的字段
	**/
	public function delete_table_fields($tblname,$id)
	{
		$sql = "ALTER TABLE ".$tblname." DROP `".$id."`";
		return $this->query($sql);
	}

	/**
	 * 删除表操作
	 * @参数 $table 表名称，要求带前缀
	 * @参数 $check_prefix 是否加前缀
	**/
	public function delete_table($table,$check_prefix=true)
	{
		if($check_prefix && substr($table,0,strlen($this->prefix)) != $this->prefix){
			$table = $this->prefix.$table;
		}
		$sql = "DROP TABLE IF EXISTS `".$table."`";
		return $this->query($sql);
	}

	/**
	 * 要执行的远程数据
	 * @参数 $sql SQL语句
	 * @参数 $type 类型
	**/
	private function _curl($sql,$type='query')
	{
		$data = array('sql'=>$sql,'exec'=>$type);
		if(!$this->conn || !$this->token){
			$this->connect();
		}
		$this->conn->is_post(true);
		if($this->user && $this->pass){
			$this->conn->user($this->user);
			$this->conn->pass($this->pass);
		}
		$this->token->keyid($this->keycode);
		$this->conn->post_data('token',$this->token->encode($data));
		$info = $this->conn->get_content($this->database);
		if(!$info){
			return false;
		}
		if(substr($info,0,6) == 'error:'){
			$this->error(substr($info,6),'Server');
		}
		return $this->token->decode($info);
	}
}