<?php

function printer() {
	while (true) {
		$string = yield;
		echo $string;
	}
}

$printer = printer();

$printer->send('hello ken');