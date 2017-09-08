<?php
/**
 * 工厂模式
 */
interface Shape {
	// 制作
	public function draw();
}
/**
 * 长方形
 */
class Rectangle implements Shape {
	function draw() {
		echo "制造长方形\n";
	}
}
/**
 * 正方形
 */
class Square implements Shape {
	public function draw() {
		echo "制造正方形\n";
	}
}
/**
 * 圆形
 */
class Circle implements Shape {
	public function draw() {
		echo "制造园形\n";
	}
}

/**
 * 根据给定信息 生成模型
 */
class ShapeFactory {
	public function getShape($shapeType = null) {
		if (null === $shapeType) {
			return null;
		}
		/**
		 * 如果选择长方形，则返回长方形类对象
		 */
		if ('Rectangle' == $shapeType) {
			return new Rectangle();
		}
		/**
		 * 如果选择正方形，则返回正方形类对象
		 */
		if ('Square' == $shapeType) {
			return new Square();
		}
		/**
		 * 如果选择圆形，则选择圆形类对象
		 */
		if ('Circle' == $shapeType) {
			return new Circle();
		}
	}
}
/**
 * 其实工厂模式|抽象工厂模式是yii框架常用的一种模式
 * 经常根据我们输入的类对象名来进行实例化
 * @var ShapeFactory
 */
$shapeFactory = new ShapeFactory();
$shapeFactory->getShape('Rectangle')->draw();
$shapeFactory->getShape('Square')->draw();
$shapeFactory->getShape('Circle')->draw();
