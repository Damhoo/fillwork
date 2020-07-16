<?php
namespace app\controller;

class Api extends Base{
	public function login() {
		if ($this->isPost()) {
			var_dump($_POST);
		}
		$this->assign('title', '会员登录');
		$this->render();
	}
}