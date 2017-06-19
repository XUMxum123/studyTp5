<?php 
namespace app\TestAppExample\model;
use think\Model;


/* 
 * 在 find和select和paginate方法之前可以使用所有的链式操作方法
 * 默认情况下，find和select方法返回的都是数组
 * 
 * 数据库名字的大小写,包括其中表的名字大小写和字段名字的大小写，
 * 都不能写错, 尤其是在定义常量的时候(define.php等其他文件)
 * 如: 数据库名字的test,不能写成Test或则其他
 *     数据表名字为channeltest,不能写成channelTest或则其他
 *     字段名字为channelName,不能写成channelname或则其他
 *     等等...
 * 
 *  */
class ChannelTestData extends Model
{
	/* 
	 * 如果这里不写protected $table = DB_CHANNELTESTDATA_TAB,
	 * 那么数据库里必须要有channel_test_data这个表,要不然会提示找不到这张表
	 * 因为要和ChannelTestData这个类名相对应,遇到大写字母就加"_",并变成小写
	 * 这样就变成channel_test_data,
	 * 
	 * 如果这里写protected $table = DB_CHANNELTESTDATA_TAB
	 * 那么真正的table就是我们自己定义的,和ChannelTestData这个类名没有任何关系
	 *  
	 *  */
	protected $table = DB_CHANNELTESTDATA_TAB;
	
    /* protected  $connection = [
		'resultset_type' => 'collection'
	]; */
	
	public function _get_test_data()
	{
		$data = $this->select();
		return $data;
	}
	
	public function _get_one_test_data($Id)
	{
		$where = [DB_CHANNELTESTDATA_CHANNELID => $Id];
		$data = $this->where($where)->find();
		return $data;
	}
	
	
}
?>