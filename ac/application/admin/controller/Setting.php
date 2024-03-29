<?php
namespace app\admin\controller;

use Cache;

/**
 * @todo 配置信息管理
 */
class Setting extends Common {
	public function _initialize() {
		parent::_initialize();
	}
	// --- ---------------------------------------------------------------------
	//
	public function index() {
		if (is_post()) {
			$data = input('post.');
			model('SysConfig')->xiugai($data);
			$this->success('修改成功');
		}
		return $this->fetch();
	}
	//系统参数
	public function system() {

		if(is_post()){
			$data = input('post.');
			if($data['type']==1){
				$rel = db('calcu')->where('id',$data['i'])->setfield($data['key'],$data['val']);
				
			}else{
				$rel = db('jing')->where('id',$data['i'])->setfield($data['key'],$data['val']);
			}
			if($rel){
				Cache::clear();
			}
		}

		$this->assign(array(
			'list'=> cache('level'),
		));
		return $this->fetch();
	}
	//
	public function edit() {
		if (is_post()) {
			$data = input('post.');
			$rel = model('Calcu')->xiugai($data);
			return $rel;
		}

		$k = input('id') - 1;
		dump($k);
		$this->assign(array(
			'k' => $k,
		));
		return $this->fetch();
	}

	/*-------------------轮播图*/
	public function shuff(){

		if (is_numeric(input('get.status'))) {
			$this->map[] = ['shuff_status', '=', input('get.status')];
		}
		if (input('get.keywords')) {
			$this->map[] = ['shuff_name', 'like', "%".input('get.keywords')."%"];
		}
		
		$list = model('Shuff')->chaxun($this->map,$this->order,$this->size);
		$this->assign(array(
			'list'=>$list,
		));
		return $this->fetch();
	}
	public function shuff_add(){
		if (is_post()) {
			$data = input('post.');
			// halt($data);
			$file = request()->file('file');

			if($file){
				$base = uploads($file);
				if($base['code']){
					$data['shuff_pic'] = $base['path'];
				}else{
					return $base;
				}
			}
			//验证器
			$validate = validate('Other');
			$res = $validate->scene('addshuff')->check($data);
			if (!$res) {
				$this->error($validate->getError());
			}

			$rel = model('Shuff')->tianjia($data);
			return $rel;
		}
		return $this->fetch();
	}
	public function shuff_edit(){
		
		if(is_post()){
			$data = input('post.');
			$file = request()->file('file');
			if($file){
				$base = uploads($file);
				if($base['code']){
					$data['shuff_pic'] = $base['path'];
				}else{
					return $base;
				}
			}
			$rel = model('Shuff')->update($data);
			return ['code'=>1,'msg'=>'修改成功'];
		}else{
			$this->assign('info',model("Shuff")->where('id',input('id'))->find());
			return $this->fetch();
		}
		
	}


	public function shuff_del(){
		if (input('post.id')) {
			$id = input('post.id');
		} else {
			$this->error('id不存在');
		}
		$info = db('shuff')->where('id',$id)->find();
		if ($info) {
			$rel = model('Shuff')->destroy($id);
			if ($rel) {
				$this->success('删除成功');
			} else {

				$this->error('请联系网站管理员');
			}
		} else {
			$this->error('数据不存在');
		}
	}
	//项目文档
	public function api() {
		return $this->fetch();
	}
	public function document() {
		$path = env('ROUTE_PATH');
		$swagger = \Swagger\scan($path);
		header('Content-Type: application/json');
		echo $swagger;
	}
}
