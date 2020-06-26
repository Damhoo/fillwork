<?php
namespace fillwork\core;

final class Log{
	final private function __construct() {}
	final private function __clone() {}

	// 写入日志
	public static function write($msg, $level='ERROR', $type=3, $dest) {
		if(!Config::get('LOG_START')) return;
		$logPath = Config::get('LOG_PATH');
		if (is_null($dest)) {
			$dest = $logPath.'/'.date('Y_m_d').'.log';
		}

		if (is_dir($logPath)) error_log('[time]: '.$msg, $type, $dest);
	}
}