<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 *
 */
class ProTransfer extends Model {
	use SoftDelete;
	protected $deleteTime = 'delete_time';

	public function user() {
		return $this->hasOne('User', 'id', 'us_id');
	}
	public function userto() {
		return $this->hasOne('User', 'id', 'us_to_id');
	}

	//查询
	public function chaxun($map, $order, $size, $field = "*") {
		$list = $this->with('user,userto')->where($map)->order($order)->field($field)->paginate($size, false, [
			'query' => request()->param()]);
		return $list;
	}
	/**
	 * 添加
	 * @param  [array] $data [description]
	 * @return [bool]       [description]
	 */
	public function tianjia($da,$id) {
		$info = User::where('us_account',$da['tr_account'])->find();
		if(!$info){
			return [
				'code' => 0,
				'msg' => '用户不存在',
			];
		}
		$arr = [
			'us_id'       =>  $id,
			'us_to_id'    =>  $info['id'],
			'tr_num' 	  =>  $da['tr_num'],
			'tr_add_time' =>  date('Y-m-d H:i:s'),
		];

		$rel = $this->insertGetId($arr);

		if ($rel) {
			User::usWalChange($id,$da['tr_num'],4);
			User::usWalChange($info['id'],$da['tr_num'],5);
			return [
				'code' => 1,
				'msg' => '转账成功',
			];
		} else {
			return [
				'code' => 0,
				'msg' => '转账失败',
			];
		}
	}
	//转账账号
	public function getUsTextAttr($value, $data) {
		if ($data['us_id'] == "") {
			return '';
		}
		$name = model('User')->where('id', $data['us_id'])->value('us_account');
		return $name;
	}
	//转账姓名
	public function getUsNameAttr($value, $data) {
		if ($data['us_id'] == "") {
			return '';
		}
		$name = model('User')->where('id', $data['us_id'])->value('us_real_name');
		return $name;
	}
	//转入账号
	public function getUsToTextAttr($value, $data) {
		if ($data['us_to_id'] == "") {
			return '';
		}
		$name = model('User')->where('id', $data['us_to_id'])->value('us_account');
		return $name;
	}
	//转入姓名
	public function getUsToNameAttr($value, $data) {
		if ($data['us_to_id'] == "") {
			return '';
		}
		$name = model('User')->where('id', $data['us_to_id'])->value('us_real_name');
		return $name;
	}
}
