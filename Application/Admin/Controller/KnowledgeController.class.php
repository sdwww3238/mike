<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/7
 * Time: 18:15
 */
    namespace Admin\Controller;
    use Think\Controller;
    class KnowledgeController extends CommonController{
        public function showlist(){
            $model=M('knowledge');
            $data=$model->select();
            $this->assign('data',$data);
            $this->display();
        }
        public function add(){
            $this->display();
        }
        public function addOk(){
            $post=I('post.');
            if($_FILES['thumb']['size']>0){
                $cfg=array('rootPath'=>WORKING_PATH.UPLOAD_ROOT_PATH,);
                $upload=new \Think\Upload($cfg);
                $info=$upload->uploadOne($_FILES['thumb']);
                if($info){
                   $post['picture']=UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
                   $image=new \Think\Image();
                   $image->open(WORKING_PATH.$post['picture']);
                   $image->thumb(100,100);
                   $image->save(WORKING_PATH.UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename']);
                   $post['thumb']=UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename'];
                }
                $post['addtime']=time();
                $model=M('knowledge');
                $rst=$model->add($post);
                if($rst){
                    $this->success('添加成功',U('showList'));
                }else{
                    $this->error('添加失败',U('edit',U('add')));
                }
            }
        }
        public function edit(){
            $id=I('get.id');
            $model=M('knowledge');
            $data=$model->find($id);
            $this->assign('data',$data);
            $this->display();
        }
        public function editOk(){
            $post=I('post.');
            if($_FILES['thumb']['size']>0){
                $cfg=array('rootPath'=>WORKING_PATH.UPLOAD_ROOT_PATH,);
                $upload=new \Think\Upload($cfg);
                $info=$upload->uploadOne($_FILES['thumb']);
                if($info){
                    $image=new \Think\Image();
                    $image->open(WORKING_PATH.UPLOAD_ROOT_PATH.$info['savepath'].$info['savename']);
                    $image->thumb(80,80);
                    $image->save(WORKING_PATH.UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename']);
                    $post['picture']=UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
                    $post['thumb']=UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename'];
                }
            }
            $post['addtime']=time();
            $model=M('knowledge');
            $rst=$model->save($post);
            if($rst){
                $this->success('修改成功',U('showList'));
            }else{
                $this->error('修改失败',U('edit',U('add')));
            }
        }
        public function getContent(){
            $id=I('get.id');
            $model=M('knowledge');
            $data=$model->find($id);
            echo htmlspecialchars_decode($data['description']);

        }

    }