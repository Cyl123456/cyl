<?php
namespace app\index\controller;
use think\facade\Config;
use alysms\Hell;
use app\common\controller\Api;

class Total extends Api 
{
    //一条新闻
    public function news(){
        $this->map[] = ['me_type','=',1];
        $list = model('Message')->where($this->map)->order($this->order)->find();
        $this->msg($list);
    }
    /**
	 * 上传图片
	 * @return [type] [description]
	 */
	public function uploads() {
		try {
			$rel = base64_upload(input('post.img'));
		} catch (\Exception $e) {
			$this->e_msg($e->getMessage());
		}
		if ($rel) {
            $arr = [
                'code'=>1,
                'msg' => "成功",
                'data' => $rel,
            ];
            $this->msg($arr);
		} else {
			$this->e_msg('失败');
        }
       
    }
    
    /**
	 * 86400 / 24 3600/60    120 两分钟
	 * 验证码
	 * @return [type] [description]
	 */
	public function send() {
        $mobile = input('post.us_tel');
        $type   = input('post.type');
        if(!$type){
            $this->e_msg('请填入短信类型');
        }
        if($mobile){
            if(db('user')->where('us_tel', $mobile)->count()){
                if ('reg' === $type) {
                    $this->e_msg('该手机号已注册');
                }
            }else{
                // 忘记密码/登陆  获取验证码
                if ('fg' == $type) {
                    $this->e_msg('该手机号未注册账户');
                }
            }
            if (cache($mobile . 'code')) {
                $this->e_msg('每次发送间隔120秒');
            }else{
                cache($mobile . 'code', 123456,120);
                $this->s_msg('发送成功,现在的验证码是123456');
            }
            $random = mt_rand(100000, 999999);
            $xxx = $this->notecode($mobile, $random);
            halt($xxx);
            $rel = $this->object_array($xxx);
            if ($rel['returnstatus'] == "Faild") {
                $this->e_msg($rel['message']);
            } else {
                cache($mobile . 'code', $random,120);
                $this->s_msg('发送成功');
            }
        }else{
            $this->e_msg("手机号为空");
        }
    }


    function notecode($mobile,$code) {


        $params = array ();

        // *** 需用户填写部分 ***

        /*
            ak信息
            key id  
            key secret  你的密钥
            短信签名
            短信模板的code

         */

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        // $accessKeyId = "your access key id";
        // $accessKeySecret = "your access key secret";
        $accessKeyId = "LTAIAlpPMNkcMM7a";
        $accessKeySecret = "hyN7jxsjg66wZW3sqX72GtvC0krQXZ";

        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $mobile;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "118378359";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_148076304";

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "code" => $code,
        );

        // fixme 可选: 设置发送短信流水号
        $params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        $params['SmsUpExtendCode'] = "1234567";


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new Hell();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
            // fixme 选填: 启用https
            // ,true
        );
        return $content;
    }


    public function fg(){
        $post = input('post.');
        if ($post) {

            $validate = validate('User');
            $res = $validate->scene('pass')->check($post);
            if (!$res) {
                $this->e_msg($validate->getError());
            }
           
            $info = db('user')->where('us_tel',$post['us_tel'])->find();
            if(!$info){
                $this->e_msg('该用户不存在');
            }
            $code_info = cache($post['us_tel'] . 'code') ?: "";
            if (!$code_info) {
                $this->e_msg('请重新发送验证码');
            } elseif ($post['sode'] != $code_info) {
                $this->e_msg('验证码不正确');
            }

            $arr = array_merge($post,['id'=>$info['id']]);
            $rst  = model('User')->editInfo($arr);
            $this->s_msg($rst);

        }else{
            $this->e_msg();
        }
    }
   

}
