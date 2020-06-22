<?php
namespace app\model;

use fillwork\core\Model;

class Item extends Model{
	protected $table = 'patient';

	public function one($id) {
		return $this->where(['id=:id'], [':id'=>$id])->fetch();
	}

	public function all() {
		return $this->where()->fetchAll();
	}
}