<?php
namespace app\common\validate;

use think\Validate;

/**
 * 金额验证器
 */
class Profit extends Validate {
	protected $rule = [
        'us_tel'    => 'require|mobile',
        'tr_num'    => 'require|number|gt:0',
        'convert_num'    => 'require|number|gt:0',
		'sode'    => 'require',
		'tx_num' => 'require|number|gt:0',
		'tx_account' => 'require',
		'tx_name' => 'require',
		'tx_addr' => 'require',
		'us_safe_pwd' => 'require',
	];
	protected $field = [
        'us_tel' => '手机号',
		'tr_num' => '转让数量',
		'trans_account' => '对方账号',
        'convert_num' => '转换数量',
		'sode' => '短信验证码',
		'tx_num' => '提现金额',
		'tx_type' => '提现位置',
		'us_safe_pwd' => '交易密码',
	];
	protected $message = [
		
	];
	protected $scene = [
		'trans' => ['tr_account','tr_num', 'us_safe_pwd'],       //转账
		'convert' => ['convert_num', 'us_safe_pwd'], //转换
		'tx' => ['tx_num','us_safe_pwd','tx_type'], //提现
	];

}
