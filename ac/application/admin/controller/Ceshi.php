<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Db;

/**
 * 乱七八糟控制器
 */
class Ceshi extends Base {


	public function maomao(){
		$info = Db::name('user')->where('us_account','DLL0232')->find();
		$qu_all = qu_yeji($info['id']);
		$qu_five = qu_five_yeji($info['id']);
		$qu_six = qu_six_yeji($info['id']);

		dump($qu_all);
		dump($qu_five);
		dump($qu_six);
		halt($info);
		// $qu = $info['us_tree_qu'];
		// dump($qu);
		// halt($qu[6]);
	}

}
