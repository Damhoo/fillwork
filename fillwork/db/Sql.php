<?php
namespace fillwork\db;

use \PDOStatement;
use fillwork\core\Config;

class Sql{
	protected $table = 'log';// 表名
	protected $pk = 'id';// 默认主键
	private $filter = '';// where和order拼装后的条件
	private $field = '';
	private $param = []; // PDO bindParam()绑定的参数集合
	public $pdo;
	static public $link;

	public function __construct() {
		self::$link = $this->pdo = Db::pdo([
			'type' => Config::get('DATABASE')['TYPE'],
			'port' => Config::get('DATABASE')['PORT'],
			'host' => Config::get('DATABASE')['HOST'],
			'user' => Config::get('DATABASE')['USER'],
			'pass' => Config::get('DATABASE')['PASSWORD'],
			'dbname' => Config::get('DATABASE')['DBNAME'],
			'charset' => Config::get('DATABASE')['CHARSET']
		]);
	}

	/**
     * 查询条件拼接，使用方式：
     *
     * $this->where(['id = 1','and title="Web"', ...])->fetch();
     * 为防止注入，建议通过$param方式传入参数：
     * $this->where(['id = :id'], [':id' => $id])->fetch();
     *
     * @param array $where 条件
     * @return $this 当前对象
     */
	public function where($where=[], $param=[]) {
		if (!empty($where)) {
			$this->filter .= ' WHERE ';
			$this->filter .= implode(' ', $where);
			$this->param = $param;
		}

		return $this;
	}

	// 查询指定字段
	// 使用方法$this->field(['id','name','age'])->where([..])->fetch();
	public function field($field=[]) {
		if (!empty($field)) {
			$field = array_map(function($name){return "`$name`";}, $field);
			$this->field .= implode(',', $field);
		} else {
			$this->field = '*';
		}

		return $this;
	}

	/**
	 * LIMIT分页，使用方式：
	 * $this->limit([0, 20])->fetch();
     * @param array $limit 条件
     * @return $this 当前对象
	*/
	public function limit($limit=[], $param=[]) {
		if (!empty($limit)) {
			$this->filter .= ' LIMIT ';
			$this->filter .= implode(',', $limit);
			$this->param = $param;
		}
		
		return $this;
	}

	/**
     * 拼装排序条件，使用方式：
     *
     * $this->order(['id DESC', 'title ASC', ...])->fetch();
     *
     * @param array $order 排序条件
     * @return $this
     */
	public function order($order=[]) {
		if (!empty($order)) {
			$this->filter .= ' ORDER BY ';
			$this->filter .= implode(' ', $order);
		}
		return $this;
	}

	/**
     * 占位符绑定具体的变量值
     * @param PDOStatement $sth 要绑定的PDOStatement对象
     * @param array $params 参数，有三种类型：
     * 1）如果SQL语句用问号?占位符，那么$params应该为[$a, $b, $c]
     * 2）如果SQL语句用冒号:占位符，那么$params应该为
     *    ['a' => $a, 'b' => $b, 'c' => $c]
     *    或
     *    [':a' => $a, ':b' => $b, ':c' => $c]
     * @return PDOStatement
     */
	private function formatParam(PDOStatement $sth, $params=[]) {
		foreach ($params as $param => &$value) {
			$param = is_int($param)?$param+1:':'.ltrim($param, ':');
			$sth->bindParam($param, $value);
		}
		return $sth;
	}

	// 格式化添加数据
	private function formatInsert($data=[]) {
		$fields = [];
		$names = [];
		foreach ($data as $key => $value) {
			$fields[] = sprintf("`%s`", $key);
			$names[] = sprintf(":%s", $key);
		}

		$field = implode(',', $fields);
		$name = implode(',', $names);

		return sprintf("(%s) VALUES (%s)", $field, $name);
	}

	// 格式化更新数据
	private function formatUpdate($data) {
		$fields = [];
		foreach ($data as $key => $value) {
			$fields[] = sprintf("`%s`=%s", $key, $key);
		}

		return implode(',', $fields);
	}

	// 查询一条
	public function fetch() {
		$sql = sprintf("SELECT %s FROM `%s` %s", $this->field, $this->table, $this->filter);
		$sth = Db::pdo()->prepare($sql);
		$sth = $this->formatParam($sth, $this->param);
		$sth->execute();

		return $sth->fetch();
	}

	// 查询所有
	public function fetchAll() {
		$sql = sprintf("SELECT %s FROM `%s` %s", $this->field, $this->table, $this->filter);
		$sth = $this->pdo->prepare($sql);
		$sth = $this->formatParam($sth, $this->param);
		$sth->execute();

		return $sth->fetchAll();
	}

	// 新增数据
	public function insert($data) {
		$sql = sprintf("INSERT INTO `%s` %s", $this->table, $this->formatInsert($data));
		$sth = $this->pdo->prepare($sql);
		$sth = $this->formatParam($sth, $data);
		$sth = $this->formatParam($sth, $this->param);
		$sth->execute();

		return $sth->rowCount();
	}

	// 更新数据
	public function update($data) {
		$sql = sprintf("UPDATE `%s` SET %s %s", $this->table, $this->formatUpdate($data), $this->filter);
		$sth = $this->pdo->prepare($sql);
		$sth = $this->formatParam($sth, $data);
		$sth = $this->formatParam($sth, $this->param);
		$sth->execute();

		return $sth->rowCount();
	}

	// 删除数据
	public function delete($id) {
		$sql = sprintf("DELETE FROM `%s` WHERE `%s`=%s", $this->table, $this->pk, $this->pk);
		$sth = $this->pdo->prepare($sql);
		$sth = $this->formatParam($sth, [$this->pk => $id]);
		$sth->execute();

		return $sth->rowCount();
	}


	// 软删除，使用方式：
	// $this->softDelete(1, ['deleted=1', 'delete_time=time()']);
	// 防止注入，使用绑定参数形式
	// $this->softDelete(1, ['deleted=:deleted', 'delete_time=:delete_time']);
	public function softDelete($id, $data) {
		$sql = sprintf("UPDATE `%s` SET %s WHERE `%s`=%s", $this->table, $this->formatUpdate($data), $this->pk, $this->pk);
		$sth = $this->pdo->prepare($sql);
		$sth = $this->formatParam($sth, $data);
		$sth = $this->formatParam($sth, $this->param);
		$sth->execute();

		return $sth->rowCount();
	}
}