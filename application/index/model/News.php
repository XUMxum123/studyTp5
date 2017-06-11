<?php 
namespace app\index\model;
use think\Model;

class News extends Model
{
	protected $table = DB_NEWS_TAB;
		
	/*
	 * if save success, return 1
	 * */
	public function saveInfo($data){
		$affectRow = $this->save($data);
		return $affectRow;
	}
	

	public function updateInfoByCondition($condition,$data){
		$affectRow = $this->where($condition)->update($data);
		return $affectRow;  
	}
	
	/* 
	 * if not delect any row, return 0
	 *  */
	public function deleteInfoByCondition($condition){
		$affectRow = $this->where($condition)->delete();
		return $affectRow;
	}
}
?>