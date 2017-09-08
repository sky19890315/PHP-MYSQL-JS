<?php
/**
 * 设计模式-服务器定位器模式
 *
 * 因为php没有类似java的arrayList包,为了在依赖注入时有一一对应的关系
 * 故参考yii框架的组件id 格式 即
 * $container = [];
 * $container = [$id => $class];
 * 只要找到对应的id,就可以找到相应的依赖注入类
 * 实例化类对象,可实现类似java的arrayList 作用
 */

/**
* 创建服务器接口
*/
interface Service
{
    function getId();
    function getName();
    function run();
}
/**
* 创建服务实体1
*/
class ServiceOne implements Service
{
    /**
     * 获取某服务实体编号
     * @return [type] [description]
     */
    function getId() {
        return '1';
    }
    /**
     * 获取某服务实体名
     * @return [type] [description]
     */
    function getName() {
        return 'ServiceOne';
    }
    /**
     * 运行服务实体
     * @return [type] [description]
     */
    function run() {
        echo "run ServiceOne \n";
        return;
    }
}
/**
* 创建服务实体2
*/
class ServiceTwo implements Service
{
    /**
     * 获取某服务实体编号
     * @return [type] [description]
     */
    function getId() {
        return '2';
    }
    /**
     * 获取某服务实体名
     * @return [type] [description]
     */
    function getName() {
        return 'ServiceTwo';
    }
    /**
     * 运行服务实体
     * @return [type] [description]
     */
    function run() {
        echo "run ServiceTwo \n";
        return;
    }
}

/**
 * 初始化查询语境
 */
class InitialContext {
    /**
     * 根据用户输入,选择不同服务实体
     * @param  [type] $ServiceName [description]
     * @return [type]              [description]
     */
    function lookUp($ServiceName=null) {
        if (null === $ServiceName) {
            return null;
        }elseif ('ServiceOne' === $ServiceName) {
            return new ServiceOne();
        }elseif ('ServiceTwo' === $ServiceName) {
            return new ServiceTwo();
        }
        return null;
    }
}
/**
 * 缓存
 */
class Cache {
    private $_services = [];
    /**
     * 调用服务器实例
     * @param  [type] $ServiceName [description]
     * @return [type]              [description]
     */
    function getServices($ServiceName = null) {
        if (null === $ServiceName) {
            return null;
        }
        foreach ($this->_services as $id => $Service) {
            if ($ServiceName == $Service) {
                echo "返回缓存 \n".$ServiceName."对象 \n";
                return $Service;//返回对象
            }
        }
        return null;
    }

    /**
     * 添加服务器实例
     * @param [type] $id      [description]
     * @param [type] $Service [description]
     */
    function addService($id,$Service)
    {
        $exists = false;
        foreach ($this->_services as $id => $_Service) {
            if($_Service === $Service) {
                $exists = true;
                continue;
            }
        }
        if (!$exists) {
            $this->_services = [$id => $Service];
            return;
        }
        return;
    }
}
/**
 * 服务器定位器
 */
class ServiceLocator {
    private $_cache;
    /**
     * 通过服务器定位器获取服务器实例
     * @param  [type] $ServiceName [description]
     * @return [type]              [description]
     */
    function getService($ServiceName){
        $this->_cache = new Cache();
        if (!empty($this->_cache->getServices($ServiceName))) {
            return $this->_cache->getServices($ServiceName);
        }// 读取缓存

        $context = new InitialContext();
        $ServiceTmp = $context->lookUp($ServiceName);// 实例返回
        $this->_cache->addService($ServiceTmp->getId(),$ServiceTmp->getName());
        return $ServiceTmp;
    }
}

$ServiceLocator = new ServiceLocator();
$tmp = $ServiceLocator->getService('ServiceTwo');
$tmp->run();


