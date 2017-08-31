<?php
interface people {
	// 走的方法
	public function walk();
	// 名字
	public function name($name);
}

class student implements people {
	public function walk() {
		echo "学生一步的跨度是0.3米；" . "<br/>";
		return $this;
	}

	public function name($val) {
		echo "这个学生的名字是：" . $val;
		return $this;
	}
}

$student = new student();

$student->walk()->name('ken');
