<?php
namespace fillwork\data;

use PDO;
use PDOException;

class Db{
	private static $instance = null;
	private $conn = null;
	public $insertId = null;
	public $records = null;

	private $dbConfig = [
		'type' => 'mysql',
		'port' => '3306',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'root',
		'dbname' => 'help',
		'charset' => 'utf8' 
	];

	// 禁止外部实例化
	private function __construct($config) {
		$this->dbConfig = array_merge($this->dbConfig, $config);
		$this->connect();
	}

	// 禁止外部克隆
	private function __clone(){}

	// 连接Database
	private function connect() {
		try{
			$dsn = "{$this->dbConfig['type']}:host={$this->dbConfig['host']};port={$this->dbConfig['port']};dbname={$this->dbConfig['dbname']};charset={$this->dbConfig['charset']}";
			$this->conn = new PDO($dsn, $this->dbConfig['user'], $this->dbConfig['pass']);
			$this->conn->query("SET NAMES {$this->dbConfig['charset']}");
		}catch(PDOException $e) {
			exit('Database connect Failed.'.$e->getMessage());
		}
	}


	// 获取唯一实例
	public static function pdo($config=[]) {
		if (!self::$instance instanceof self) {
			self::$instance = new self($config);
		}
		return self::$instance;
	}


	// 用于CUD功能
	public function exec($sql) {
		$records = $this->conn->exec($sql);

		if ($records > 0) {
			var_dump($this->conn->lastInsertId());
			if (!(null === $this->conn->lastInsertId())) {
				$this->insertId = $this->conn->lastInsertId();
			} else {
				$this->records = $records;
			}
		} else {
			$error = $this->conn->errorInfo();
			exit(nl2br("错误代码: {$error[0]}\r\n错误行号: {$error[1]}\r\n错误信息: {$error[2]}"));
		}
		
	}

	// 用于R功能的查询单记录
	public function fetch($sql) {
		return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
	}

	// 用于R功能的查询多记录
	public function fetchAll($sql) {
		return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}

	// 自动销毁无用连接
	// private function __destruct() {
	// 	$this->conn->close();
	// }
}