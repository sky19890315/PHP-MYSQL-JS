<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/12/9
 * Time: 下午11:28
 */
/**
 * 今天碰到一个警告级别的错误 Warning: filectime(): stat failed for path
   这使我认识到 在 if 条件中 判断的顺序是依次进行的 当我把文件判断放在最前边
 * 就完美的结局了 filectime 警告级别 因为对于一开始 缓存文件并不存在
 * 所以以后对文件判断需要排好顺序
 */


$cache_name = md5(__FILE__).'.html';
$cache_life_time = 1800;

if (file_exists($cache_name) && filectime(__FILE__) <= filectime($cache_name) &&
	 filectime($cache_name) + $cache_life_time > time()) {
	include $cache_name;
	exit('读取缓存');
}


ob_start();

?>

<b>this is a test!111</b>

<?php

$content = ob_get_contents();

ob_flush();

$handle = fopen($cache_name, 'w');

fwrite($handle, $content);

fclose($handle);