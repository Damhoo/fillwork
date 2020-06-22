<?php
namespace fillwork\core;

use fillwork\db\Sql;

class Model extends Sql{

	protected $model = null;

	public function __construct() {
		parent::__construct();
		// 获取数据库表名，如未定义，则根据模型名获取
		if (!$this->table) {
			// 获取模型类名称
			$this->model = get_class($this);
			// 数据表名与类名一致
			$this->table = strtolower($this->model);
		}
	}
}