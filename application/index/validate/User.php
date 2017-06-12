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
			'name.require'	=>	'���Ʊ���',
			'name.max'		=>	'������಻�ܳ���25���ַ�',
			'age.number'	=>	'�������������',
			'age.between'	=>	'����ֻ����1-100֮��',
			'email'			=>	'�����ʽ����',
	];
}
