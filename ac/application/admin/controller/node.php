<?php
public function tupu() {
		if (is_post()) {

			if (input('post.us_account')) {
				$info = model('User')->where('us_account|us_tel|us_real_name', input('post.us_account'))->find();
				if (!$info) {
					return [
						'code' => 0,
						'msg' => '该用户不存在',
					];
				}
			}

			$znote = jiedian();

			$this->map[] = ['us_tree', 'like', $info['us_tree'] . "," . $info['id'] . "%"];
			$this->map[] = ['us_tree_long', '<=', $info['us_tree_long'] + 2];
			$list = model('User')->where($this->map)->select()->toArray();
			array_push($list, $info);
			$rrrrrarr = [
				0 => '[未激活]',
				1 => '[正常]',
				2 => '[被禁用]',
			];
			for ($i = 0; $i < 8; $i++) {
				if (isset($list[$i])) {
					$arr = $list[$i];
					$status = $rrrrrarr[$arr['us_status']];
					$qu = str_split($arr['us_tree_qu']);
					$length = $list[$i]['us_tree_long'] - $info['us_tree_long'];
					$calcu = cache('level')[$arr['us_level']];
					$qu_ye = [];
					$qu_ye = qu_yeji($arr['id']);

					if ($length == 0) {
						$key = 0;
					} elseif ($length == 1) {
						$key = 2 * $length + $arr['us_qu'] - 1;
					} else {
						$key = 2 * $length + $arr['us_qu'] + $qu[1] * 2 - 1;
					}

					$znote[$key]['name'] = $arr['us_account'];
					$znote[$key]['tel'] = $arr['us_tel'] . "(" . $arr['us_real_name'] . ")";
					$znote[$key]['zuo'] = "左:" . $qu_ye['l_ye'].  "," . $qu_ye['l_num'];
					$znote[$key]['you'] = "右:" . $qu_ye['r_ye'].  "," . $qu_ye['r_num'];
					$znote[$key]['level'] = $calcu['cal_name'].$status;
					$znote[$key]['k'] = $arr['id'];
					$znote[$key]['p'] = $arr['us_aid'];
					if ($arr['us_head_pic']) {
						$znote[$key]['source'] = $arr['us_head_pic'];
					}
				}
			}
			return [
				'code' => 1,
				'data' => $znote,
				'ptel' =>$info['a_tel'],
			];
		} else {
			$this->assign(array(
				'us_account' => input('id')?:model('User')->find()['us_account'],
			));
			return $this->fetch();
		}
	}


	/*
	区业绩
 */
public function qu_yeji($id){
	$left = model('User')->where("us_aid",$id)->where('us_qu',0)->find();

	$right = model('User')->where("us_aid",$id)->where('us_qu',1)->find();
	$l = 0;
	$r = 0;
	$ll = 0;
	$rr = 0;
	if(count($left)){
		if($left['us_status']){
			$l += 1;
			$ll += $left['us_rel'];
		}
		$where1[] = ['us_tree','like',$left['us_tree'].",".$left['id'].'%'];
		$where1[] = ['us_status','>',0];
		$l += model('User')->where($where1)->count();
		$ll += model('User')->where($where1)->sum('us_rel');
	}
	if(count($right)){
		if($right['us_status']){
			$r += 1;
			$rr += $right['us_rel'];
		}
		$where2[] = ['us_tree','like',$right['us_tree'].",".$right['id'].'%'];
		$where2[] = ['us_status','>',0];
		$r += model('User')->where($where2)->count();
		$rr += model('User')->where($where2)->sum('us_rel');
	}
	$arr = [];
	$arr['l_num'] = $l;
	$arr['l_ye'] = $ll;
	$arr['r_num'] = $r;
	$arr['r_ye'] = $rr;
	return $arr;
}

// 节点图
function jiedian() {
	return [
		0 => [
			'key' => 0,
			'parent' => 0,
			'source' => '/static/admin/img/toutou.png',
			'name' => '未注册',
		],
		1 => [
			'key' => 1,
			'parent' => 0,
			'source' => '/static/admin/img/toutou.png',
			'name' => '未注册', 
		],
		2 => [
			'key' => 2,
			'parent' => 0,
			'source' => '/static/admin/img/toutou.png',
			'name' => '未注册',
		],
		3 => [
			'key' => 3,
			'parent' => 1,
			'source' => '/static/admin/img/toutou.png',
			'name' => '未注册',
		],
		4 => [
			'key' => 4,
			'parent' => 1,
			'source' => '/static/admin/img/toutou.png',
			'name' => '未注册',
		],
		5 => [
			'key' => 5,
			'parent' => 2,
			'source' => '/static/admin/img/toutou.png',
			'name' => '未注册',
		],
		6 => [
			'key' => 6,
			'parent' => 2,
			'source' => '/static/admin/img/toutou.png',
			'name' => '未注册',
		],
	];
}