<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/7
 * Time: 20:53
 */
namespace Admin\Controller;
use Think\Controlelr;
class EmailController extends CommonController{
    public function send(){
        $model=M('User');
        $data=$model->select();
        $this->assign('data',$data);
        $this->display();
    }
    public function sendOk(){
        $post=I('post.');
        $post['from_id']=$post['id'];
        $file=$_FILES['file'];
        if($file['size']>0){
            $cfg=array('rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH,);
            $upload=new \Think\Upload($cfg);
            $info=$upload->uploadOne($file);
            if($info){
                $post['hasfile']=1;
                $post['filename']=$info['savename'];
                $post['file']=UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
            }

        }
        $post['from_id'] = session('uid');
        $post['addtime']=time();
        $model=M('email');
        $rst=$model->add($post);
        if($rst){
            #成功
            $this -> success('邮件发送成功',U('sendBox'),3);
        }else{
            #发送失败
            $this -> error('发送失败',U('send'),3);
        }
    }
    public function recBox(){
        $model=M('email');
        $data=$model->field('t1.*,t2.truename')->table('sp_email as t1,sp_user as t2')->where('t1.from_id=t2.id and t1.to_id='.session("uid"))->select();
        $this->assign('data',$data);
        $this->display();
    }
    public function download(){
        $id=I('get.id');
        $model=M('email');
        $data=$model->find($id);
        $file=WORKING_PATH.$data['file'];
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header("Content-Length: ". filesize($file));
        readfile($file);
    }
    public function getcontent(){
        $id=I('get.id');
        $model=M('email');
        $data=$model->find($id);
        if(I('get.isrec') == 1 && $data){
            $this -> setStatus($id);
        }
        $this->assign('data',$data);
        echo $data['content'];

    }
    public function sendBox(){
        $model=M('email');
        $data=$model->field('t1.*,t2.truename')->table('sp_email as t1,sp_user as t2')->where('t1.to_id=t2.id')->select();
        $this->assign('data',$data);
        $this->display();
    }
    public function setStatus($id){
        #实例化
        $model = M('Email');
        #更新修改操作
        $model -> save(array('id' => $id,'isread' => 1));
    }
    public function getMsgCount(){
        $model=M('email');
        $count=$model->where('isread=0 and to_id= '.session("uid"))->count();
        echo $count;
    }
}