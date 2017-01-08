<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/6
 * Time: 15:46
 */
namespace Admin\Controller;
use Think\Controller;
class DeptController extends CommonController{
    public function showlist(){
        $model=M('Dept');
        $count=$model->count();
        $page=new \Think\Page($count,10);
        $show=$page->show();
        $data=$model->limit($page->firstRow,$page->listRows)->select();
        $this->assign('show',$show);
        $this->assign('data',$data);
        $this->assign('count',$count);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $post=I('post.');
            $model=M('Dept');
            $rst=$model->create($post);
            $model->add();
            if($rst){
                $this->success('添加成功',U("showList"),3);
            }else{
                $this->error('添加失败');
            }
        }else{
            $model=M('Dept');
            $data=$model->where('pid=0')->select();
            $this->assign('data',$data);
            $this->display();
        }
    }
    public function edit(){
        if(IS_POST){
            $post=I('post.');
            $model=M('dept');
            $data=$model->save($post);
            if($data){
                $this->success('添加成功',U('showlist'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $id=I('get.id');
            $model=M('Dept');
            $info=$model->where('id!='.$id)->select();
            $data=$model->find($id);
            $this->assign('data',$data);
            $this->assign('info',$info);
            $this->display();
        }

    }
    public function delete(){
        $id=I('get.id');
        $model=M('Dept');
        $data=$model->where('id='.$id)->delete();
        if($data){
            $this->success();
        }
    }
}