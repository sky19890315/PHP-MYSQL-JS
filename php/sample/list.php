<?php
//list的作用是将数组的值赋值给变量
// php7 改为从左到右赋值，其他版本是从右到左
$arr = ['ken','rov','ben'];
list($a,$b,$c)=$arr;
var_dump($a,$b,$c);
//string(3) "ken" string(3) "rov" string(3) "ben" 
// 版本php 7.1
// 操作系统 mac 编辑器 vim

