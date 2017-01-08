<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/1/8
 * Time: 10:57
 */
namespace Admin\Controller;
use Think\Controller;
class InterfaceController extends Controller{
    function test(){
        phpinfo();
    }
    public function textRequest(){
        $url='www.w.com';
        $content=request($url,false);
        dump($content);
    }
}