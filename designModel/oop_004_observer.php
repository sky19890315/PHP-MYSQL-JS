<?php
/**
 * 实体
 */
class Subject {
	private $_observer = [];
	private $_state;
	/**
	 * 获取当前状态
	 * @return [type] [description]
	 */
	public function getState() {
		return $this->_state;
	}
	/**
	 * 根据输入状态变更当前状态
	 * @param [type] $state [description]
	 */
	public function setState($state) {
		$this->_state = $state;
		$this->notifyAllObservers();
		return;
	}
	/**
	 * 绑定观察者 注入观察者类对象
	 * @param  [type] $observer [description]
	 * @return [type]           [description]
	 */
	public function attach($observer) {
		$this->_observer = [$observer];
		return;
	}
	/**
	 * 遍历出观察者类对象，调用观察者类对象的update()方法
	 * @return [type] [description]
	 */
	public function notifyAllObservers() {
		foreach ($this->_observer as $observer) {
			$observer->update();
		}
		return;
	}
}

/**
 * 抽象观察者
 */
abstract class Observer {
	protected $_subject;
	abstract public function update();
}
/**
 * 实体观察者对象
 */
class BinaryObserver extends Observer {
	protected $_subject;
	/**
	 * 通过注入类对象绑定其本身
	 * @param  [type] $subject [description]
	 * @return [type]          [description]
	 */
	public function __construct($subject) {
		$this->_subject = $subject;
		$this->_subject->attach($this);
		return;
	}

	public function update() {
		echo "观察到状态改变为\n" . $this->_subject->getState();
	}
}
$subject = new Subject();
$subject->setState(2);
$binaryObserver = new BinaryObserver($subject);
$binaryObserver->update();
