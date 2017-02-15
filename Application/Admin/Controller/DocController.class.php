<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/7
 * Time: 16:31
 */
namespace Admin\Controller;
use Think\Controller;
class DocController extends CommonController{
    public function showlist(){
        $model=M('Doc');
        $data=$model->select();
        $this->assign('data',$data);
        $this->display();
    }
    public function addOk(){
        $post=I('post.');
        $file=$_FILES['file'];
        $cfg=array('rootPath'=>WORKING_PATH.UPLOAD_ROOT_PATH,);
        $upload=new \Think\Upload($cfg);
        if($file['size']>0){
            $info=$upload->uploadOne($file);
            // dump($info);die;
            if($info){
                $post['hasfile']=1;
                $post['filename']=$info['savename'];
                $post['filepath']=UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
            }
        }
        $post['addtime']=time();
        $model=M('doc');

        $rst=$model->add($post);
        if($rst){
            $this->success('添加公文成功',U('showList'));
        }else{
            $this->error('添加公文失败',U('add'));
        }
    }
    public function add(){
        $this->display();
    }
    public function download(){
        $id=I('get.id');
        $model=M('Doc');
        $data=$model->find($id);
        $file=UPLOAD_ROOT_PATH.$data['filepath'];
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header("Content-Length: ". filesize($file));
        readfile($file);
    }
    public function getContent(){
        $id=I('get.id');
        $model=M('Doc');
        $data=$model->find($id);
        echo htmlspecialchars_decode($data['content']);
    }
    public function edit(){
        $id=I('get.id');
        $model=M('Doc');
        $data=$model->find($id);
        $this->assign('data',$data);
        $this->display();
    }
    public function editOk(){
        $post=I('post.');
        $file=$_FILES['file'];
        $cfg=array('rootPath'=>WORKING_PATH.UPLOAD_ROOT_PATH,);
        $upload=new \Think\Upload($cfg);
        if($file['size']>0){
            $info=$upload->uploadOne($file);
            if($info){
                $post['hasfile']=1;
                $post['filename']=$info['savename'];
                $post['filepath']=UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
            }
        }
        $post['addtime']=time();
        $model=M('Doc');
        $rst=$model->add($post);
        if($rst){
            $this->success('修改公文成功',U('showList'));
        }else{
            $this->error('修改公文失败',U('add'));
        }
    }
}