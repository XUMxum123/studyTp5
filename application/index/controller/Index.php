<?php
namespace app\index\controller;

use \think\Request;
use \think\Loader;
//use \think\View;
use \think\Controller;

use \think\Cache;
use \think\Cookie;
use \think\Log;
use \think\Validate;
use \think\Image;
use \think\helper\Time;
use \app\index\model\Nbateam;
use \app\index\model\News;
use think\console\command\Clear;

class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    
    public function phpInfo()
    {
    	phpinfo();
    }
    
    // 如果开启了'url_convert' => true 这个选项
    // 那么$this->fetch()会定位到全部为小写的html文件 如:exampletypefunction.html
    // 也就是说会把   当前模块/当前控制器/view/  下面的html名字全部转化为小写
    // 如本例测试, view下面html文件名字是exAmpLetYPefUnCTion,转化小写exampletypefunction
    public function ExampleTypeFunction()
    {
    	$this->assign("name","yyy");
    	return $this->fetch();
    }
    
    // 当前模块/默认视图目录/当前控制器（小写）/当前操作（小写）.html
    /*
     * {$varname.aa	??	'xxx'}
              表示如果有设置$varname则输出$varname,否则输出'xxx'。	解析后的代码为：
       <?php echo isset($varname['aa'])	?	$varname['aa']:'默认值';?>
       
       {$varname?='xxx'}	
              表示$varname为真时才输出xxx。	解析后的代码为：
       <?php if(!empty($name))	echo 'xxx';?>
       
       {$varname?:'no'}
              表示如果$varname为真则输出$varname，否则输出no。解析后的代码为：
       <?php echo $varname ? $varname:'no';	?>
       
       {$a==$b?'yes':'no'}
              前面的表达式为真输出yes,否则输出no，	条件可以是==、===、!=、!==、>=、<=
     * */
    
    public function test()
    {
    	//Log::record("开始测试");
     	$data = [
     			'name'  => 'xyzxyz',
     			'age'   => 20,
     			'email' => '1234567@163.com'
     	];
     	$resultValidate = $this->validate($data,'User');
     	$datFormValidate = Validate::dateFormat('2016-03-09','Y-m-d');
     	$validate = Loader::validate('User');
     	try{
     		if($validate->check($data)){
     			$this->assign('msg','success');
     			$this->assign('resultValidate',$resultValidate);
     			$this->assign('datFormValidate',$datFormValidate);
     		}else{
     			$this->assign('msg','fail');
     			dump($validate->getError());
     		}
     	}catch (\Exception $e){
     		$this->error("error","index/index");
     	}
     	//$this->success("success","index/database");
     	
     	/* 变量修饰  
     	 * input('get.name/s') 
     	 * input('post.name/s')
     	 * Request::instance()->get('name/s')
     	 * Request::instance()->post('name/s')
     	 */
    	$name = Request::instance()->param('name'); // input('name')
    	$id = Request::instance()->param('id');  // input('id')
    	$list = array("x"=>"xxx","y"=>"yyy","z"=>"zzz");
    	$dimensionList = array(array("x"=>"xxx","y"=>"yyy"),array("z"=>"zzz","a"=>"aaa"),array("b"=>"bbb","c"=>"ccc"));
    	//dump($dimensionList);
    	$this->assign('name',$name);
    	$this->assign('id',$id);
    	$this->assign('list',$list);
    	$this->assign('dimensionList',$dimensionList);
    	$this->assign('thinkVersion',THINK_VERSION);
    	return $this->fetch();
    }
    
    public function database()
    {
    	$nbaTeam = new Nbateam();
    	$data = $nbaTeam->_get_test_data();
    	//if(!$data->isEmpty()){
    		$this->assign('data', $data);
    	//}   	
    	//var_dump($nbaTeam->getlastsql());
    	//dump($data);
    	$cacheData = "cache-cache-cache";
        cache("cacheData",$cacheData);
        //cache("cacheData",null);
        //Cache::clear();
        dump(cache("cacheData"));
        session('cacheData', $cacheData);
        //session(null);
        dump(session('cacheData'));
        cookie('cacheData', $cacheData);
        //cookie('cacheData', null);
        //Cookie::clear();
        dump(cookie('cacheData'));
    		
    		
    	return $this->fetch();
    }
    
    public function hello()
    {
    	$request = Request::instance();
    	echo "当前模块名称是：" . $request->module()."<br />";
    	echo "当前控制器名称是：" . $request->controller()."<br />";
    	echo "当前操作名称是：" . $request->action()."<br />";
    	echo '请求方法：' . $request->method() . '<br/>';
    	echo '资源类型：' . $request->type() . '<br/>';
    	echo '访问地址：' . $request->ip() . '<br/>';
    	echo '是否AJax请求：' . var_export($request->isAjax(), true) . '<br/>';
    	echo 'user-agent类型：' . $request->header('user-agent') . '<br/>';
    	echo 'today is：' . getWeekDayByCurrentDate() ."<br />";
    	return $this->fetch();
    	//return 'xum-hello'."<br />";
    }
    
    public function paginate()
    {
    	$currentPage = Request::instance()->param('page');
    	if(empty($currentPage)){
    		$currentPage = 1;
    	}
    	$nbaTeam = new Nbateam();
    	$list_rows = 7; // 每页显示多少
    	$list = $nbaTeam->_get_team_by_paginate($list_rows);
    	$this->assign('list', $list);
    	$this->assign('currentPage', $currentPage);
    	$this->assign('list_rows', $list_rows);
/*     	echo $_SERVER['SCRIPT_FILENAME']."<br />";
    	echo APP_PATH."<br />";
    	echo ROOT_PATH; */
    	return $this->fetch();
    }
    
    // 这个方法有问题，如果页面刷新，数据会重新提交，应该用ajax异步提交
    public function upload()
    {  	
    	$uploadFileName = "";
    	if(Request::instance()->isPost()){  		
    		$files = request()->file("fileName");
    		foreach($files as $file){
    			$info = $file->move(__UPLOAD_PATH__, "");
    			$uploadFileName = $info->getFilename();
    			if($info){
                    //echo $info->getExtension()."<br />";
    				//echo $info->getSaveName()."<br />";
    				//echo $info->getFilename()."<br />";  				    				
    				$this->assign("message","upload success");
    			}else{
    				//echo $file->getError();
    				$this->assign("uploadFileName","");
    				$this->assign("message","upload error, please check it");
    			}
    		}
    		$this->assign("uploadFileName",$uploadFileName);
    		return $this->fetch();
    	}else{
    		//echo "==> ".Request::instance()->isPost();
    		$this->assign("uploadFileName",$uploadFileName);
    		$this->assign("message","");
    		return $this->fetch();
    	}
    }
     
    public function helperTime()
    {
    	list($start, $end) =  Time::today();
    	//echo $start."  ".$end;
    	$nbateam = db(DB_NBATEAM_TAB);
    	$where = [
    			DB_NBATEAM_ALLIANCE => ['eq','East'],
    			DB_NBATEAM_ID       => ['like','%'],
    			DB_NBATEAM_WIN      => [['gt',50],['lt',60],'and']
    	];
    	$list = $nbateam->where($where)->select();
    	//echo $Think.version;
    	dump($list);
    }
    
    /* 
     * 必须是\think\Image,不是\Think\Image
     * 前提还有就是GD库必须能用，而且要打开
     * 路径已经限制在public这个文件夹了
     *  如果图像的宽度或则高度没有我们需要裁减的大，那么这个图像会拉伸到我们需要的
     *	如: 原始图像的高度是75像素,我们需要裁减到100像素,那么此时图像会拉伸到100像素,图像变形了
     *  */
    public function handleImage()
    {
    	//phpinfo();
    	// $files = request()->file("fileName");
    	$rootPath = 'static'.DS.'index'.DS.'images'.DS;
    	$fileName = 'test.jpg';
    	$image = \think\Image::open($rootPath.$fileName);
    	$width = $image->width();
    	$height = $image->height();
    	$type = $image->type();
    	$mime = $image->mime();
    	$size = $image->size();
        //echo "width  => ".$width."<br />";
        //echo "height => ".$height."<br />";
        //echo "type   => ".$type."<br />";
        //echo "mime   => ".$mime."<br />";
        //echo "size   => ".$size[0]." | ".$size[1]."<br />"; 
    	if($width <= 75){
    		$cropWidth = $width;
    		$cropX = 0;
    	}else{
    		$cropWidth = 75;
    		$cropX = $width/2 - 37;
    	}
    	if($height <= 75){
    		$cropHeight = $height;
    		$cropY = 0;
    	}else{
    		$cropHeight = 75;
    		$cropY = $height/2 - 37;
    	}
    	// crop image
    	//$result = $image->crop($cropWidth, $cropHeight, $cropX, $cropY)->save($rootPath."1.jpg");
    	//dump($result);
    	
    	// thumb image
    	//$result = $image->thumb(200, 200, \think\Image::THUMB_CENTER)->save($rootPath."2.jpg");
    	//dump($result);
    	
    	// flip image
    	//$result = $image->flip(\think\Image::FLIP_X)->save($rootPath."4.jpg");
    	//dump($result);
    	
    	// rotate image
    	//$result = $image->rotate(45)->save($rootPath."5.jpg");
    	//dump($result);
    	
    	// water image
    	//$result = $image->water($rootPath."3.jpg", \think\Image::THUMB_NORTHWEST, 80)->save($rootPath."4.jpg");
    	//dump($result);
    }
    
    public function createCaptcha()
    {
    	return $this->fetch();
    }
    
    public function checkCaptcha()
    {
    	$captchaValue = input('captchaValue');
    	return captcha_check($captchaValue);
    }
    
    public function curd()
    {
    	$nbaTeam = new Nbateam();
    	$data = $nbaTeam->_get_team_info();
    	//var_dump($data);
    	$this->assign('xum','hello');
    	$this->assign('data',$data);
    	$target = "index/curd";
    	//echo $nbaTeam->getLastSql();
    	
/*     	$news = new News();
    	$Id = '9c15510439db8e218879aabc43fde91e';
    	$condition = [
    			       DB_NEWS_ID => '9c15510439db8e218879aabc43fde91e'
    	             ];
    	$data = [    			 			   
    			   DB_NEWS_TITLE => 'title',
    			   DB_NEWS_CONTENT => 'xum'  			
    	        ];   */ 
    	/*$result = $User->validate(true)->save($data); may be */
    	//echo $news->saveInfo($data);
    	//echo $news->updateInfoByCondition($condition,$data);
    	//echo $news->deleteInfoByCondition($condition);
/*     	$news = model(DB_NEWS_TAB);
    	// 模型对象赋值
    	$news->data([
    			DB_NEWS_ID => '9c15510439db8e218879aabc43fde91e',
    			DB_NEWS_TITLE => 'xum-title',
    			DB_NEWS_CONTENT => 'xyzxyzxyzxyzxyzxyzxyz'
    	]);
    	$news->save(); */
    	
    	return $this->fetch($target);
    	
    	//return $this->display($target,['xum'=>'xxx']);
    }
    
    /*
     * $headerInfo = Request::instance()->header();
     *   
     *   */
    
}
