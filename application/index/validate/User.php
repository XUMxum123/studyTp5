<?php
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
	protected $rule = [
			'name'  => 'require|max:25',
			'age'   => 'number|between:1,100',
		    'email' => 'email'
	];
	protected $message	=	[
			'name.require'	=>	'Ãû³Æ±ØÐë',
			'name.max'		=>	'Ãû³Æ×î¶à²»ÄÜ³¬¹ý25¸ö×Ö·û',
			'age.number'	=>	'ÄêÁä±ØÐëÊÇÊý×Ö',
			'age.between'	=>	'ÄêÁäÖ»ÄÜÔÚ1-100Ö®¼ä',
			'email'			=>	'ÓÊÏä¸ñÊ½´íÎó',
	];
}
