<?php
/*
实现以下效果:
首页
-汽车频道
--奥迪
--奔驰
--宝马
-生活频道
--影视娱乐
--荒野求生
---贝尔之怒
*/

// 模拟数据表

$tree = [
['id'=>1, 'name'=>'首页', 'pid' =>0],
['id'=>2, 'name'=>'汽车频道', 'pid'=>1],
['id'=>3, 'name'=>'生活频道', 'pid'=>1],
['id'=>4, 'name'=>'奥迪', 'pid'=>2],
['id'=>5, 'name'=>'奔驰', 'pid'=>2],
['id'=>6, 'name'=>'宝马', 'pid'=>2],
['id'=>7, 'name'=>'影视娱乐', 'pid'=>3],
['id'=>8, 'name'=>'荒野求生', 'pid'=>3],
['id'=>9, 'name'=>'贝尔之怒', 'pid'=>8],
];
// 按照规定 id 不一定为主键 不一定自增
$str = '';
foreach ($tree as $key => $val){
    if($val['pid'] === 0){
            $str .= $val['name'].PHP_EOL;
        }
    if($val['id'] === 2){
        $str .= '-'.$val['name'].PHP_EOL;
        }
	if ($val['pid'] === 2) {
		$str .= '--'.$val['name'].PHP_EOL;
	}
	if ($val['id'] ===3) {
		$str .= '-'.$val['name'].PHP_EOL;
	}
	if ($val['id']===7){
		$str .= '--'.$val['name'].PHP_EOL;
	}
	if ($val['id'] ===8) {
		$str .= '--'.$val['name'].PHP_EOL;
	}
	if ($val['pid']===8) {
		$str .= '---'.$val['name'].PHP_EOL;
	}




    }
    echo "<pre>";
    echo $str;
