<?php
  // 对系统自带的函数进行替换或者增加
  
// 增加一个新的table助手函数
function table($table, $config = [])
{
 return \think\Db::connect($config)->setTable($table);
}