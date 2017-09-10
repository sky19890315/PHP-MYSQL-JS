<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Donation extends Common
{
    //捐赠列表
    public function index(){
        if(request()->isPost()) {
            $key=input('post.key');
            $page =input('pageIndex');
            $pageSize =input('pageSize');
            $list = db('donation')->where('name', 'like', "%" . $key . "%")->order('addtime desc') ->paginate(array('list_rows'=>$pageSize,'page'=>$page))->toArray();
            $rsult['code'] = 0;
            $rsult['msg'] = "获取成功";
            $rsult['list'] = $list['data'];
            $rsult['count'] = $list['total'];
            $rsult['rel'] = 1;
            echo json_encode($rsult);
            exit;
        }
        return $this->fetch();
    }
    public function add(){
        if(request()->isPost()) {
            //构建数组
            $data = input('post.');
            $data['addtime'] = time();
            db('donation')->insert($data);
            $result['code'] = 1;
            $result['msg'] = '捐赠名单添加成功!';
            $result['url'] = url('index');
            return $result;
        }else{
            $this->assign('title',lang('add').'捐赠名单');
            $this->assign('info','null');
            return $this->fetch('form');
        }
    }
    public function edit(){
        if(request()->isPost()) {
            $data = input('post.');
            db('donation')->update($data);
            $result['code'] = 1;
            $result['msg'] = '捐赠名单修改成功!';
            $result['url'] = url('index');
            return $result;
        }else{
            $id=input('id');
            $info=db('donation')->where(array('id'=>$id))->find();
            $this->assign('info',json_encode($info,true));
            $this->assign('title',lang('edit').'捐赠名单');
            return $this->fetch('form');
        }
    }
    public function del(){
        db('donation')->where(array('id'=>input('id')))->delete();
        $this->redirect('index');
    }
    public function delall(){
        $map['id'] =array('in',input('param.ids'));
        db('donation')->where($map)->delete();
        $result['msg'] = '删除成功！';
        $result['url'] = url('index');
        return $result;
    }
}