<?php
namespace fillwork\core;

!defined('XDE') && exit('Access Denied');

use fillwork\core\Tool;
use Exception;

final class App{
	// 保存URL参数
	private static $param = [];
	private static $controllerName = '';
	private static $actionName = '';

	public static function run() {
		// 初始化应用
		self::_init();
		// 捕获一般错误
		set_error_handler([__CLASS__, '_error']);
		// 捕获致命错误
		register_shutdown_function([__CLASS__, '_fatal_error']);
		// 过滤参数
		self::_get_param();
		// 设置外部路径/时区/SESSION
		self::_set_outlink();
		// 执行路由
		self::_route();
		// 创建DEMO
		self::_create_demo();
	}


	// 初始化应用
	private static function _init() {
		// 加载系统配置文件
		Config::get(include CONFIG_PATH.'/config.php');
		// 加载公共模块配置文件
		$config_data = file_get_contents(DATA_PATH.'/config.txt');
		$common_config_path = APP_CONFIG_PATH.'/config.php';
		is_file($common_config_path) || file_put_contents($common_config_path, $config_data);
		Config::get(include APP_CONFIG_PATH.'/config.php');
		// 加载应用模块配置文件
		$user_config_path = APP_COMMON_CONFIG_PATH.'/config.php';
		is_file($user_config_path) || file_put_contents($user_config_path, $config_data);
		Config::get(include APP_COMMON_CONFIG_PATH.'/config.php');

		// 设置默认时区
		date_default_timezone_set(Config::get('DEFAULT_TIMEZONE'));

		// 开启session
		Config::get('SESSION_AUTO_START') && session_start();
	}

	// 捕获一般错误
	public static function _error($errno, $errmsg, $errfile, $errline) {
		switch ($errno) {
			case E_NOTICE:
			case E_USER_ERROR:
			case E_USER_WARNING:
			case E_USER_NOTICE:
			case E_USER_DEPRECATED:
			case E_COMPILE_WARNING:
			case E_COMPILE_ERROR:
				Tool::tip($errmsg, $errfile, $errline);
				break;

			case E_PARSE:
			case E_ERROR:
			case E_STRICT:
			case E_WARNING:
			case E_CORE_ERROR:
			case E_CORE_WARNING:
			case E_COMPILE_ERROR:
			case E_COMPILE_WARNING:
			default:
				Tool::halt($errmsg);
				break;
		}
	}

	// 捕获致命错误
	public static function _fatal_error() {
		if ($e = error_get_last()) {
			self::_error($e['type'], $e['message'], $e['file'], $e['line']);
		}
	}

	private static function _strip_slashes($value) {
		$value = is_array($value) ? array_map([__CLASS__, '_strip_slashes'], $value) : stripslashes($value);
		return $value;
	}

	// 删除敏感字符
	private static function _get_param($var=[]) {
		if (!empty($var)) {
			return self::_strip_slashes($var);
		} else {
			$_GET = isset($_GET) ? self::_strip_slashes($_GET) : '';
			$_POST = isset($_POST) ? self::_strip_slashes($_POST) : '';
			$_COOKIE = isset($_COOKIE) ? self::_strip_slashes($_COOKIE) : '';
			$_SESSION = isset($_SESSION) ? self::_strip_slashes($_SESSION) : '';
		}
	}

	// 默认设置
	private static function _set_outlink() {
		$protocol = preg_match('/https/i', $_SERVER['SERVER_PROTOCOL']) ? 'https://' : 'http://';
		$path = $protocol.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
		define('__APP__', $path);
		define('__ROOT__', dirname($path));
		define('__STATIC__', __ROOT__.'/static');
	}

	// 路由功能
	private static function _route() {
		// 从配置文件中获取默认控制器名和方法名
		self::$controllerName = Config::get('DEFAULT_CONTROLLER');
        self::$actionName = Config::get('DEFAULT_ACTION');

        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');// 清除?之后的内容
        $url = $position === false ? $url : substr($url, 0, $position);
        $url = trim($url, '/');// 删除前后的“/”

        if ($url) {
            $aUrl = explode('/', $url);// 使用“/”分割字符串，并保存在数组中
            $aUrl = array_filter($aUrl);// 删除空的数组元素
            
            self::$controllerName = ucfirst($aUrl[0]);// 获取控制器名
            array_shift($aUrl);// 获取控制器方法名
            self::$actionName = $aUrl ? $aUrl[0] : self::$actionName;
            array_shift($aUrl);// 获取URL参数
            self::$param = $aUrl ? self::_get_param($aUrl) : [];
        }
	}

	// 创建DEMO
	private static function _create_demo() {
		$action = self::$actionName;
		$controller = self::$controllerName;
		// 判断示例控制器是否存在
		if (self::$controllerName == 'Index') {
			$controller = 'app\\controller\\'.$controller;
			if (!class_exists($controller)) {
				// 判断默认控制器是否存在，不存在则创建
				$path = APP_CONTROLLER_PATH.'/Index.php';
				$controller_data = file_get_contents(DATA_PATH.'/controller.txt');
				is_file($path) || file_put_contents($path, $controller_data);
			}
		} else {
			// 示例控制器之外的控制器是否存在
			$controller = 'app\\controller\\'.$controller;
			if (!class_exists($controller)) {
			    exit($controller . '控制器不存在');
			}
			if (!method_exists($controller, $action)) {
			    exit($action . '方法不存在');
			}
		}
		$dispatch = new $controller(self::$controllerName, $action);
		$dispatch->$action(self::$param);
		/**
		 * 不能通过call_user_func_array来传入参数，因在控制器中无法获取参数数组
		 * call_user_func_array([$dispatch, $action], self::$param);
		 * 使用映射类来实例化应用控制器（无命名空间）
		 * $class = new ReflectionClass($controller);
		 * $instance = $class->newInstanceArgs(self::$param);
		 * $method = $class->getMethod($action);
		 * $method->invoke($instance);
		 * 问题：如果使用映射类来实例化，将如何实现呢？
		*/
	}

}