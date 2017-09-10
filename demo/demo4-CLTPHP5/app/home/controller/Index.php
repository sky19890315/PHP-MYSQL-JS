<?php
namespace app\home\controller;
use think\Controller;
use think\Input;
use think\Db;
use think\Request;
class Index extends Common{
    public function _initialize(){
        parent::_initialize();
    }
    public function index(){
        //首页推荐
        $list=db('article')->alias('a')
            ->join(config('database.prefix').'category c','a.catid = c.id','left')
            ->where(array('a.posid'=>1))
            ->field('a.*,c.catdir')
            ->limit('4')
            ->order('listorder asc,createtime desc')
            ->select();
        foreach ($list as $k=>$v){
            $list[$k]['controller'] = $v['catdir'];
            $title_style = explode(';',$v['title_style']);
            $list[$k]['title_color'] = $title_style[0];
            $list[$k]['title_weight'] = $title_style[1];
            $list[$k]['title_thumb'] = __HOME__.'/images/portfolio-thumb/p'.($k+1).'.jpg';
        }
        $this->assign('list',$list);
        return $this->fetch();
    }
}