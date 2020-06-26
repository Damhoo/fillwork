<?php
namespace fillwork\db;

use PDO;
use PDOException;

final class Db{
	private static $pdo = null;
	private static $dbConfig = [
		'type' => 'mysql',
		'port' => '3306',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'dbname' => '',
		'charset' => 'utf8'
	];

	// 禁止外部实例化
	final private function __construct(){}

	final private function __clone(){}

    public static function pdo($config=[]){
    	self::$dbConfig = array_merge(self::$dbConfig, $config);
    	if (self::$pdo instanceof self) return self::$pdo;
        try {
            $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', self::$dbConfig['type'], self::$dbConfig['host'], self::$dbConfig['port'], self::$dbConfig['dbname'], self::$dbConfig['charset']);
            $option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
            self::$pdo = new PDO($dsn, self::$dbConfig['user'], self::$dbConfig['pass'], $option);
            self::$pdo->query("SET NAMES ".self::$dbConfig['charset']."");
            return self::$pdo;
        } catch (PDOException $e) {
        	exit(nl2br("Database connect Failed.\r\n".$e->getMessage()));
        }
    }
}