<?php

class people {
	private $name;
	private $age;

	public function __construct($name = '', $age = '') {
		$this->name = $name;
		$this->age = $age;
		echo "My name is \n" . $this->name . "\n and My age is \n" . $this->age;
	}
}

$p = new people('ken', '20');
