<?php
/**
 * @Author: envid
 * @Date:   2020-07-17 16:11:52
 */
namespace fillwork\core;

use fillwork\db\Db;

class Log {
	static private $info = [
		'message' => '出错了！',
		'level' => 'ERROR',
		'type' => 3,
		'dest' => null
	];
	static private $remark = [
		'login' => "登录了",
		'logout' => "注销登录",
		'delete' => "删除操作",
		'update' => "更新操作",
		'add' => "添加操作"
	];

	final private function __construct(){}
	final private function __clone(){}

	/**
	 *写入日志
	 */
	static public function write($infomation=[], $driver='File') {
		self::$info = array_merge(self::$info, $infomation);
		if ($driver=='File') {
			if(!Config::get('LOG_START')) return;
			$logPath = Config::get('LOG_PATH');
			is_null(self::$info['dest']) && $dest = $logPath.'/'.date('Y_m_d').'.log';
			$msg = sprintf('[datetime]: %s', self::$info['message']);
			is_dir($logPath)&&error_log($msg, self::$info['type'], $dest);
		} else {
			// 数据库记录
			$ip = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$_SERVER['X-REAL-IP'];
			$msg = sprintf('%s 在 %s %s', self::$info['user'], date('Y-m-d H:i', time()), self::$info['message']);
			var_dump(Db::name('log')->insert([
				'handle' => self::$remark[self::$info['handle']],
				'remark' => $msg,
				'user' => self::$info['user'],
				'ip' => $ip,
				'create_time' => time()
			]));
			
		}
	}

	// 清除日志
	static public function clear() {
		$path = Config::get('LOG_PATH');
		if (is_dir($path)) $fh = opendir($path);
		while (false !== ($filename = readdir($fh))) {
			unlink($filename);
		}
		closedir($fh);
		return true;
	}
}