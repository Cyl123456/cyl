<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use think\Db;
/**
 *
 */
class User extends Model {
	use SoftDelete;
	protected $deleteTime = 'delete_time';

	public function parent() {
		return $this->hasOne('User', 'id', 'us_pid');
	}
	// 状态
	public function getStatusTextAttr($value, $data) {
		$array = [
			0 => '未激活',
			1 => '正常',
			2 => '被禁用',
		]; 
		return $array[$data['us_status']];
	}
	public function getLevelTextAttr($value,$data){
		return cache('level')[$data['us_level']]['cal_name'];
	}
	//父账号
	public function getPtelAttr($value, $data) {
		if ($data['us_pid']) {
			return $this->where('id', $data['us_pid'])->value('us_account');
		} else {
			return '空';
		}
	}
	//节点人
	public function getAtelAttr($value, $data) {
		if ($data['us_aid']) {
			return $this->where('id', $data['us_aid'])->value('us_account');
		} else {
			return '空';
		}
	}
	//详情
	public function detail($where, $field = "*") {
		
		return $this->with('parent')->where($where)->field($field)->find();
	}
	//查询
	public function chaxun($map, $order, $size, $field = "*") {
		return $this->where($map)->order($order)->field($field)->paginate($size, false, [
			'query' => request()->param()]);
	}
	/**
	 * 添加
	 * @param  [array] $data [description]
	 * @return [bool]       [description]
	 */
	public function tianjia($da) {

		$validate = validate('User');
		$res = $validate->scene('addUser')->check($da);
		if (!$res) {
			return [
				'code'  =>  0,
				'msg'	=>  $validate->getError(),
			];
		}

		// $tel_count = $this->where('us_tel', $da['us_tel'])->count();
		// if ($tel_count) {
		// 	return [
		// 		'code' => 0,
		// 		'msg' => '该手机号已存在',
		// 	];
		// }
		$acc_count = $this->where('us_account', $da['us_account'])->count();
		if ($acc_count) {
			return [
				'code' => 0,
				'msg' => '该账号已存在',
			];
		}
		
		$pinf = model("User")->where('us_account', $da['p_acc'])->find();
		if (count($pinf)) {
			$da['us_pid'] = $pinf['id'];
			$da['us_path'] = $pinf['us_path'] . ',' . $pinf['id'];
			$da['us_path_long'] = $pinf['us_path_long'] + 1;
		} else {
			return [
				'code' => 0,
				'msg' => '推荐人不存在',
			];
		}
		//节点人
		$ainf = model("User")->where('us_account', $da['a_acc'])->find();
		if (count($ainf)) {
			$da['us_aid'] = $ainf['id'];
			$da['us_tree'] = $ainf['us_tree'] . ',' . $ainf['id'];
			$da['us_tree_long'] = $ainf['us_tree_long'] + 1;
			$da['us_tree_qu'] = $da['us_qu'].$ainf['us_tree_qu'];
		}else{
			return [
				'code' => 0,
				'msg' => '节点人不存在',
			];
		}
		

		$wei = $this->where('us_aid',$ainf['id'])->where('us_qu',$da['us_qu'])->find();
		if($wei){
			return [
				'code' => 0,
				'msg' => '该节点已存在',
			];
		}

		$da['us_add_time'] = date('Y-m-d H:i:s');
		$da['us_head_pic'] = '/static/mobile/img/tu9.jpg';
		$da['us_pwd'] = mine_encrypt($da['us_pwd']);
		$da['us_safe_pwd'] = mine_encrypt($da['us_safe_pwd']);
		$rel = $this->insertGetId($da);
		if($rel){

			return [
				'code' => 1,
				'msg' => '注册成功',
				'id' => $rel,
				'us_account' => $da['us_account'],
			];

		}else{
			return [
				'code' => 0,
				'msg' => '注册失败',
			];
		}
		
	}

