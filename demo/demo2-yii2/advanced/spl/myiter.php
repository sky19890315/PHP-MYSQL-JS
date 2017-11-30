<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/11/24
 * Time: 下午8:13
 */

class myiter implements Iterator {

	private $position = 0;
	private $array = [
		"firstElement",
		"secondElement",
		"lastElement",
	];

	public function __construct()
	{
		$this->position = 0;
	}

	function rewind()
	{
		// TODO: Implement rewind() method.
		var_dump(__METHOD__);
		$this->position = 0;
	}

	function current()
	{
		// TODO: Implement current() method.
		var_dump(__METHOD__);
		return $this->array[$this->position];
	}

	function key()
	{
		// TODO: Implement key() method.
		var_dump(__METHOD__);
		return $this->position;
	}

	function next()
	{
		// TODO: Implement next() method.
		var_dump(__METHOD__);
		++$this->position;
	}

	function valid()
	{
		// TODO: Implement valid() method.
		var_dump(__METHOD__);
		return isset($this->array[$this->position]);
	}
}

$it = new myiter();

foreach ($it as $key => $value) {
	var_dump($key, $value);
	echo "\n\r";
}





















