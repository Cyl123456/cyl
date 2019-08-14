<?php

namespace app\index\controller;
use think\Db;
use think\Request;

/**
 * 商城
 */
class Order extends Base
{
    public function cadd(){
        if (is_post()) {
            $d = input('post.');

            /**
             * 从购物车添加订单
             *  地址id   addr_id
             *  备注  order_note
             *  支付密码  us_safe_pwd
             *  购物车id组 arrid
             */
            $validate = validate('Shop');
            $res = $validate->scene('cartorder')->check($d);
            if (!$res) {
                $this->e_msg($validate->getError());
            }

            if(mine_encrypt($d['us_safe_pwd']) != $this->user['us_safe_pwd']){
                $this->e_msg('安全密码不正确');
            }else{
                unset($d['us_safe_pwd']);
            }
            //地址
            $addr = Db::name('user_addr')->where('id',$d['addr_id'])->find();
            if(!$addr){
                $this->e_msg('请选择有效地址');
            }

            // halt($d['arrid']);
            
            // $arr = explode(',',$d['arrid']); //购物车id汇总
            $arr = $d['arrid'];
            // halt($arr);
            $order_number = "AC" . time() . GetRandStr(3);


            // 扣积分
            
            $all_money = 0;
            foreach ($arr as $value) {
                // halt($value);
                $info = model('StoCart')->detail(['id'=>$value['id']]);
                if(!count($info)){
                    $this->e_msg('请从新从购物车提交请求');
                } 
                if($info->prod['prod_res']<$value['cart_num']){
                    $this>e_msg('产品'.$value['prod_name'].'库存不足');
                }

                $all_money += $info->prod['prod_price'] * $value['cart_num'];
            }

            if ($all_money > $this->user['us_sal']) {
                $this->e_msg('您的消费币不足');
            }
            // 处理数据并存表 
            foreach ($arr as $v) {
                // $cart = Db::name('sto_cart')->where('id',$v)->find();
               
                $prod = model("StoProd")->get($v['prod_id']);

                $order_sum = $v['prod']['prod_price'] * $v['cart_num'];

                if($prod['prod_is_gai']==1){
                    $kuai_id = Db::name('kuai_prod')->where('prod_id',$prod['id'])->order('id desc')->value('id');
                }else{
                    $kuai = [
                        'prod_id' => $prod['id'],
                        'prod_name' => $prod['prod_name'],
                        'prod_price' => $prod['prod_price'],
                        'prod_pic' => $prod['pic_text'][0],
                        'cate_name' => $prod['cate_text'],
                        'mer_name' => $prod['mer_text'],
                    ];
                    $kuai_id = model('KuaiProd')->tianjia($kuai);
                    Db::name('sto_prod')->where('id',$prod['id'])->setfield('prod_is_gai',1); 
                }
                //整理数据
                $data = array( //订单表
                    'order_number' => $order_number,
                    'kuai_id' => $kuai_id,
                    'prod_num' => $v['cart_num'],
                    'us_id' => $this->user['id'],
                    'mer_id' => $prod['mer_id'],
                    'order_money' => $order_sum,
                    'detail_status' => 1,
                    'detail_pay_time' => date('Y-m-d H:i:s'),
                );
                model('StoOrderDetail')->tianjia($data);
            }
            $datb = array( //订单号表
                'order_number' => $order_number,
                'addr_id' => $d['addr_id'],
                'addr_name' => $addr['addr_name'],
                'addr_stree' => $addr['addr_stree'],
                'addr_tel' => $addr['addr_tel'],
                'order_money' => $all_money,
                'us_id' => $this->user['id'],
            );
            $rel = model('StoOrder')->tianjia($datb);
            if ($rel['code']) {
                model('User')->usSalChange($this->user['id'],$all_money,3);
                foreach ($arr as $vv) {
                    $cart_info = model("StoCart")->detail(['id'=>$vv['id']]);
                    model('Stoprod')
                    ->where(['id' => $cart_info['prod_id']])
                    ->dec('prod_res', $vv['cart_num'])
                    ->inc('prod_sales', $vv['cart_num'])
                    ->inc('prod_sales_true', $vv['cart_num'])
                    ->update(); 
                    db('sto_cart')->where('id', $vv['id'])->delete();
                }
                model("User")->jd($this->user['id']);
                $this->s_msg('订单成功');
            }else{
                $this->e_msg('订单失败');
            }
        }
    }

