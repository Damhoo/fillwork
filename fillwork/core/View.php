<?php
namespace fillwork\core;

use fillwork\util\TwigView;

class View extends TwigView{
	protected $_controller = null;
	protected $_action = null;

	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this->_controller = strtolower($controller);
		$this->_action = strtolower($action);
	}

	// 获取模板名
	public function getTemplate($template){
		$view_ext = Config::get('TMPL_EXT');
		if ($template != '') {
			if (strpos($template, '/') !== false) {
				$aTemplate = explode('/', $template);
				$aTemplate = array_filter($aTemplate);
				$controller = $aTemplate[0];
				array_shift($aTemplate);
				$action = $aTemplate ? $aTemplate[0] : $this->_action;
				$template = $controller.'_'.$action;
			}
			$ext_len = strlen($view_ext);
			if(substr($template, -$ext_len) != $view_ext) {
				$template .= $view_ext;
			}
			return $template;
		} else {
			return $this->_controller.'_'.$this->_action.$view_ext;
		}
	}

	// 视图渲染
	public function render($template, $data=[], $return=false) {
		if (Config::get('TMPL_ENGINE')) {
			parent::render($template, $data, $return);
		} else {
			$path = APP_PATH.'/view';
			$template = $this->getTemplate($template);
			// 将变量分配到视图中
			extract($this->data);
			// 默认页头页脚
			$header = $path.'/common/header.php';
			$footer = $path.'/common/footer.php';
			// 控制器的页头页脚
			$_header = $path.'/'.$this->_controller.'_header.php';
			$layout = $path.'/'.$template;
			$_footer = $path.'/'.$this->_controller.'_footer.php';

			// 加载页面
			if (is_file($layout)) {
				// 页头
				is_file($_header) ? include $_header : include $header;
				// 主体内容
				include $layout;
				// 页脚
				is_file($_footer) ? include $_footer : include $footer;
			} else {
				Tool::halt($layout."视图文件不存在！");
			}
		}
	}
}