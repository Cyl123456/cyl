<?php /*a:3:{s:71:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\user\edit.html";i:1542865438;s:74:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_meta.html";i:1530598598;s:76:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_footer.html";i:1530598598;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/page.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/style.css" />
<style>
	.table-bg thead th {
	     background-color:rgba(255,255,255,0); 
	}
	.bg-1 {
	    background-color:rgba(255,255,255,0);
	}
</style>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<link href="/static/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <nav class="breadcrumb">
        <i class="Hui-iconfont">&#xe67f;</i> 首页 
        <span class="c-gray en">&gt;</span>会员管理 
        <span class="c-gray en">&gt;</span> 详情 
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
            <i class="Hui-iconfont">&#xe68f;</i>
        </a>
    </nav>
<div class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">推荐人(账户名)：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo htmlentities($info['ptel']); ?>" style="width:20%" disabled>
            </div>
        </div>
        
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">账户名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo htmlentities($info['us_account']); ?>" style="width:20%" disabled>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">头像：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div style="width:110px;height: 110px;position: relative;display: inline-block; ">
                    <?php if($info['us_head_pic']): ?>
                        <img src="<?php echo htmlentities($info['us_head_pic']); ?>" class="logo" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;">
                    <?php else: ?>
                        <img src="/static/admin/img/add0.png" class="logo" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;">
                    <?php endif; ?>
                    <input type="file" name="file" onchange="eee($(this))" class="input-text" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;opacity: 0;">
                </div>
            </div>
        </div>
        <div style="display:none" class="ttt">
                <input type="text" name="us_head_pic" value="<?php echo htmlentities($info['us_head_pic']); ?>">
                <input type="text" name="id" value="<?php echo htmlentities($info['id']); ?>">
            </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">真实姓名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" name="us_real_name" value="<?php echo htmlentities($info['us_real_name']); ?>" class="input-text" style="width:20%">
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">手机号码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo htmlentities($info['us_tel']); ?>" name="us_tel" style="width:20%">
            </div>`
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">登录密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_pwd" placeholder="不改请留空" style="width:20%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">安全密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_safe_pwd" placeholder="不改请留空" style="width:20%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否老会员：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="us_is_old" type="radio" value="0" id="">
                    <label for="sex-1">否</label>
                </div>
                <div class="radio-box">
                    <input name="us_is_old" type="radio" value="1" id="">
                    <label for="sex-2">是</label>
                </div>
            </div>
        </div>
         <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>用户状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <?php if($info['us_status'] == 0): ?>
                 <div class="radio-box">
                    <input type="radio" value="0" name="us_status" disabled>
                    <label for="sex-2">未激活</label>
                </div>
                <?php else: ?>
                <div class="radio-box">
                    <input name="us_status" type="radio" value="1" class="normal">
                    <label for="sex-1">正常</label>
                </div>
               
                <div class="radio-box">
                    <input type="radio" value="2" name="us_status" class="normal">
                    <label for="sex-2">被禁用</label>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否商家：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input class="us_is_mer" type="radio" value="0" id="">
                    <label for="sex-1">否</label>
                </div>
                <div class="radio-box">
                    <input class="us_is_mer" type="radio" value="1" id="">
                    <label for="sex-2">是</label>
                </div>
            </div>
        </div>
       <!--  <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>用户等级：</label>
                <div class="formControls col-xs-8 col-sm-9"> 
                    <span class="select-box" style="width:20%">
                        <select name="" class="select us_level">
                            <option value="0" disabled>普通用户</option>
                            <option value="1" disabled>业务经理</option>
                            <option value="2" disabled>高级业务经理</option>
                            <option value="3" disabled>总监</option>
                            <option value="4" disabled>总裁</option>
                            <option value="5" disabled>董事</option>
                            <option value="6" disabled>一星董事</option>
                            <option value="7" disabled>二星董事</option>
                            <option value="8" disabled>三星董事</option>
                            <option value="9" disabled>四星董事</option>
                            <option value="10"disabled>五星董事</option>
                        </select>
                    </span>
                </div>
            </div> -->
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>用户等级：</label>
                <div class="formControls col-xs-8 col-sm-9"> 
                    <span class="select-box" style="width:20%">
                        <select name="us_level" class="select us_level">
                            <option value="0">普通用户</option>
                            <option value="1">业务经理</option>
                            <option value="2">高级业务经理</option>
                            <option value="3">总监</option>
                            <option value="4">总裁</option>
                            <option value="5">董事</option>
                            <option value="6">一星董事</option>
                            <option value="7">二星董事</option>
                            <option value="8">三星董事</option>
                            <option value="9">四星董事</option>
                            <option value="10">五星董事</option>
                        </select>
                    </span>
                </div>
            </div>
        
       
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">银行名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_bank_name" value="<?php echo htmlentities($info['us_bank_name']); ?>" style="width:20%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">银行账户：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_bank_number" value="<?php echo htmlentities($info['us_bank_number']); ?>" style="width:20%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">收款人：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_bank_person" value="<?php echo htmlentities($info['us_bank_person']); ?>" style="width:20%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">开户行地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_bank_addr" value="<?php echo htmlentities($info['us_bank_addr']); ?>" style="width:20%">
            </div>
        </div>
         <!-- <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">我的报单中心：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_center" value="" style="width:20%">
            </div>
        </div> -->
       <!--  <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">身份证：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_id_card" value="" style="width:20%">
            </div>
        </div> -->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">支付宝：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_alipay" value="<?php echo htmlentities($info['us_alipay']); ?>" style="width:20%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">微信号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" name="us_wechat" value="<?php echo htmlentities($info['us_wechat']); ?>" style="width:20%">
            </div>
        </div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onclick="return savePro();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 确认提交</button>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script>
	var aa = "<?php echo htmlentities(app('request')->controller()); ?>";
	var bb = "<?php echo htmlentities(app('request')->action()); ?>";
	// console.log(aa+"/"+bb);
</script>


<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript">

window.onload=function (){
    var us_is_old = "<?php echo htmlentities($info['us_is_old']); ?>";
    var us_is_mer = "<?php echo htmlentities($info['us_is_mer']); ?>";
    var level = "<?php echo htmlentities($info['us_level']); ?>";
    var status = "<?php echo htmlentities($info['us_status']); ?>";
    $('.us_level').val(level);
    $('.form input[name="us_status"][value=' + status + ']').attr("checked", true);
    $('.form input[name="us_is_old"][value=' + us_is_old + ']').attr("checked", true);
    $('.us_is_mer[value=' + us_is_mer + ']').attr("checked", true);
}

function savePro(){
    $.post('<?php echo url("edit"); ?>',$('#form-article-add').serialize()).success(function(data){
    	layer.msg(data.msg);
    	if(data.code){
    		setTimeout(function(){
    			location.href = '';
    		},500);
    	}
    });
    return false;
}

function eee(dada) {
        var data = new FormData();
        data.append('file', dada[0].files[0]);
        var index = layer.load(1, { shade: false }); //0代表加载的风格，支持0-2
        $.ajax({
            url: '<?php echo url("store/upload"); ?>',
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                layer.msg(data.msg);
                if (data.code) {
                    $('.logo').attr('src',data.data);
                    $('input[name="us_head_pic"]').val(data.data);
                }
                layer.close(index);
            },
            error: function() {
                layer.close(index);
                layer.msg('上传出错');
            }
        });
}

</script>
</body>
</html>