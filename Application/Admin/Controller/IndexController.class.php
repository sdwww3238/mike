<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/6
 * Time: 14:59
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController{
    public function index(){
        $this->display();
    }
    public function _empty(){
        $this->display('Empty/error');
    }

    public function home(){
        $model=M('email');
        $data=$model->field('t1.*,t2.truename as truename')->table('sp_email as t1,sp_user as t2')->where('t1.from_id=t2.id and t1.isread=0 and t1.to_id='.session('uid') )->select();
        $this->assign('data',$data);
        $this->display();
    }
}