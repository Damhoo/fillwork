<?php
namespace fillwork\db;

class Db extends Query {
	// 指定表名
	public static function name($table) {
		$db = new static;
		$db->table = $table;
		return $db;
	}
}