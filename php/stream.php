<?php
/**
 * Created by PhpStorm.
 * User: sunkeyi
 * Date: 2017/12/13
 * Time: 下午5:25
 */

class RecursiveFileFilterIterator extends FilterIterator{

	protected $ext = ['jpg','gif','jpeg'];

	public function __construct($path)
	{
		parent::__construct(new RecursiveFileFilterIterator($path));
	}

	public function accept(){
		$item = $this->getInnerIterator();
		if ($item->isFile() && in_array(pathinfo($item->getFilename(), PATHINFO_EXTENSION),$this->ext))
		{
			return true;
		}
	}
}

foreach (new RecursiveIteratorIterator('/') as $item) {
	echo $item,"\r\n";
}