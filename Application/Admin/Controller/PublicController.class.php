<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/6
 * Time: 14:59
 */
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
    public function login(){
        $this->display();
    }
    public function captcha(){
        $cfg = array(
            'fontSize'  =>  12,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  85,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        $verify=new \Think\Verify($cfg);
        $verify->entry();
    }
    public function checkLogin(){
        $post=I('post.');
        $verify=new \Think\Verify();
        $result=$verify->check($post['captcha']);
        if($result) {
            $model = M('User');
            unset($post['captcha']);
            $data = $model->where($post)->find();
            if ($data) {
                session('uid', $data['id']);
                session('uname', $data['username']);
                session('role_id', $data['role_id']);
                $this->success('登陆成功', U('Index/index'));
            } else {
                $this -> error('用户名或密码错误',U('login'),3);
            }
        }else{
            $this -> error('验证码错误...',U('login'),3);
        }
    }
    public function logout(){
        session_destroy();
        $this -> success('退出成功',U('login'),3);

    }

}