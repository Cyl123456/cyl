<?php /*a:3:{s:71:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\user\team.html";i:1531710508;s:74:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_meta.html";i:1530598598;s:76:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_footer.html";i:1530598598;}*/ ?>
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
<link rel="stylesheet" href="/static/ztree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<title></title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>团队管理 <span class="c-gray en">&gt;</span> 团队管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
	<form class="Huiform">
		<input type="text" class="input-text" style="width:200px" placeholder="会员编号/手机号码/用户姓名" id="" name="us_account" value="">
		<button type="submit" onclick="return eee(1)" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		</form>
	</div>
	<div class="mt-20">
		<div class="tuandui_wrap">
			 <div class="zTreeDemoBackground" style="margin-left:0.6rem;">
                <ul id="treeDemo" class="ztree"></ul>
            </div>
		</div>
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
<script src="/static/ztree/js/jquery.ztree.core.js"></script>

</body>
</html>
<script>
    var setting = { 
        view: { 
            showLine: true 
        }, 
        data: { 
            simpleData: { 
                enable: true 
            } 
        } 
    }; 
    function eee(data){
        if(data==1){
            var us_account = $('input[name="us_account"]').val();
            if(!us_account){
                layer.msg('请输入账户名');
            }
        }else{
           var us_account = data;
        }

        
        $.ajax({
            type: "post",
            dataType : "json",
            global : false,
            url : "team",
            data:{us_account:us_account},
            success : function(data){
                console.log(data);
                if (data.code){
                    console.log(1);
                    zNodes = data.data;
                    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
                }else{
                    console.log(2);
                    layer.msg(data.msg);
                }
                
            }           
        });
        return false;
    }
    var us_account = "<?php echo htmlentities((isset($us_account) && ($us_account !== '')?$us_account:'')); ?>";
    if(us_account){
        eee(us_account);
    }
</script> 