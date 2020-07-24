<?php
namespace fillwork\db;

use PDO;
use PDOException;

final class Sql{
	private static $pdo = null;
	private static $_config = [
		'type' => 'mysql',
		'port' => '3306',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'root',
		'dbname' => 'help',
		'charset' => 'utf8'
	];

	// 禁止外部实例化
	final private function __construct(){}
	final private function __clone(){}

    public static function pdo($config=[]){
    	self::$_config = array_merge(self::$_config, $config);
    	if (static::$pdo instanceof static) return static::$pdo;
        try {
            $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', self::$_config['type'], self::$_config['host'], self::$_config['port'], self::$_config['dbname'], self::$_config['charset']);
            $option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
            self::$pdo = new PDO($dsn, self::$_config['user'], self::$_config['pass'], $option);
            self::$pdo->query("SET NAMES ".self::$_config['charset']."");
            return self::$pdo;
        } catch (PDOException $e) {
        	exit(nl2br("Database connect Failed.\r\n".$e->getMessage()));
        }
    }
}