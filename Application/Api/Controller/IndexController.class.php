<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    //测试request方法发送请求
    public function testRequest(){
      //请求的url地址
      $url = 'https://www.baidu.com/';
      //使用request方法发送请求
      $content = request($url);


    }
    //天气查询测试接口
    public function weather(){
        $city='北京';
        $url='http://api.map.baidu.com/telematics/v2/weather?location='.$city.'&ak=B8aced94da0b345579f481a1294c9094';
        $content=request($url,false);
        $content=simplexml_load_string($content);
        $todayweather=$content->results->result[0];

        echo $todayweather->date;
        echo '<img src="'.$todayweather->dayPictureUrl.'"/>'.'<br />';
        echo $todayweather->nightPictureUrl;
        echo $todayweather->weather;
        echo $todayweather->wind;
        echo $todayweather->temperature;
    }
    public function getAreaByPhone(){
        $phone='15152671537';
        $url='http://cx.shouji.360.cn/phonearea.php?number='.$phone;
        $content=request($url,false);
        $content=json_decode($content);
        echo $content->data->province;
        echo $content->data->city;
        echo $content->data->sp;
    }

}