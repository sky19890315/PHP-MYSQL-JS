<?php

//测试私有属性能不能通过魔术方法进行赋值

class Test {
	private $name;

	public function __get($propertyName) {
		if (isset($this->$propertyName)) {
			return $this->$propertyName;
		}
		return null;
	}

	public function __set($propertyName, $value) {
		$this->$propertyName = $value;
		return;
	}
}

$test = new Test();
$test->__set($name, 'ken');
echo $test->__get($name); // ken
// 之所以做这个测试，是因为看到深入理解yii2.0里，作者认为只有设置为共有属性，才能使用
// 魔术方法赋值
// 在整个yii框架中，经常通过魔术方法进行依赖注入，控制反转等，
// 利用了很多面向对象的编程思想
