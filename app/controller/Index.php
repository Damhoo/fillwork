<?php
namespace app\controller;

use app\model\Item;
use fillwork\core\Tool;
use fillwork\util\GraphUtil;
use fillwork\core\Log;

class Index extends Base{
	public function index() {
		$res = Log::write([
			'user' => 'admin',
			'message' => '删除了张三患者',
			'handle' => 'add',
		], 'Db');
		echo $res;die;
		$this->render();
	}

	public function tel() {
		$object = new GraphUtil(['type'=>'line','width'=>'400','height'=>'300']);
		$data = [
			['color'=>'red','legend' => 'Nokia','data' => [20,15,23,15,22]],
			['color'=>'blue','legend' => 'Apple','data' => [12,9,42,8,0]],
			['color'=>'green','legend' => 'vivo','data' => [5,17,32,24,100]]	
		];
		$label = range(1, date('t'));
		$object->generateLine($data, $label);
	}

	public function pie() {
		$object = new GraphUtil(['type'=>'graph','width'=>'400','height'=>'300']);
		$object->generatePie([40, 21, 17, 14, 23], 'black');
	}

	public function bar() {
		$object = new GraphUtil([
			'type' => 'bar',
			'width'=>'400',
			'height'=>'300', 
			'gradient' => [
				'width'=>30,
				'side' => '#4B0082',
				'mide' => 'white',
			]
		]);
		$ytick = [
			'y1' => array_map(function($var) {
				return $var*15;
			}, range(1, 10))
		];
		$object->generateBar([62,105,85,50], 'white', $ytick, ['A', 'B', 'C', 'D']);
	}
}