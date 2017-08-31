<?php
// 通过依赖注入实现控制反转
class People {
	public function say() {
		echo "My method is \n" . __METHOD__, "\t";
	}
}

class Man {
	private $people;

	public function __construct(People $people) {
		$this->people = $people;
	}

	public function say() {
		$this->people->say();
		echo __METHOD__, "\t";
	}

}

class Father {
	private $man;

	public function __construct(Man $man) {
		$this->man = $man;
	}

	public function say() {
		$this->man->say();
		echo __METHOD__, "\t";
	}
}

$father = new Father(new Man(new People()));
$father->say();