	/**
	 * 修改
	 * @param  [array] $data  [数据]
	 * @param  [array] $where [条件]
	 * @return [bool]
	 */
	public function editInfo($da) {
		
		if (isset($da['us_pwd'])) {
			$da['us_pwd'] = mine_encrypt($da['us_pwd']);
		} elseif(key_exists('us_pwd',$da)) {
			unset($da['us_pwd']);
		}
		
		if (isset($da['us_safe_pwd'])) {
			$da['us_safe_pwd'] = mine_encrypt($da['us_safe_pwd']);
		} elseif(key_exists('us_safe_pwd',$da)) {
			unset($da['us_safe_pwd']);
		}
		
		// halt($da);
		model('User')->update($da);
		return [
			'code' => 1,
			'msg' => '修改成功',
		];
	}
	//送币
	public function songbi($da){
		if($da['song_type']==1){
			if($da['song_num']>0){
				$type = 1;
			}else{
				$type = 2;
			}
			return self::usWalChange($da['id'],abs($da['song_num']),$type);
			
		}elseif($da['song_type']==2){
			if($da['song_num']>0){
				$type = 1;
			}else{
				$type = 2;
			}
			return self::usMscChange($da['id'],abs($da['song_num']),$type);
		}elseif($da['song_type']==3){
			if($da['song_num']>0){
				$type = 1;
			}else{
				$type = 2;
			}
			return self::usSalChange($da['id'],abs($da['song_num']),$type);
		}
	}
	//茶币变动
	static public function usWalChange($us_id,$num,$type){
		$note = array(
			1 => '后台赠送',
			2 => '后台扣除',
			3 => '会员报单',
			4 => '用户转出',
			5 => '用户转入',
			6 => '用户转换',
			7 => '购买商品',
			8 => '报单复投',
		);
		if (in_array($type, array(1,5,6))) {
			$rel = self::where('id', $us_id)->setInc('us_wal', $num);
		} else{
			$rel = self::where('id', $us_id)->setDec('us_wal', $num);
		}
		if($rel){
			model('ProWal')->tianjia($us_id,$num,$type,$note[$type]);
			return [
				'code' => 1,
				'msg' => '成功',
			];
		}else{
			return [
				'code'=>0,
				'msg' => '失败',
			];
		}
	}
	//奖励变动
	static public function usMscChange($us_id,$num,$type,$name=''){
		// halt($us_id);
		$note = array(
			1 => '后台赠送',
			2 => '后台扣除',
			3 => '获得'.$name.'直推奖励',
			4 => '获得'.$name.'层碰奖励',
			5 => '获得'.$name.'对碰奖励',
			6 => '用户转换',
			7 => '领导分红奖',
			8 => '董事分红奖',
			9 => '提现',
			10 => '团队奖励',
			11 => '提现驳回',
			12 => '获得'.$name.'复投见点奖',
			13 => '获得'.$name.'复投对碰奖',
			14 => '获得'.$name.'购物见点奖',
		);
		if($type==5){

			$nun = ProMsc::where('us_id',$us_id)->where('msc_type',5)->whereTime('msc_add_time','today')->sum('msc_num');
			if($nun>=cache('setting')['cal_peng_top']){
				return [
					'code' => 0,
					'msg' => '对碰奖已封顶',
				];
			}
			$num = cache("setting")['cal_peng_pro'];
		}

		if($type==13){
			$nun = ProMsc::where('us_id',$us_id)
				->where('msc_type',$type)->whereTime('msc_add_time','today')
				->sum('msc_num');
			if($nun>=cache('setting')['cal_peng_top']){
				return [
					'code' => 0,
					'msg' => '对碰奖已封顶',
				];
			}
			$num = cache('setting')['recover_peng_pro'];
		}
		if (in_array($type, array(1,3,4,5,7,8,10,11,12,13,14))) {

			$rel = self::where('id', $us_id)->setInc('us_msc', $num);
			
		} else{
			$rel = self::where('id', $us_id)->setDec('us_msc', $num);
		}
		if($rel){
			ProMsc::tianjia($us_id,$num,$type,$note[$type]);
			return [
				'code' => 1,
				'msg' => '成功',
			];
		}else{
			return [
				'code'=>0,
				'msg' => '失败',
			];
		}
	}

	//奖励变动
	static public function usSalChange($us_id,$num,$type,$name=''){
		// halt($us_id);
		$note = array(
			1 => '后台赠送',
			2 => '后台扣除',
			3 => '购物扣除',
		);

		if (in_array($type, array(1))) {

			$rel = self::where('id', $us_id)->setInc('us_sal', $num);
			
		} else{
			$rel = self::where('id', $us_id)->setDec('us_sal', $num);
		}
		if($rel){
			ProSal::tianjia($us_id,$num,$type,$note[$type]);
			return [
				'code' => 1,
				'msg' => '成功',
			];
		}else{
			return [
				'code'=>0,
				'msg' => '失败',
			];
		}
	}


	//直推奖励
	public function direct_pro($id){
		$info = $this->get($id);
		if($info['us_pid']){
			$parent = $this->get($info['us_pid']);
			if($parent && $parent['us_status']==1){
				$this->usMscChange($parent['id'],cache('setting')['cal_direct_pro'],3,$info['us_account']);
			}
		}
	}

