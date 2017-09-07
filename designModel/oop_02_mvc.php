<?php
/**
 * model
 */
class StudentModel {
	private $_rollNo; // 分数
	private $_name; // 姓名

	/**
	 * 获取分数
	 * @return [type] [description]
	 */
	public function getRollNo() {
		return $this->_rollNo;
	}
	/**
	 * 设置分数
	 * @param [type] $rollNo [description]
	 */
	public function setRollNo($rollNo) {
		$this->_rollNo = $rollNo;
		return;
	}
	/**
	 * 获取姓名
	 * @return [type] [description]
	 */
	public function getName() {
		return $this->_name;
	}
	/**
	 * 设置姓名
	 * @param [type] $name [description]
	 */
	public function setName($name) {
		$this->_name = $name;
		return;
	}
}

/**
 * 视图
 */
class StudentView {
	/**
	 * 输出视图到页面
	 * @param  [type] $studentName   [description]
	 * @param  [type] $studentRollNo [description]
	 * @return [type]                [description]
	 */
	public function outStudentDetails($studentName, $studentRollNo) {
		echo "Student: \n";
		echo "Name \t" . $studentName . "\n";
		echo "RollNo \t" . $studentRollNo . "\n";
	}
}

/**
 * 控制器
 */
class StudentController {
	private $_studentModel; // 注入模型类对象
	private $_studentView; // 注入视图类对象

	/**
	 * 初始化
	 * @param [type] $studentModel [description]
	 * @param [type] $studentView  [description]
	 */
	public function __construct($studentModel, $studentView) {
		$this->_studentModel = $studentModel;
		$this->_studentView = $studentView;
	}

	/**
	 * 控制器调用模型类对象的方法
	 * -- 获取学生名
	 * @return [type] [description]
	 */
	public function getStudentName() {
		return $this->_studentModel->getName();
	}
	/**
	 * 控制器调用模型类对象的方法
	 * -- 获取学生分数
	 * @return [type] [description]
	 */
	public function getStudentRollNo() {
		return $this->_studentModel->getRollNo();
	}
	/**
	 * 控制器调用视图的方法
	 * -- 展示页面
	 * @return [type] [description]
	 */
	public function updateView() {
		$this->_studentView->outStudentDetails($this->getStudentName(), $this->getStudentRollNo());
		return;
	}
	/**
	 * 模拟获取数据库内容
	 * -- 调用模型类对象设置学生名和分数的方法
	 * @param [type] $studentName   [description]
	 * @param [type] $studentRollNo [description]
	 */
	public function setDataBase($studentName, $studentRollNo) {
		$this->_studentModel->setName($studentName);
		$this->_studentModel->setRollNo($studentRollNo);
		return;
	}
}

/**
 * 调用
 * 1 注入类对象
 * 2 读取数据库数据（虚拟）
 * 3 调用视图
 */
$studentController = new StudentController(new StudentModel(), new StudentView());
$studentController->setDataBase('ken', 99);
$studentController->updateView();
