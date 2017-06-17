<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/* ----- common function ----- */

/** Generates an UUID
 * @param string  an optional prefix
 * @return string  the formatted uuid
 */
function uuid($prefix = ''){
	$chars = md5(uniqid(mt_rand(), true));
	$uuid  = substr($chars,0,8);
	$uuid .= substr($chars,8,4);
	$uuid .= substr($chars,12,4);
	$uuid .= substr($chars,16,4);
	$uuid .= substr($chars,20,12);
	return $prefix.$uuid;
}

/** Get the WeekDay by the CurrentDate
 * @return string  weekDay
 * */
function getWeekDayByCurrentDate(){
	$currentTime = date("Y-m-d"); // get current date
	$dayNumber = date('w',strtotime($currentTime)); //generate day number(0,1,2,3,4,5,6)
	switch($dayNumber)
	{
		case "0": $weekDay = "Sunday"; break;
		case "1": $weekDay = "Monday"; break;
		case "2": $weekDay = "Tuesday"; break;
		case "3": $weekDay = "Wednesday"; break;
		case "4": $weekDay = "Thursday"; break;
		case "5": $weekDay = "Friday"; break;
		case "6": $weekDay = "Saturday"; break;
		 default: $weekDay = "none";
	}
	return $weekDay;
}