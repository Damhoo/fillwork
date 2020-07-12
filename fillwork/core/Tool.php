<?php
namespace fillwork\core;

class Tool{
	public static function dump($var) {
		if (is_string($var)) {
			echo $var;
		} else if ((is_array($var) && !empty($var)) || is_object($var)) {
			echo '<pre>';print_r($var);echo '</pre>';
		} else {
			var_dump($var);
		}
	}

	// halt函数
	public static function halt($error, $level='ERROR', $type=3, $dest='') {
		if (is_array($error)) {
			Log::write($error['message'], $level, $type, $dest);
		} else {
			Log::write($error, $level, $type, $dest);
		}

		$e = [];
		if (APP_DEBUG) {
			if (!is_array($error)) {
				$trace = debug_backtrace();
				$e['message'] = $error;
				$e['file'] = $trace[0]['file'];
				$e['line'] = $trace[0]['line'];
				$e['class'] = isset($trace[0]['class']) ? $trace[0]['class'] : '';
				$e['function'] = isset($trace[0]['function']) ? $trace[0]['function'] : '';
				ob_start();
				debug_print_backtrace();
				$e['trace'] = htmlspecialchars(ob_get_clean());
			} else {
				$e = $error;
			}
		} else {
			if ($url = Config::get('ERROR_URL')) {
				Tool::go($url);
			} else {
				$e['message'] = Config::get('ERROR_MSG');
			}
		}
		include TPL_PATH.'/halt.php';
		die;
	}

	// 普通错误提示
	public static function tip($errmsg, $errfile, $errline) {
		if (APP_DEBUG) {
			include TPL_PATH.'/notice.php';
			die;
		} else {
			self::halt($errmsg);
		}
	}

	// 跳转函数
	public static function go($url, $time=0, $msg='') {
		if (!headers_sent()) {
			$time == 0 ? header("Location: {$url}") : header("refresh:{$time};url={$url}");
			die($msg);
		} else {
			echo "<meta http-equiv='Refresh' content='{$time};url={$url}'>";
			if ($time) die($msg);
		}
	}

	// each
	public static function _each(&$arr){
	   $_tmp = [];
	   $key = key($arr);
	   if($key !== null){
	       next($arr); 
	       $_tmp[1] = $_tmp['value'] = $arr[$key];
	       $_tmp[0] = $_tmp['key'] = $key;
	   }else{
	       $_tmp = false;
	   }
	   return $_tmp;
	}
}