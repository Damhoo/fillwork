<?php
namespace app\controller;

use fillwork\core\Tool;

class Api extends Base{
	public function login() {
		if ($this->isPost()) {
			Tool::dump($this->request);
		}
		$this->assign('title', '会员登录');
		$this->render();
	}
}