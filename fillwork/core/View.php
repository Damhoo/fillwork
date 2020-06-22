<?php
namespace fillwork\core;

class View{
	protected $vars = null;
	protected $_controller = null;
	protected $_action = null;

	public function __construct($controller, $action) {
		$this->_controller = strtolower($controller);
		$this->_action = strtolower($action);
	}

	public function assign($name, $value) {
		$this->vars[$name] = $value;
	}

	public function render($view) {
		$view = trim($view);
		if ($view != '') {
			$view = strtolower($view);
			if (strpos($view, '/') !== false) $view = explode('/', $view);
			if (is_array($view)) {
				$aView = array_filter($view);
				$controller = $aView[0];
				array_shift($aView);
				$action = $aView ? $aView[0] : $this->_action;
			}
		} else {
			$controller = str_replace('\\', '/',strtolower($this->_controller));
			$action = $this->_action;
		}

		// 将变量分配到视图中
		extract($this->vars);
		// 默认页头页脚
		$default_header = APP_PATH.'/view/common/header.php';
		$default_footer = APP_PATH.'/view/common/footer.php';
		// 控制器的页头页脚
		$app_header = APP_PATH.'/view/'.$controller.'/header.php';
		$app_layout = APP_PATH.'/view/'.$controller.'/'.$action.'.php';
		$app_footer = APP_PATH.'/view/'.$controller.'/footer.php';

		// 加载页面
		if (is_file($app_layout)) {
			// 页头
			is_file($app_header) ? include $app_header : include $default_header;
			// 主体内容
			include $app_layout;
			// 页脚
			is_file($app_footer) ? include $app_footer : include $default_footer;
		} else {
			Tool::halt($action.".php视图文件不存在！");
		}
	}
}