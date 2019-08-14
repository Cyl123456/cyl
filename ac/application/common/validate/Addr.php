<?php
namespace app\common\validate;

use think\Validate;

/**
 * 商城验证器
 */
class Addr extends Validate {
    
	protected $rule = [
		'addr_name'    => 'require',
		'addr_stree' => 'require',
		'addr_tel'  => 'require',
	];
	protected $field = [
		'addr_name' => '收货人',
		'addr_stree' => '收货地址',
		'addr_tel' => '收货电话',
	];
	protected $message = [
		
	];
	protected $scene = [
		'addr' => ['addr_name','addr_stree', 'addr_tel'], //添加地址
	];

}
