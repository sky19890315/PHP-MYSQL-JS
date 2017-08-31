<?php

class Test {
	public function __call($functonName, $args) {
		echo "你所调用的函数 \n" . $functonName . "\n 不存在\t";
		echo "输入参数为:\t";
		print_r($args);
	}
	public function say($name) {
		echo "You name is \n " . $name;
	}
}

$t = new Test();
$t->demo('ken', '20');
$t->say('ken');
