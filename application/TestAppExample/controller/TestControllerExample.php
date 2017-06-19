<?php
namespace app\TestAppExample\controller;

use \think\Request;
use \think\Loader;
use \think\Controller;
use \think\Collection;

use \app\TestAppExample\model\ChannelTestData;

/* 
 *  访问url 1: http://localhost/studyTp5/public/testappExample/Test_Controller_Example/phpInfo
 *  访问url 2: http://localhost/studyTp5/public/testAppExample/Test_Controller_Example/phpInfo
 *  访问url 3: http://localhost/studyTp5/public/TestAppExample/Test_Controller_Example/phpInfo
 *  访问url 1、url 2、url 3后,都是定位到
 *             http://localhost/studyTp5/public/TestAppExample/Test_Controller_Example/phpInfo
 *  */
class TestControllerExample extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    
    // note: 访问该方法的url地址是:
    //      http://localhost/studyTp5/public/TestAppExample/Test_Controller_Example/phpInfo
    // 或则  http://localhost/studyTp5/public/TestAppExample/test_controller_example/phpInfo
    // 不能是  http://localhost/studyTp5/public/TestAppExample/TestControllerExample/phpInfo
    public function phpInfo()
    {
    	phpinfo();
    }
    

  /*  模型名	约定对应数据表（假设数据库的前缀定义是 think_）
      User	think_user
      UserType	think_user_type   
   */   
    public function databseNameTest()
    {
       $Id = "03f41eb5656c333a3207d1162a6f216a";
       $channelData = new ChannelTestData();
       $data = $channelData->_get_test_data();
       echo "select返回的值是二维数组,可以通过array或者object来得到值 "."<br />";      
       echo "1. 通过array来得到值"."<br />";
       for($i=0;$i<count($data);$i++){
       	  $channelName = $data[$i][DB_CHANNELTESTDATA_CHANNELNAME];
       	  echo "array => ".$i." => ".$channelName."<br />";
       } 
       echo "2. 通过object来得到值"."<br />";
       foreach($data as $key=>$value){
       	  echo "object => ".$key." => ".$value->channelName."<br />";
       }
       
       echo "----------------------------"."<br />";
       
       echo "find返回的值是二维数组,可以通过array或者object来得到值"."<br />";
       $oneData = $channelData->_get_one_test_data($Id);
       echo "1. 通过array来得到值"."<br />";
       for($j=0;$j<count($oneData);$j++){
       	  echo "array => ".$j." => ".$data[$j][DB_CHANNELTESTDATA_CHANNELNAME]."<br />";
       }
       echo "2. 通过object来得到值"."<br />";
       echo "object => ".$oneData->channelName."<br />";
       
       echo "----------------------------"."<br />";
       
       $oneChannel = ChannelTestData::find($Id);
       //dump($oneChannel->toArray());
       echo "find()返回的值,array和object直接输出"."<br />";
       echo " object => ".$oneChannel->channelName."<br />";
       echo " array => ".$oneChannel[DB_CHANNELTESTDATA_CHANNELNAME]."<br />";
       echo "all()返回的值"."<br />";
       $moreChannel = ChannelTestData::all();
       echo "1. 通过object来得到值"."<br />";
       foreach($moreChannel as $key=>$value){
       	 echo "object ".$key." => ".$value->channelName."<br />";
       }
       echo "2. 先转化为collection,再转化为数组,通过array来得到值"."<br />";
       $result = new Collection($moreChannel);
       //dump($result->toArray());
       for($k=0;$k<count($result);$k++){
       	  echo "collection ".$k." => ".$result[$k][DB_CHANNELTESTDATA_CHANNELNAME]."<br />"; 
       }

    }
       
}