    public function add(){
        if (is_post()) {
            $d = input('post.');
            /**
             * 支付密码   us_safe_pwd
             * 商品id    prod_id
             * 商品数量   prod_num
             * 地址id    addr_id
             * 备注信息   order_note
             */
           
            $validate = validate('Shop');
            $res = $validate->scene('order')->check($d);
            if (!$res) {
                $this->e_msg($validate->getError());
            }

            if(mine_encrypt($d['us_safe_pwd']) != $this->user['us_safe_pwd']){
                $this->e_msg('安全密码不正确');
            }else{
                unset($d['us_safe_pwd']);
            }
            //商品信息
            $prod = model('StoProd')->get($d['prod_id']);

            //判断库存
            if($prod['prod_res']<$d['prod_num'] || $prod['prod_res']<0){
                $this->e_msg('商品库存不足');
            }
            $addr = Db::name('user_addr')->where('id',$d['addr_id'])->find();
            if(!$addr){
                $this->e_msg('请选择有效地址');
            }

            $order_number = "AC" . time() . GetRandStr(3);

            //总价
            $all_money = $prod['prod_price'] * $d['prod_num'];
            
            if($all_money<=0){
                $this->e_msg('非法操作');
            }

            //算茶币
            if ($all_money > $this->user['us_sal']) {
                $this->e_msg('您的茶币不足');
            }
            if($prod['prod_is_gai']==1){
                $kuai_id = Db::name('kuai_prod')->where('prod_id',$prod['id'])->order('id desc')->value('id');
            }else{
                $kuai = [
                    'prod_id' => $prod['id'],
                    'prod_name' => $prod['prod_name'],
                    'prod_price' => $prod['prod_price'],
                    'prod_pic' => $prod['pic_text'][0],
                    'cate_name' => $prod['cate_text'],
                    'mer_name' => $prod['mer_text'],
                ];
                $kuai_id = model('KuaiProd')->tianjia($kuai);
                Db::name('sto_prod')->where('id',$prod['id'])->setfield('prod_is_gai',1); 
            }

            //整理数据
            $data = array( //订单表
                'order_number' => $order_number,
                'kuai_id' => $kuai_id,
                'prod_num' => $d['prod_num'],
                'mer_id' => $prod['mer_id'],
                'us_id' => $this->user['id'],
                'order_money' => $all_money,
                'detail_status' => 1,
                'detail_pay_time' => date('Y-m-d H:i:s'),
            );
            
            $datb = array( //订单号表
                'order_number' => $order_number,
                'addr_id' => $d['addr_id'],
                'addr_name' => $addr['addr_name'],
                'addr_stree' => $addr['addr_stree'],
                'addr_tel' => $addr['addr_tel'],
                'order_money' => $all_money,
                'order_note' => $d['order_note'],
                'us_id' => $this->user['id'],
            );
            model('StoOrderDetail')->tianjia($data);
            $rel = model('StoOrder')->tianjia($datb);
            if($rel['code']){
                //扣除用户茶币
                // model('User')->usWalChange($this->user['id'],$all_money,7);
                model('User')->usSalChange($this->user['id'],$all_money,3);
                model("User")->jd($this->user['id']);
                //更新产品库存销量
                model('Stoprod')
                ->where(['id' => $prod['id']])
                ->dec('prod_res', $d['prod_num'])
                ->inc('prod_sales', $d['prod_num'])
                ->inc('prod_sales_true', $d['prod_num'])
                ->update();
                $this->s_msg('订单成功');
            }else{
                $this->e_msg('订单失败');
            }
        }
    }

    public function bd(){

    }

    public function index(){
        if(is_post()){
            $this->map[] = ['us_id','=',$this->user['id']];
            if(input('post.status')){
                $this->map[] = ['detail_status','=',input('post.status')];
            }
            $list = model("StoOrderDetail")->chaxun($this->map,$this->order,$this->size);
            $this->msg($list);
        }else{
            $this->e_msg('get');
        }
    }

    //详情
    public function detail(){
        if(is_post()){
            $mm = [
                'id'=>input('post.id'),
            ];
            $info = model('StoOrderDetail')->detail($mm);
            $this->msg($info);
        }else{
            $this->e_msg('get');
        }
    }
    //确认收货
    public function receive(){
        if(is_post()){
            $d = input('id');
            $info = Db::name('sto_order_detail')->where('id',$d)->find();
            if($info['detail_status']!=2){
                $this->e_msg('该用户状态不是待收款状态');
            }
            $arr = [
                'id' => $d,
                'detail_status' => 3,
                'detail_finish_time' => date('Y-m-d H:i:s'),
            ];
            $rel = Db::name('sto_order_detail')->update($arr);
            if($rel){
                $this->s_msg('确认收货成功');
            }else{
                $this->e_msg('收货失败');
            }
        }else{
            $this->e_msg('get');
        }
    }

}
