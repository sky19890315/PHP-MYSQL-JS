<?php
/**
 *
 * @authors ken (296675685@qq.com)
 * @date    2017-09-09 10:47:00
 * @version $Id$
 */

interface Shape {
	public function draw();
}

class Circle implements Shape {
	private $_color;
	private $_x;
	private $_y;
	private $_radius;

	function __construct($color) {
		$this->_color = $color;
		return;
	}

	function setX($x) {
		$this->_x = $x;
		return;
	}

	function setY($y) {
		$this->_y = $y;
		return;
	}

	function setRadius($radius) {
		$this->_radius = $radius;
		return;
	}

	function draw() {
		echo "Circle: \n color\n" . $this->_color . "\n x: \n" . $this->_x . "\n y: \n" . $this->_y . "\n radius: \n" . $this->_radius;
		return;
	}
}

//@todo 暂时没有思路
