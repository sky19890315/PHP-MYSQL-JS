<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/11/24
 * Time: 下午9:30
 */

class myiter2 implements IteratorAggregate {

	public $property1 = 'Public property one';

	public $property2 = 'Public property two';

	public $property3 = 'Public property three';

	public function __construct()
	{
		$this->property4 = 'last property';
	}

	public function getIterator()
	{
		// TODO: Implement getIterator() method.
		return new ArrayIterator($this);
	}
}

$obj = new myiter2();

foreach ($obj as $key => $value) {
	var_dump($key, $value);
	echo "\r\n";
}
























