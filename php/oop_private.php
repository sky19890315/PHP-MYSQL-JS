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

	public function __isset($propertyName) {
		return isset($this->$propertyName);
	}

	public function __unset($propertyName) {
		echo '删除属性' . "\n" . $propertyName . "\n的值";
		unset($this->$propertyName);
		return;
	}
}

$test = new Test();
$test->$name = 'ken';
echo $test->$name; // ken
$test->__unset($name);
echo $test->$name;
// 之所以做这个测试，是因为看到深入理解yii2.0里，作者认为只有设置为共有属性，才能使用
// 魔术方法赋值
// 在整个yii框架中，经常通过魔术方法进行依赖注入，控制反转等，
// 利用了很多面向对象的编程思想
