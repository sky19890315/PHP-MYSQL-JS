<?php
/**
 * model
 */
class StudentModel {
	private $_rollNo;
	private $_name;

	public function getRollNo() {
		return $this->_rollNo;
	}

	public function setRollNo($rollNo) {
		$this->_rollNo = $rollNo;
		return;
	}
	public function getName() {
		return $this->_name;
	}

	public function setName($name) {
		$this->_name = $name;
		return;
	}
}

/**
 * 视图
 */
class StudentView {
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
	private $_studentModel;
	private $_studentView;

	public function __construct($studentModel, $studentView) {
		$this->_studentModel = $studentModel;
		$this->_studentView = $studentView;
	}

	public function getStudentName() {
		return $this->_studentModel->getName();
	}

	public function getStudentRollNo() {
		return $this->_studentModel->getRollNo();
	}

	public function updateView() {
		$this->_studentView->outStudentDetails($this->_studentModel->getName(), $this->_studentModel->getRollNo());
		return;
	}

	public function setDataBase($studentName, $studentRollNo) {
		$this->_studentModel->setName($studentName);
		$this->_studentModel->setRollNo($studentRollNo);
		return;
	}
}

/**
 * 调用
 */
$studentController = new StudentController(new StudentModel(), new StudentView());
$studentController->setDataBase('ken', 99);
$studentController->updateView();
