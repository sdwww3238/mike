<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/6
 * Time: 15:30
 */
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{
    public function showlist(){
        $model=M('User');
        $count=$model->count();
        $page=new \Think\Page($count,3);
        $show=$page->show();
        $data=$model->limit($page->firstRow,$page->listRows)->select();
        $this->assign('data',$data);
        $this->assign('show',$show);
        $this->assign('count',$count);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $post=I('post.');
            $model=M('User');
            $post['addtime']=time();
            $data=$model->create($post);
            $model->save($post);
            if($data){
                $this->success('添加成功',U('showlist'));
            }else{
                $this->error('添加失败');
            }

        }else{

            $model=M('Dept');
            $data=$model->select();
            $this->assign('data',$data);
            $this->display();
        }

    }
    public function delete(){
        $id=I('get.id');
        $model=M('User');
        $data=$model->where('id='.$id)->delete();
        if($data){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    public function edit(){
        if(IS_POST){
            $post=I('post.');
            $model=M('user');
            $data=$model->save($post);
            if($data){
                $this->success('编辑成功',U('showlist'));
            }else{
                $this->error('编辑失败');
            }
        }else{
            $id=I('get.id');
            $model=M('user');
            $data=$model->find($id);
            $this->assign('data',$data);
            $model2=M('Dept');
            $info=$model2->select();
            $this->assign('info',$info);
            $this->display();
        }

    }
}