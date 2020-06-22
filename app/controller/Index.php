<?php
namespace app\controller;

use fillwork\core\Controller;
use fillwork\core\Tool;
use app\model\Item;

class Index extends Controller{
	public function index() {
		$lists = (new Item())->all();
		$this->assign('patients', $lists);
		$this->render();
	}
}