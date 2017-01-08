<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/4
 * Time: 20:06
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
    public function __construct(){
        parent::__construct();
        $uid=session('uid');
        if(empty($uid)){
            // $this->error('你没有登录',U('public/login'),2);
            $url=U('public/login');
            $script="<script>top.location.href='$url'</script>";
            echo $script;exit;
        }
        $controller=strtolower(CONTROLLER_NAME);
        $action=strtolower(ACTION_NAME);
        $auths=C('RBAC_ROLES_AUTHS');
        $auth=$auths[session('role_id')];
        if(!in_array($controller.'/'.$action,$auths)&&!in_array($controller.'/*',$auth)){
            $this->error('你没有操作权限',U('Index/home'));exit;
        }
    }

}