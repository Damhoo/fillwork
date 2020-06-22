<?php
namespace fillwork;

!defined('XDE') && exit('Access Denied');

use fillwork\core\App;

final class Fillphp{
	public function run() {
		// 引入核心文件
		spl_autoload_register([__CLASS__, '_load_class']);
		// 环境检查
		self::_set_reporting();
		// 定义常量
		self::_define_const();
		// 创建APP文件夹
		self::_create_folder();
		// 执行APP应用类
		App::run();
	}

	// 调试功能
	private static function _set_reporting() {
		if (APP_DEBUG === true) {
			error_reporting(E_ALL);
		} else {
			error_reporting(0);
		}
	}

	// 定义框架和应用常量
	private static function _define_const() {
		$path = str_replace('\\', '/', __FILE__);
		// 框架常量
		define('SYS_PATH', dirname($path));
		define('CORE_PATH', SYS_PATH.'/core');
		define('CONFIG_PATH', SYS_PATH.'/config');
		define('DB_PATH', SYS_PATH.'/db');
		define('DATA_PATH', SYS_PATH.'/data');
		define('TPL_PATH', DATA_PATH.'/tpl');

		// APP前台常量
		define('ROOT_PATH', dirname(SYS_PATH));
		define('APP_PATH', ROOT_PATH.'/app');
		define('APP_CONTROLLER_PATH', APP_PATH.'/controller');
		define('APP_MODEL_PATH', APP_PATH.'/model');
		define('APP_VIEW_PATH', APP_PATH.'/view');
		define('APP_VIEW_COMMON_PATH', APP_VIEW_PATH.'/common');
		define('APP_CONFIG_PATH', APP_PATH.'/config');

		// APP公共常量
		define('APP_COMMON_PATH', APP_PATH.'/common');
		define('APP_COMMON_MODEL_PATH', APP_COMMON_PATH.'/model');
		define('APP_COMMON_CONFIG_PATH', APP_COMMON_PATH.'/config');
	}

	// 创建APP文件夹
	private static function _create_folder() {
		$folders = [
			APP_CONTROLLER_PATH,
			APP_MODEL_PATH,
			APP_VIEW_PATH,
			APP_VIEW_COMMON_PATH,
			APP_CONFIG_PATH,
			APP_COMMON_PATH,
			APP_COMMON_MODEL_PATH,
			APP_COMMON_CONFIG_PATH
		];

		foreach ($folders as $folder) {
			is_dir($folder) || mkdir($folder, 0777, true);
		}
		$errFile = APP_VIEW_PATH.'/common/error.php';
		$sucFile = APP_VIEW_PATH.'/common/success.php';
		is_file($errFile) || copy(TPL_PATH.'/error.php', $errFile);
		is_file($sucFile) || copy(TPL_PATH.'/success.php', $sucFile);
	}

	// 引入核心类文件
	private static function _load_class($className) {
		$classMap = self::_class_map();

	    if (isset($classMap[$className])) {
	    	// 引入框架类文件
	        $file = $classMap[$className];
	    } else if (strpos($className, '\\') !== false) {
	    	// 引入应用类文件
	        $file = ROOT_PATH.'/'.str_replace('\\', '/', $className).'.php';
	        if(!is_file($file)){return;};
	    } else {
	        return;
	    }
	    include $file;
	}


	// 内核文件命名空间映射关系
    private static function _class_map(){
        return [
        	'fillwork\core\Tool' => CORE_PATH.'/Tool.php',
        	'fillwork\core\Config' => CORE_PATH.'/Config.php',
        	'fillwork\db\Db' => DB_PATH.'/Db.php',
        	// 'fillwork\data\Db' => DATA_PATH.'/Db.php',
        	'fillwork\db\Sql' => DB_PATH.'/Sql.php',
        	'fillwork\core\Model' => CORE_PATH.'/Model.php',
        	'fillwork\core\App' => CORE_PATH.'/App.php'
        ];
    }
}