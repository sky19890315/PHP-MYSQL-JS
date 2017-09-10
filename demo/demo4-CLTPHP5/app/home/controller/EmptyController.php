<?php
namespace app\home\controller;
use think\Db;
use think\Request;
use clt\Form;
class EmptyController extends Common{
    protected  $dao,$fields;
    public function _initialize()
    {
        parent::_initialize();
        $this->dao = db(DBNAME);
    }
    public function index(){
        if(DBNAME=='page'){
            $info = $this->dao->where('id',input('catId'))->find();
            $this->assign('info',$info);
            if($info['template']){
                $template = $info['template'];
            }else{
                $info['template'] = db('category')->where('id',$info['id'])->value('template_show');
                if($info['template']){
                    $template = $info['template'];
                }else{
                    $template = DBNAME.'_show';
                }
            }
            $list=Db::table(config('database.prefix').'article')->alias('a')
                ->join(config('database.prefix').'category c','a.catid = c.id','left')
                ->where(array('a.posid'=>array('neq',0)))
                ->field('a.*,c.catdir')
                ->limit('8')
                ->order('listorder asc,createtime desc')
                ->select();

            foreach ($list as $k=>$v){
                $list[$k]['controller'] = $v['catdir'];
                $title_style = explode(';',$v['title_style']);
                $list[$k]['title_color'] = $title_style[0];
                $list[$k]['title_weight'] = $title_style[1];
                $list[$k]['title_thumb'] = $v['thumb']?__PUBLIC__.$v['thumb']:__HOME__.'/images/portfolio-thumb/p'.($k+1).'.jpg';
            }
            $this->assign('list',$list);
            return $this->fetch($template);
        }else{
            if(DBNAME=='picture'){
                $setup = db('field')->where(array('moduleid'=>3,'field'=>'group'))->value('setup');
                $setup=is_array($setup) ? $setup: string2array($setup);
                $options = explode("\n",$setup['options']);
                foreach($options as $r) {
                    $v = explode("|",$r);
                    $k = trim($v[1]);
                    $optionsarr[$k]['val'] = $v[0];
                    $optionsarr[$k]['key'] = $k;
                }
                $this->assign('options',$optionsarr);
            }
            $map['catid'] = input('catId');
            if(DBNAME=='team'){
                $donation = db('donation')->order('id desc')->paginate($this->pagesize);
                $dpage = $donation->render();
                $dlist = $donation->toArray();
                $this->assign('dlist',$dlist['data']);
                $this->assign('dpage',$dpage);
                $list = $this->dao->where($map)->order('listorder asc,createtime desc')->select();
                foreach ($list as $k=>$v){
                    $list_style = explode(';',$v['title_style']);
                    $list[$k]['title_color'] =$list_style[0];
                    $list[$k]['title_weight'] =$list_style[1];
                    $title_thumb = $v['thumb'];
                    $list[$k]['title_thumb'] = $title_thumb?__PUBLIC__.$title_thumb:__HOME__.'/images/portfolio-thumb/p'.($k+1).'.jpg';
                }
                $this->assign('list',$list);
            }else{
                $list=$this->dao->alias('a')
                    ->join(config('database.prefix').'category c','a.catid = c.id','left')
                    ->where($map)
                    ->field('a.*,c.catdir')
                    ->order('listorder asc,createtime desc')
                    ->paginate($this->pagesize);
                // 获取分页显示
                $page = $list->render();
                $list = $list->toArray();
                foreach ($list['data'] as $k=>$v){
                    $list['data'][$k]['controller'] = $v['catdir'];
                    $list_style = explode(';',$v['title_style']);
                    $list['data'][$k]['title_color'] =$list_style[0];
                    $list['data'][$k]['title_weight'] =$list_style[1];
                    $title_thumb = $v['thumb'];
                    $list['data'][$k]['title_thumb'] = $title_thumb?__PUBLIC__.$title_thumb:__HOME__.'/images/portfolio-thumb/p'.($k+1).'.jpg';
                }
                $this->assign('list',$list['data']);
                $this->assign('page',$page);
            }
			$cattemplate = db('category')->where('id',input('catId'))->value('template_list');
			$template =$cattemplate ? $cattemplate : DBNAME.'_list';
            //当前分类推荐
            $where['a.catid'] = input('catId');
            $where['a.posid'] = array('neq',0);
            $recommend=Db::table(config('database.prefix').'article')->alias('a')
                ->join(config('database.prefix').'category c','a.catid = c.id','left')
                ->where($where)
                ->field('a.*,c.catdir')
                ->limit('8')
                ->order('listorder asc,createtime desc')
                ->select();
            foreach ($recommend as $k=>$v){
                $recommend[$k]['controller'] = $v['catdir'];
                $title_style = explode(';',$v['title_style']);
                $recommend[$k]['title_color'] = $title_style[0];
                $recommend[$k]['title_weight'] = $title_style[1];
                $recommend[$k]['title_thumb'] = $v['thumb']?__PUBLIC__.$v['thumb']:__HOME__.'/images/portfolio-thumb/p'.($k+1).'.jpg';
            }
            $this->assign('recommend',$recommend);
            return $this->fetch($template);
        }
    }
    public function info(){
        $this->dao->where('id',input('id'))->setInc('hits');
        $info = $this->dao->where('id',input('id'))->find();
        $info['pic'] = $info['pic']?__PUBLIC__.$info['pic']:__HOME__."/images/sample-images/blog-post".rand(1,3).".jpg";
        $title_style = explode(';',$info['title_style']);
        $info['title_color'] = $title_style[0];
        $info['title_weight'] = $title_style[1];
        $title_thumb = $info['thumb'];
        $info['title_thumb'] = $title_thumb?__PUBLIC__.$title_thumb:__HOME__.'/images/sample-images/blog-post'.rand(1,3).'.jpg';
        if(DBNAME=='picture'){
            $pics = explode(':::',$info['pics']);
            foreach ($pics as $k=>$v){
                $info['pics'][$k] = explode('|',$v);
            }
        }
        $this->assign('info',$info);

        //当前分类推荐
        $where['a.catid'] = input('catId');
        $where['a.posid'] = array('neq',0);
        $recommend=Db::table(config('database.prefix').'article')->alias('a')
            ->join(config('database.prefix').'category c','a.catid = c.id','left')
            ->field('a.*,c.catdir')
            ->where($where)
            ->select();
        foreach ($recommend as $k=>$v){
            $recommend[$k]['controller'] = $v['catdir'];
            $title_style = explode(';',$v['title_style']);
            $recommend[$k]['title_color'] = $title_style[0];
            $recommend[$k]['title_weight'] = $title_style[1];
            $recommend[$k]['title_thumb'] = $v['thumb']?__PUBLIC__.$v['thumb']:__HOME__.'/images/portfolio-thumb/p'.($k+1).'.jpg';
        }
        $this->assign('recommend',$recommend);
        if($info['template']){
			$template = $info['template'];
		}else{
			$cattemplate = db('category')->where('id',$info['catid'])->value('template_show');
			if($cattemplate){
				$template = $cattemplate;
			}else{
				$template = DBNAME.'_show';
			}
		}
        return $this->fetch($template);
    }
    public function senMsg(){
        $data = input('post.');
        $data['addtime'] = time();
        $data['ip'] = getIp();
        db('message')->insert($data);
        $result['status'] = 1;
        return $result;
    }
}