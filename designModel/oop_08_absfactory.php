<?php
/**
 *
 * @authors ken (296675685@qq.com)
 * @date    2017-09-09 21:08:26
 * @version $Id$
 */
interface Shape {
// 形状接口
	public function draw();
}

class Rectangle implements Shape {
// 长方形实现形状接口
	function draw() {
		echo "draw Rectangle \n";
		return;
	}
}

class Square implements Shape {
// 正方形实现形状接口
	public function draw() {
		echo "draw Square \n";
		return;
	}
}

class Circle implements Shape {
// 圆形实现形状接口
	public function draw() {
		echo "draw Circle \n";
		return;
	}
}

interface Color {
// 颜色接口
	public function fill();
}

class Red implements Color {
// 红色实现颜色接口
	function fill() {
		echo "fill Red \n";
		return;
	}
}
class Green implements Color {
// 绿色实现颜色接口
	public function fill() {
		echo "fill Green \n";
		return;
	}
}
class Blue implements Color {
// 蓝色实现颜色接口
	public function fill() {
		echo "fill Blue \n";
		return;
	}
}

abstract class AbstractFactory {
// 抽象工厂
	abstract public function getColor($color);
	abstract public function getShape($shape);
}

class ColorFactory extends AbstractFactory {
// 颜色工厂实现抽象工厂
	public function getColor($color = null) {
		if (null === $color) {
			return;
		}
		if ('red' === $color) {
			return new Red();
		} elseif ('green' === $color) {
			return new Green();
		} elseif ('blue' === $color) {
			return new Blue();
		}
		return;
	}
	public function getShape($shape = null) {
		return;
	}
}

class ShapeFactory extends AbstractFactory {
// 形状工厂实现抽象工厂
	public function getColor($color = null) {
		return;
	}

	public function getShape($shape = null) {
		if (null === $shape) {
			return;
		}
		if ('rectangle' === $shape) {
			return new Rectangle();
		} elseif ('square' === $shape) {
			return new Square();
		} elseif ('circle' === $shape) {
			return new Circle();
		}
		return;
	}
}
class FactoryProducer {
// 工厂提供者 根据用户选择 提供颜色工厂|形状工厂
	public static function getFactory($factory = null) {
		if (null === $factory) {
			return;
		}
		if ('shape' === $factory) {
			return new ShapeFactory();
		} elseif ('color' === $factory) {
			return new ColorFactory();
		}
		return;
	}
}

$color = FactoryProducer::getFactory('color'); // 用户选择调用颜色工厂
$color->getColor('blue')->fill(); // 用户选择颜色工厂下的蓝色
FactoryProducer::getFactory('shape')->getShape('circle')->draw(); // 用户选择形状
// 工厂并调用形状工厂的获取形状方法，通过该方法选择圆形对象，并调用其下的画的方法 画了一个园
// 到这里 就和Yii很像了
// Yii::$app->a('something')->b();
// 说明Yii框架也大量使用了抽象工厂方法
// 不同的是，Yii是一个全局变量，相当于一个全局抽象工厂，根据用户不同的应用（$app）来选择不同的
// 工厂，进而调用某些工厂下的方法
