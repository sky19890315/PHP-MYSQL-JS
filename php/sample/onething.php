<?php
class People {
	function say($val){
	echo "He say \n".$val;
	return $this;
	}	
	function go(){
	echo "He go to school";
	return;
	}
}
$boy = new People();
$boy->say('hello')->go();
