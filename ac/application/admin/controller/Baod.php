<?php
namespace app\admin\controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * 属性列表
 */
class Baod extends Common
{

    public function __construct()
    {
        parent::__construct();
    }
    //
    public function index()
    {
        /** 
         * prod_zone 0普通产品  1报单产品
         * 报单列表 
         */
        $this->map[] = ['prod_zone','=',1];
		if (input('get.keywords')) {
			$us_id = model("User")->where('us_account|us_tel', input('get.keywords'))->value('id');
			if ($us_id) {
                $this->map[] = ['us_id', '=', $us_id];
			}else{
                $this->map[] = ['us_id', '=', 0];
            }
		}

		if (input('get.status') != "") {
			$this->map[] = ['detail_status', '=', input('get.status')];
		}

		if (input('get.prod_name') != "") {
			$this->map[] = ['prod_name', 'like', "%".input('get.prod_name')."%"];
		}
		
		if (input('get.order_number') != "") {
			$this->map[] = ['order_number', '=', input('get.order_number')];
		}
		if (input('get.start')) {
			$this->map[] = ['detail_add_time', '>=', input('get.start')];
		}
		if (input('get.end')) {
			$this->map[] = ['detail_add_time', '<=', input('get.end')];
		}


        if (input('get.a') == 1) {
            $list = model("StoOrderDetail")->with('order')->where($this->map)->select();
            // $url = action('Excel/user', ['list' => $list]);
            $bb = env('ROOT_PATH') . "public\order.xlsx";
            if (file_exists($bb)) {
                $aa = unlink($bb);
            }
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $sheet->setCellValue('A1', '订单编号')
                ->setCellValue('B1', '客户姓名')
                ->setCellValue('C1', '产品')
                ->setCellValue('D1', '报单金额')
                ->setCellValue('E1', '类型')
                ->setCellValue('F1', '位置')
                ->setCellValue('G1', '收货人')
                ->setCellValue('H1', '电话')
                ->setCellValue('I1', '状态')
                ->setCellValue('J1', '添加时间');
            $i = 2;
            foreach ($list as $k => $v) {
                $sheet->setCellValue('A' . $i, $v['order_number'])
                    ->setCellValue('B' . $i, $v->order->user['us_account'])
                    ->setCellValue('C' . $i, $v->kuai['prod_name'])
                    ->setCellValue('D' . $i, $v['order_money'])
                    ->setCellValue('E' . $i, $v['type_text'])
                    ->setCellValue('F' . $i, $v->order['addr_stree'])
                    ->setCellValue('G' . $i, $v->order['addr_name'])
                    ->setCellValue('H' . $i, $v->order['addr_tel'])
                    ->setCellValue('I' . $i, $v['status_text'])
                    ->setCellValue('J' . $i, $v['detail_add_time']);
                $i++;
            }
            $writer = new Xlsx($spreadsheet);
            $writer->save('order.xlsx');
            return "http://" . $_SERVER['HTTP_HOST'] . "/order.xlsx";
        }

        $list = model('StoOrderDetail')->chaxun($this->map, $this->order, $this->size);
		$this->assign(array(
			'list' => $list,
		));
		return $this->fetch();
        
    }
    
    
    //删除分类
    public function del()
    {
        if (input('post.id')) {
            $id = input('post.id');
        } else {
            $this->error('非法操作');
        }
        $info = model('StoOrderDetail')->where('id', $id)->find();
        
        // $product = model('product')->where('cate_id', $info['id'])->find();
        // if ($product) {
        //     $this->error('该分类下面有产品,请修改产品分类后再删除');
        // }
        if ($info) {
            if (model('StoAttr')->where('attr_pid', $info['id'])->find()) {
                $this->error('该属性名下面有属性值所以不能删除');
            }
            $rel = db('StoAttr')->where('id', $id)->delete();
            if ($rel) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        } else {
            $this->error('该数据不存在');
        }
    }
}