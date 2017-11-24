<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/11/22
 * Time: 下午11:28
 */
class filter {
	// 数据集
	private $_data = [];

	public function run($file = null) {

		if (!$file) {
			return "File Can't Empty!";
		}
		// 打开文件句柄
		$rFile = fopen($file,'r');

		if (!is_resource($rFile)) {
			return "File Is Illegal!";
		}

		while (!feof($rFile)) {

			$currentLine = trim(fgets($rFile));

			if (self::_len12($currentLine) && self::_cnaps($currentLine)) {
				$key = (int)substr($currentLine,0,3);
				$this->_data[$key][$currentLine] = null;
			}
		}

		fclose($rFile);

	}

	/**
	 * @desc 只处理长度超过12的字符
	 * @param $str
	 * @return bool
	 */
	static private function _len12($str){
		return strlen($str < 12) ? false : true;
	}

	/**
	 * @desc cnaps 算法
	 * @param $str
	 * @return bool
	 */
	static private function _cnaps($str){
		$len = strlen($str);
		$p = 10;
		for ($i=0;$i<$len-1;$i++) {
			$number = (int)$str[$i];
			$p = (($n=($p+$number)%10)?: 10)*2%11;
		}

		$p = $p < 2 ? 1 - $p : 11 - $p;
		return $p == $str[$len-1] ? true : false;
	}

	/**
	 * @des 排序
	 * @return string
	 */
	public function setSort(){

		$rst = '';

		if (!$this->_data) {
			return "Data Can't Be Null!";
		}

		ksort($this->_data);

		foreach ($this->_data as $key => $value) {

			$value = array_keys($value);

			usort($value,"self::_second_sort");

			unset($this->_data[$key]);

			while ($row = array_shift($value)) {
				$rst ? $rst .= "\n$row" : $rst .= $row;// 经典三目运算
			}
		}

		$file = sha1($rst);

		file_put_contents($file,$rst);

	}

	/**
	 * 二次排序
	 * @param $a
	 * @param $b
	 * @return int
	 */
	static private function _second_sort($a,$b) {
		$first = substr($a, 3,4);
		$second = substr($b,3,4);
		if ($first == $second) {
			return 0;
		}
		return ($first < $second) ? -1 : 1;
	}
}

// 运行观察
$startTime = microtime(true);

$filter = new filter();

$filter->run('data.xz');

$filter->setSort();

$endTime = microtime(true);

echo 'Run time : ',($endTime - $startTime),' second',"\n\r";

$byte = memory_get_usage(false);

echo 'Memory max : ', $byte/1024/1024, 'M',"\n\r";

