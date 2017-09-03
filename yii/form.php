在yii的yii/base/Application目录下，有这么一段构造函数
这个构造函数，指向了我们开发时常用的Yii::$app 这个全局变量
同时，在Application 这个抽象类中，定义了所有全局使用到的变量或常亮
对于抽象类和普通类的区别，在于其有抽象方法abstract function   
 public function __construct($config = [])
    {
        Yii::$app = $this;
        static::setInstance($this);

        $this->state = self::STATE_BEGIN;

        $this->preInit($config);

        $this->registerErrorHandler($config);

        Component::__construct($config);
    }
