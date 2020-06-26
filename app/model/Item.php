<?php
namespace app\model;

use fillwork\core\Model;

class Item extends Model {
	protected $table = 'user';
	protected $pk = 'id';

	public function one($id) {
		return $this->where(['id=:id'], [':id'=>$id])->fetch();
	}

	public function all() {
		return $this->field(['id','user','name','passwd'])->order(['id desc'])->fetchAll();
	}
}