<?php
/**
* 首页视图
*/
class Home
{
  function show()
  {
    echo "Home view \n";
  }
}

/**
* 学生视图
*/
class Student
{

  function show()
  {
    echo "Student view \n";
  }
}

/**
* 调度器
*/
class Dispatcher
{
  private $_home;
  private $_student;
  function __construct()
  {
    $this->_home = new Home();
    $this->_student = new Student();
    return;
  }

  /**
   * 根据请求分配视图
   * @param  [type] $request [description]
   * @return [type]          [description]
   */
  function dispatch ($request)
  {
    if ('student' === $request) {
      return $this->_student->show();
    } else {
      return $this->_home->show();
    }
    return;
  }
}

/**
 * 前端控制器
 */
class FrontController {
    private $_dispatcher;
    function __construct () {
        $this->_dispatcher = new Dispatcher();
        return;
    }

    /**
     * 验证请求用户
     * @return boolean [description]
     */
    private function isAuthenticUser()
    {
        echo "is isAuthenticUser user \n";
        return true;
    }

    /**
     * 分配请求
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    function dispatchRequest($request=null) {
        $i = 0;
        $j = 0;
        if (!empty($request)) {
            $i++;
            echo "第\n".$i."\n 次请求!";
            echo "<br/>";
        }
        if ($this->isAuthenticUser()) {
            $this->_dispatcher->dispatch($request);
            $j++;
            echo "<br/>";
            echo "第\n".$j."\n 次请求成功!";
            return;
        }
        return;
    }
}

// 实例调用
$request = new FrontController();
$request->dispatchRequest('student');