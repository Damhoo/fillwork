<?php
namespace fillwork\core;

class Controller {
	protected $_controller = null;
	protected $_action = null;
	protected $_view = null;

	// 初始化参数并实例化对应视图模型
	public function __construct($controller, $action) {
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_view = new View($controller, $action);
	}

	// 分配变量
	public function assign($name, $value) {
		$this->_view->assign($name, $value);
	}

	// 渲染视图
	public function render($view='') {
		$this->_view->render($view);
	}

	// 成功提示
	public function success($msg, $url='', $time=3) {
		$url = ($url != '') ? 'location.href="'.$url.'"' : 'history.go(-1)';
		include APP_VIEW_PATH.'/common/success.php';
	}

	// 错误提示
	public function error($msg, $url='', $time=3) {
		$url = ($url != '') ? 'location.href="'.$url.'"' : 'history.go(-1)';
		include APP_VIEW_PATH.'/common/error.php';
	}
}