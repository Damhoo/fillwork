<?php
namespace fillwork\core;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class TwigView{
	protected $_controller = null;
	protected $_action = null;
	protected $twig;
	protected $config;
	protected $data = [];

	// 读取配置文件twig.php并初始化设置
	public function __construct($controller, $action) {
		$this->_controller = strtolower($controller);
		$this->_action = strtolower($action);

		$this->config['cache_dir'] = Config::get('TMPL_ENGINE_CONFIG')['cache_dir'];
		$this->config['cache'] = Config::get('TMPL_ENGINE_CONFIG')['cache'];
		$this->config['debug'] = Config::get('TMPL_ENGINE_CONFIG')['debug'];
		$this->config['auto_reload'] = Config::get('TMPL_ENGINE_CONFIG')['auto_reload'];
		$this->config['extension'] = Config::get('TMPL_ENGINE_CONFIG')['extension'];

		$loader = new FilesystemLoader(Config::get('TMPL_ENGINE_CONFIG')['template_dir']);
		$this->twig = new Environment($loader, [
			'cache' => $this->config['cache'],
			'debug' => $this->config['debug'],
			'auto_reload' => $this->config['auto_reload'],
		]);
	}

	// 获取模板名
	public function getTemplateName($template){
		$template = trim(strtolower($template), '/');//删除左右“/”
		if ($template != '') {
			if (strpos($template, '/') !== false) {
				$aTemplate = explode('/', $template);
				$aTemplate = array_filter($aTemplate);
				$controller = $aTemplate[0];
				array_shift($aTemplate);
				$action = $aTemplate ? $aTemplate[0] : $this->_action;
				$template = $controller.'_'.$action;
			} else {
				$template .= '_'.$this->_action;
			}
			$ext_len = strlen($this->config['extension']);
			if(substr($template, -$ext_len) != $this->config['extension']) {
				$template .= $this->config['extension'];
			}
			return $template;
		} else {
			return $this->_controller.'_'.$this->_action.$this->config['extension'];
		}
	}

	// 给变量赋值
	public function assign($name, $value=null) {
		if(is_array($name)) {
			foreach($name as $key => $val) {
				$this->data[$key] = $val;
			}
		} else {
			$this->data[$name] = $value;
		}
	}
	

	// 模版渲染
	public function render($template, $data, $return){
		$template = $this->twig->loadTemplate($this->getTemplateName($template));
		$data = array_merge($this->data, $data);
		if ($return === true) {
			return $template->render($data);
		} else {
			return $template->display($data);
		}
	}

	// 字符串渲染
	public function parse($string, $data=[], $return=false){
		$string = $this->twig->loadTemplate($string);
		$data = array_merge($this->data, $data);
		if ($return === true) {
			return $string->render($data);
		} else {
			return $string->display($data);
		}
	}
}