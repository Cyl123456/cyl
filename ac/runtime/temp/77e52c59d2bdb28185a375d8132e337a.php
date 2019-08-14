<?php /*a:3:{s:72:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\user\index.html";i:1543886382;s:74:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_meta.html";i:1530598598;s:76:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_footer.html";i:1530598598;}*/ ?>
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
<title></title>
<style>
	.Hui-iconfont{
		margin:0 2px;
		font-size:15px;
	}
</style>
</head>
<body>
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 
	<span class="c-gray en">&gt;</span>会员管理 
	<span class="c-gray en">&gt;</span> 会员 
	<a class="btn btn-success radius r" style="margin-left:2px" href="javascript:location.replace(location.href);" title="刷新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<div class="page-container">
	<div class="text-c">
		<form class="Huiform" method="get" action="">
			状态：
			<span class="select-box inline">
				<select name="status" class="select">
					<option value="">全部</option> 
					<option value="2">被禁用</option> 
					<option value="1">正常</option> 
					<option value="0">未激活</option>
				</select>
			</span>
			等级：
			<span class="select-box inline">
				<select name="level" class="select">
					<option value="">全部</option> 
					<option value="0">普通会员</option> 
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
			激活时间：
			<input type="text" class="input-text Wdate" name="start" id="countTimestart" placeholder="开始" onfocus="selecttime(1)" value="<?php echo htmlentities((app('request')->get('start') ?: '')); ?>" size="17" class="date" readonly style="width:140px;"> 
			- 
			<input type="text" class="input-text Wdate" name="end" id="countTimeend" placeholder="结束" onfocus="selecttime(2)" value="<?php echo htmlentities((app('request')->get('end') ?: '')); ?>" size="17"  class="date" readonly style="width:140px;">
			<input type="text" class="input-text" style="width:150px" placeholder="账户、姓名、手机号" id="" name="keywords" value="<?php echo htmlentities((app('request')->get('keywords') ?: '')); ?>">
			<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<!-- <span class="l">
			<a href="javascript:;" onclick="create(0,'add','添加用户')" class="btn btn-primary radius">
			<i class="Hui-iconfont">&#xe600;</i> 用户</a>
		</span>  -->
		<span class="r">共有数据：<strong><?php echo htmlentities($list->total()); ?></strong> 条</span>
	</div>
	<div class="mt-20">
		<table class="table table-border  table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">				
					<th>账户名</th>
					<th>真实姓名</th>
					<th>手机号</th>
					<th>父账户名</th>
					<th>信息相关</th>
					<th>茶币</th>
					<th>奖励</th>
					<th>业绩</th>
					<th>状态</th>
					<th>添加时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr class="text-c">
						<td><?php echo htmlentities($vo['us_account']); ?></td>
						<td><?php echo htmlentities($vo['us_real_name']); ?></td>
						<td><?php echo htmlentities($vo['us_tel']); ?></td>
						<td><?php echo htmlentities($vo['ptel']); ?></td>					
						<td>
							<a onclick="create('<?php echo htmlentities($vo['us_account']); ?>','team','团队')"> 团队</a> |
							<a onclick="create('<?php echo htmlentities($vo['us_account']); ?>','tupu','节点图')">  节点</a> |
							<a onclick="create('<?php echo htmlentities($vo['id']); ?>','song','送币')">  送币</a>
							<?php if($vo['us_status'] == 0): ?>
								<a onclick="active('<?php echo htmlentities($vo['id']); ?>')">|  激活</a>
							<?php endif; ?>
						</td>					
						<td><?php echo htmlentities($vo['us_wal']); ?></td>					
						<td><?php echo htmlentities($vo['us_msc']); ?></td>					
						<td><?php echo htmlentities($vo['us_rel']); ?></td>					
						<td><?php echo htmlentities($vo['status_text']); ?></td>					
						<td><?php echo htmlentities($vo['us_add_time']); ?></td>								
						<td class="td-manage">
							<a style="text-decoration:none"  class="xl-9" title="编辑" onclick="create('<?php echo htmlentities($vo['id']); ?>','edit','修改用户')" >
								<i class="Hui-iconfont">&#xe6df;修改</i>
							</a>
							<a style="text-decoration:none" class="ml-7" onclick="del('<?php echo htmlentities($vo['id']); ?>')" title="">
								<i class="Hui-iconfont">&#xe706;删除</i>
							</a>
							<!-- <a href="<?php echo url('excel'); ?>" title="下载"><i class="Hui-iconfont">&#xe640;</i></a> -->
						</td>
					</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<div class="pages" style="margin:20px;float: right; "><?php echo $list; ?></div>
	</div>
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
<script type="text/javascript" src="/static/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript">
	
$('select[name="status"]').val('<?php echo htmlentities(app('request')->get('status')); ?>');
$('select[name="level"]').val('<?php echo htmlentities(app('request')->get('level')); ?>');

function create(id,url,key){
	var url = "<?php echo url('"+url+"'); ?>?id="+id;
	creatIframe(url,key);
}
function creacrea(id){
	var url = "<?php echo url('tupu'); ?>?id="+id+"&type=1";
	creatIframe(url,'节点图');
}
function selecttime(flag){
    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }
 }

// 用户信息
function editInfo(uid) {
	$.post("<?php echo url('user/index'); ?>?act=get", { id: uid }, function (data) {
		console.log(data);
		if (data) {
			$('#us_head_pic').val(data.us_head_pic);
			$('#us_account').val(data.us_account);
			$('#us_tel').val(data.us_tel);
			$("#user_edit").modal("show");
		}
	});
}


/*------------------更改状态*/
function change(id,value,key){
	layer.confirm('确定要更改么？', {
	      btn: ['确定', '取消']
	    }, function(index, layero){
	        $.ajax({
	            type: "post",
	            url: "<?php echo url('index'); ?>",
	            data: {id:id,value:value,key:key},
	            success: function(data) {
	             	if(data.code){
	             		location.href = 'tupu';
	             	}
	            }
	        });
	    });
}
/*------------------进入图谱*/
function tupu(datt){
	$.ajax({
        type: "get",
        url: "<?php echo url('is_jing'); ?>",
        data: {id:datt},
        success: function(data) {
            if(data.code==1){
                setTimeout(function(){
                    create(datt,'tupu','进入节点图')
                },1000);
            }else{
            	layer.msg(data.msg);
            }
        }
    });
}

/*------------------下载*/
function downdo(){
	var url = window.location.href;
	$.ajax({
		type:'get',
		url:url,
		data:{a:1},
		success:function(data){
			window.location.href = data;
		}
	})
}
/*------------------激活*/
function active(id){
    layer.confirm('确定要激活么？', {
      btn: ['确定', '取消']
    }, function(index, layero){
        $.ajax({
            type: "post",
            url: "<?php echo url('active'); ?>",
            data: {id:id},
            success: function(data) {

                layer.msg(data.msg);
                // if(data.code==1){
                //     setTimeout(function(){
                //         location.href = data.url;
                //     },1000);
                // }
            }
        });
    });
}
/*------------------删除*/
function del(id){
    layer.confirm('确定要删除么？', {
      btn: ['确定', '取消']
    }, function(index, layero){
        $.ajax({
            type: "post",
            url: "<?php echo url('del'); ?>",
            data: {id:id},
            success: function(data) {
                layer.msg(data.msg);
                if(data.code==1){
                    setTimeout(function(){
                        location.href = data.url;
                    },1000);
                }
            }
        });
    });
}	
</script> 
</body>
</html>