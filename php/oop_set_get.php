<?php
class people {
	private $name;
	private $age;

	public function __get($propertyName) {
		if (isset($this->$propertyName)) {
			echo "My name is \n" . $this->name . "\n My age is \n" . $this->age . "<br/>";
			return $this->$propertyName;
		}
		return null;
	}

	public function __set($propertyName, $value) {
		// 因为有私有属性才能设值，所以不需要去判断
		echo "本次为 \n" . $propertyName . "\n 赋予新的值 \n" . $value . "<br/>";
		$this->$propertyName = $value;
	}
}

$p = new people();
$p->name = 'ken';
$p->age = '20';
$p->name;
echo "<hr/>";
$p->age;
