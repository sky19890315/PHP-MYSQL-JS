<?php
/**
 *
 * @authors ken
 * @date    2017-09-07 20:33:19
 * @version 1
 *
 * 面向对象编程思想，通过依赖注入实现控制反转
 * 这个例子是以人类来做一个解释
 * 1 人必须要实现人类这个接口
 * 2 通过注入人这个类，可以实现男人和女人的不同区别
 */
interface InterfaceHuman {
	/**
	 * 每个人都有名字
	 * @param [type] $name [description]
	 */
	public function setName($name);

	/**
	 * 每个人都有年龄
	 * @param [type] $age [description]
	 */
	function setAge($age);

	/**
	 * 这个是女人的特性，爱男人
	 */
	function setLoveMan();

	/**
	 * 这是男人的特性，爱女人
	 */
	function setLoveWoman();
}

/**
 * 人类这个类，实现人类接口
 */
class Human implements InterfaceHuman {
	function setName($name) {
		echo "\t name is \t" . $name;
		echo "\n";
		return;
	}
	function setAge($age) {
		echo "\t age is \t" . $age;
		echo "\n";
		return;
	}

	function setLoveMan() {
		echo "She love man";
		echo "\n";
		return;
	}

	function setLoveWoman() {
		echo "He love girl";
		echo "\n";
		return;
	}
}

/**
 * 共同父类
 */
class People {
	private $_human;

	public function __construct($human) {
		$this->_human = $human;
	}

}
/**
 * 男人
 */
class Man {
	private $_human;
	public function __construct($human) {
		$this->_human = $human;
		return;
	}

	public function getMan($name, $age) {
		$this->_human->setName($name);
		$this->_human->setAge($age);
		$this->_human->setLoveWoman;
	}
}

// 依赖注入 实现男人
$man = new Man(new Human);
$man->getMan('ken', 18);
echo "<hr/>";

/**
 * 女人
 */
class Woman {
	private $_human;
	public function __construct($human) {
		$this->_human = $human;
		return;
	}

	public function getWoman($name, $age) {
		$this->_human->setName($name);
		$this->_human->setAge($age);
		$this->_human->setLoveMan;
	}
}
// 依赖注入 实现女人
$woman = new Woman(new Human);
$woman->getWoman('kathy', 16);
