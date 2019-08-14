<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Db;

/**
 * 乱七八糟控制器
 */
class Cron extends Base {


	public function bbb(){
		$l = model('User')->field('us_level','<>',0)->select();
		if($l){
			foreach ($l as $k => $v) {
				Db::name('user')->where('id',$v['id'])->setfield('us_level',0);
			}
		}
	}

	public function aaa(){
		$list = model('User')->field('id,us_path')->select();
		/*
			
			$zz = "左:" . $qu_ye['l_ye'].  "," . $qu_ye['l_num'];
			$yy = "右:" . $qu_ye['r_ye'].  "," . $qu_ye['r_num'];

		 */
		foreach ($list as $k => $v) {
			$yeji = qu_yeji($v['id']);
			if($yeji['l_ye']<$yeji['r_ye']){
				$ye = $yeji['l_ye'];
			}else{
				$ye = $yeji['r_ye'];
			}
			if($ye>=480000){
				Db::name('user')->where('id',$v['id'])->setfield('us_level',1);
				$this->up($v['us_path']);
			}
		}
		halt(123);
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
			$inf = model('User')->get($id);
			if($inf['us_level']==$level){
				$count = model('User')->where('us_level',$level)->where('us_pid',$inf['id'])->count();
				if($count>=2){
					$level = $level+1;
					Db::name('user')->where('id',$inf['id'])->setfield('us_level',$level);
				}else{
					return;
				}
			}else{
				return;
			}
		}
		return true;
	}


	// public function crrcrr(){
	// 	$rel = Db::query('truncate table new_pro_msc');
	// 	halt($rel);
	// }
	//领导分红奖励
	public function leader(){
		$yj_count = model('User')->whereTime('us_active_time','last month')->count();
		$yeji = $yj_count*cache('setting')['cal_bd'];
		$yj = $yeji*cache('setting')['cal_leader']/100;
		$li_1 = model('User')->where('us_level',1)->where('us_status',1)->select();
		$li_2 = model('User')->where('us_level',2)->where('us_status',1)->select();
		$li_3 = model('User')->where('us_level',3)->where('us_status',1)->select();
		$li_4 = model('User')->where('us_level',4)->where('us_status',1)->select();
		$li_5 = model('User')->where('us_level',5)->where('us_status',1)->select();
		$co_1 = count($li_1);
		$co_2 = count($li_2);
		$co_3 = count($li_3);
		$co_4 = count($li_4);
		$co_5 = count($li_5);
		
		if($co_1){
			$le_1 = $yj*10/100/$co_1;
			foreach ($li_1 as $v_1) {
				model("User")::usMscChange($v_1['id'],$le_1,7);
			}
		}
		if($co_2){
			$le_2 = $yj*15/100/$co_2;
			foreach ($li_2 as $v_2) {
				model("User")::usMscChange($v_2['id'],$le_2,7);
			}
		}
		if($co_3){
			$le_3 = $yj*20/100/$co_3;
			foreach ($li_3 as $v_3) {
				model("User")::usMscChange($v_3['id'],$le_3,7);
			}
		}
		if($co_4){
			$le_4 = $yj*25/100/$co_4;
			foreach ($li_4 as $v_4) {
				model("User")::usMscChange($v_4['id'],$le_4,7);
			}
		}
		if($co_5){
			$le_5 = $yj*30/100/$co_5;
			foreach ($li_5 as $v_5) {
				model("User")::usMscChange($v_1['id'],$le_1,7);
			}
		}
		
	}
	//董事分红奖励
	public function bonus(){
		$yj_count = model('User')->whereTime('us_active_time','last month')->count();
		$yeji = $yj_count*cache('setting')['cal_bd'];
		$yj = $yeji*cache('setting')['cal_manager']/100;
		$li_6 = model('User')->where('us_level',6)->where('us_status',1)->select();
		$li_7 = model('User')->where('us_level',7)->where('us_status',1)->select();
		$li_8 = model('User')->where('us_level',8)->where('us_status',1)->select();
		$li_9 = model('User')->where('us_level',9)->where('us_status',1)->select();
		$li_10 = model('User')->where('us_level',10)->where('us_status',1)->select();
		$co_6 = count($li_6);
		$co_7 = count($li_7);
		$co_8 = count($li_8);
		$co_9 = count($li_9);
		$co_10 = count($li_10);

		if($co_6){
			$le_6 = $yj*10/100/$co_6;
			foreach ($li_6 as $v_6) {
				model("User")::usMscChange($v_6['id'],$le_6,8);
			}
		}
		if($co_7){
			$le_7 = $yj*15/100/$co_7;
			foreach ($li_7 as $v_7) {
				model("User")::usMscChange($v_7['id'],$le_7,8);
			}
		}
		if($co_8){
			$le_8 = $yj*20/100/$co_8;
			foreach ($li_8 as $v_8) {
				model("User")::usMscChange($v_8['id'],$le_8,8);
			}
		}
		if($co_9){
			$le_9 = $yj*25/100/$co_9;
			foreach ($li_9 as $v_9) {
				model("User")::usMscChange($v_9['id'],$le_9,8);
			}
		}
		if($co_10){
			$le_10 = $yj*30/100/$co_10;
			foreach ($li_10 as $v_10) {
				model("User")::usMscChange($v_10['id'],$le_10,8);
			}
		}

	}


}