	public function up($path){
		$lol = explode(',',$path);
		$arr = array_reverse($lol);


		/*
			
			$level = 1;
			判断父级level等不等于1  
				等于1  判断父级下面有没有两个等级1  
					有 升级


		*/

		$level = 1;
		for ($i=0; $i < count($arr); $i++) { 
			$id = $arr[$i];
			if($id==0){
				break;
			}
			$inf = $this->get($id);
			if($inf['us_level']==$level){
				$count = $this->where('us_level',$level)->where('us_pid',$inf['id'])->count();
				if($count>=2){
					$level = $level+1;
					db('user')->where('id',$inf['id'])->serfield('us_level',$level);
				}else{
					return;
				}
			}else{
				return;
			}
		}
		return true;
	}


	public function point($id){
		$info = $this->get($id);
		$lol = explode(',',$info['us_tree']);
		$arr = array_reverse($lol);
		
		for ($i=0; $i < count($arr); $i++) { 
			$us_id = $arr[$i];
			//见点奖励 
			if($i<cache('setting')['recover_point_dai'] && $us_id>0){
				// self::usMscChange($us_id,cache('setting')['recover_point_pro'],12,$info['us_account']);
				model("ProJd")->tianjia($us_id,cache('setting')['recover_point_pro'],12,$info['us_account']);
			}
		}
	}

	public function jd($id){
		$info = $this->get($id);
		$lol = explode(',',$info['us_tree']);
		$arr = array_reverse($lol);
		
			for ($i=0; $i < count($arr); $i++) { 
				$us_id = $arr[$i];
				//见点奖励 
				if($i<cache('setting')['shop_point_dai'] && $us_id>0){
					model("ProJd")->tianjia($us_id,cache('setting')['shop_point_pro'],14,$info['us_account']);
					// self::usMscChange($us_id,cache('setting')['shop_point_pro'],14,$info['us_account']);
				}
			}
	}
	
	//业绩
	public function yeji($id,$money,$type){
		$info = $this->get($id);

		//当前层的所有人
		$li = db('user')->where('us_tree_long',$info['us_tree_long'])->where('us_status',1)->field('id,us_tree_qu')->select();
		$crr = array_column($li,'us_tree_qu');
		//用户tree
		$lol = explode(',',$info['us_tree']);
		$arr = array_reverse($lol);
		$qu = $info['us_tree_qu'];

		for ($i=0; $i < count($arr); $i++) { 
			if(isset($arr[$i])){
				$acc = db('user')->where('id',$arr[$i])->find();
				$a = $i+1; //层数
				if($acc['us_status']){
					//层碰
					if($type == 5 && $i < cache('setting')['cal_ceng_dai']){
						$me_ee = substr($qu,$i+1);
						$l = 0;
						$r = 0;
						
						$crr_qu = $acc['us_tree_qu'];

						foreach ($crr as $value) {

							$search = '/'.$crr_qu.'$/';
							if(preg_match($search,$value)){
								$ee = substr($value,$i+1);
								if($ee==$me_ee){
									if($value[$i]==0){
										$l++;
									}else{
										$r++;
									}
								}
							}
						}

						$cpj = cache('setting')['cal_ceng_pro'];
						

						if($info['us_tree_qu'][$i]==0 && $l==1 && $r>0){
							$this->usMscChange($arr[$i],$cpj,4,$a."层".$info['us_account']);
						}

						if($info['us_tree_qu'][$i]==1 && $r==1 && $l>0){
							$this->usMscChange($arr[$i],$cpj,4,$a."层".$info['us_account']);
						}

						/*
						3   010   000 或 001 	
						4   011   000 或 001
						5   0100  0000 0001 0010 0011
						*/
					
					}
				
					$qu_ye = qu_six_yeji($arr[$i]);
					$xiaoqu = 0;
					
					if($qu[$i]==0){
						if($qu_ye['l_ye']<=$qu_ye['r_ye']){
							$xiaoqu = $qu_ye['l_ye'];
							if($i>=cache('setting')['cal_peng_dai']-1){
								$this->usMscChange($arr[$i],$money,$type,$a."层".$info['us_account']);
							}
						}else{
							$xiaoqu = $qu_ye['r_ye'];
						}
					}else{
						if($qu_ye['r_ye']<=$qu_ye['l_ye']){
							$xiaoqu = $qu_ye['r_ye'];
							if($i>=cache('setting')['cal_peng_dai']-1){
								$this->usMscChange($arr[$i],$money,$type,$a."层".$info['us_account']);
							}
						}else{
							$xiaoqu = $qu_ye['l_ye'];
						}
					}

					if($acc['us_level']==0){
						if($xiaoqu >= 480000){
							db('user')->where('id',$acc['id'])->setfield('us_level',1);
							$this->up($acc['us_path']);
						}
					}
					if($acc['us_level']>=5){
						$nn = $money * 2/100;
						$this->usMscChange($arr[$i],$nn,10,$info['us_account']);
					}

				}
			}
		}
	}
}
