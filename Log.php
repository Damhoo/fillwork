<?php
/**
 * @Author: envid
 * @Date:   2020-07-17 16:11:52
 */
// namespace fillwork\core;

// class Log extends Model{
class Log{
	protected $table = 'log';
	protected $pk = 'id';
	protected $union = '';
	private $remark = [
		'login' => "登录了",
		'logout' => "注销登录",
		'delete' => "执行了删除操作",
		'update' => "执行了更新操作",
		'add' => "执行了添加操"
	];

	public function __construct() {
		parent::__construct();

	}

	/**
	 * Log record
	 */
	public function write($info=[], $driver='File', $type='error') {
		$this->unionParam('admin', 'login');
		echo $this->union;
	}

	private function unionParam($handle) {
		if ($user = $_SESSION['user']) {
			$time = date('Y-m-d H:i', time());
			$this->union .= sprintf("%s在 %s %s", $user, $time, $this->remark[$handle]);
		} else {
			$this->union = '出错了！';
		}
	}
}

(new Log)->write();