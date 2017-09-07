<?php
// 服务器定位
// 1 定义接口
interface Service
{
    // 获取服务器
    public function getName();
    // 执行
    function run();
}

// 2 实现接口

/**
 * 实现服务器 1
 */
class Service1 implements Service
{
    // 获取服务器名
    function getName()
    {
        return 'Service1';
    }
    // 执行
    function run()
    {
        echo "执行 \n\n Service1";
        return;
    }
}

/**
 * 实现服务器 2
 */
class Service2 implements Service
{
    // 获取服务器名
    public function getName()
    {
        return 'Service2';
    }
    // 执行
    public function run()
    {
        echo "执行 \n\n Service2";
        return;
    }
}

// 应用访问
class InitialContext
{
    public function lookup($jngiName)
    {
        if ($jngiName == 'Service1') {
            // 找到并实例化服务器 1
            echo "Lookup and creating a new service Service1";
            return new Service1();
        } elseif ($jngiName == 'Service2') {
            // 找到并实例化服务器 1
            echo "Lookup and creating a new service Service2";
            return new Service2();
        }
        return null;
    }
}

/**
 *  缓存
 */
class Cache
{
    private $arr = [];

    public function Cache()
    {

    }

    public function getService($serviceName)
    {
        foreach ($arr as $key => $value) {
            if () {
                # code...
            }
        }
    }
}
