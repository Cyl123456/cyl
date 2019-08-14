<?php /*a:5:{s:73:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\index\index.html";i:1534838582;s:74:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_meta.html";i:1530598598;s:76:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_header.html";i:1541390446;s:74:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_menu.html";i:1546680264;s:76:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_footer.html";i:1530598598;}*/ ?>
﻿<!DOCTYPE HTML>
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
<title>后台管理</title>
<meta name="keywords" content="后台管理">
<meta name="description" content="康怡佰后台管理">
</head>
<body>
    <header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/index.html">后台管理系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/index.html">后台管理系统</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs"></span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs" >
				<ul class="cl">
					<li></li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo htmlentities(app('session')->get('ad_account')); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<!-- <li><a href="#">个人信息</a></li> -->
							<li><a href="<?php echo url('login/logout'); ?>">退出</a></li>
						</ul>
					</li>
				<!-- 	<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li> -->
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="green" title="默认（绿色）">默认（绿色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header> <aside class="Hui-aside" style="background: #FDF5F2;">
	<div class="menu_dropdown bk_2 sidebar">
		<!-- 管理员 -->
		<dl id="menu-system" class="guanli">
			<dt data-node-id="67" class="rule_node"><i class="Hui-iconfont">&#xe62d;</i> 管理列表<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li data-node-id="67" class="rule_node"><a data-href="<?php echo url('Admin/index'); ?>" data-title="管理员" href="javascript:void(0)">管理员</a></li>
					<li data-node-id="70" class="rule_node"><a data-href="<?php echo url('Admin/roleIndex'); ?>" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
					<!-- <li data-node-id="102"><a data-href="<?php echo url('Admin/authRule'); ?>" data-title="权限管理" href="javascript:void(0)">权限管理</a></li> -->
				</ul>
			</dd>
		</dl>
		<!-- 用户管理 -->
		<dl id="menu-admin">
			<dt data-node-id="39" class="rule_node"><i class="Hui-iconfont">&#xe62c;</i> 用户管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li data-node-id="40" class="rule_node"><a data-href="<?php echo url('User/index'); ?>" data-title="用户列表" href="javascript:void(0)">用户</a></li>
					<li data-node-id="42" class="rule_node"><a data-href="<?php echo url('User/team'); ?>" data-title=" 团队" href="javascript:void(0)">		团队</a></li>
					<li data-node-id="40" class="rule_node"><a data-href="<?php echo url('User/tupu'); ?>" data-title="节点图" href="javascript:void(0)">  节点图</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
				<dt data-node-id="39" class="rule_node"><i class="Hui-iconfont">&#xe62c;</i> 报单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
				<dd>
					<ul>
						<li data-node-id="40" class="rule_node"><a data-href="<?php echo url('Baod/index'); ?>" data-title="报单列表" href="javascript:void(0)">报单列表</a></li>
					</ul>
				</dd>
			</dl>
		<dl id="menu-admin">
			<dt data-node-id="11" class="rule_node"><i class="Hui-iconfont">&#xe620;</i> 商城管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li data-node-id="59" class="rule_node"><a data-href="<?php echo url('mer/apply'); ?>" data-title="申请商家">申请商家</a></li>
					<li data-node-id="59" class="rule_node"><a data-href="<?php echo url('mer/index'); ?>" data-title="商家">商家</a></li>
					<li data-node-id="65" class="rule_node"><a data-href="<?php echo url('cate/index'); ?>" data-title="分类">分类</a></li>
					<li data-node-id="65" class="rule_node"><a data-href="<?php echo url('attr/index'); ?>" data-title="属性">属性</a></li>
					<li data-node-id="65" class="rule_node"><a data-href="<?php echo url('prod/index'); ?>" data-title="商品">商品</a></li>
					<li data-node-id="11" class="rule_node"><a data-href="<?php echo url('order/index'); ?>" data-title="订单">订单</a></li>
					<!-- <li data-node-id="11" class="rule_node"><a data-href="<?php echo url('mer/song'); ?>" data-title="赠送">赠送</a></li> -->
				</ul>
			</dd>
		</dl>

		<dl id="menu-comments">
			<dt data-node-id="26" class="rule_node"><i class="Hui-iconfont">&#xe66a;</i> 财务管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('profit/wal'); ?>" data-title="茶币" href="javascript:void(0)">茶币</a></li>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('profit/msc'); ?>" data-title="奖励" href="javascript:void(0)">奖励</a></li>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('profit/sal'); ?>" data-title="消费币" href="javascript:void(0)">消费币</a></li>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('profit/transfer'); ?>" data-title="转账记录" href="javascript:void(0)">转账记录</a></li>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('profit/tx'); ?>" data-title="提现" href="javascript:void(0)">提现</a></li>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('profit/jd'); ?>" data-title="见点奖" href="javascript:void(0)">见点奖</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-comments">
			<dt data-node-id="26" class="rule_node"><i class="Hui-iconfont">&#xe66a;</i> 其他<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('setting/shuff'); ?>" data-title="轮播图" href="javascript:void(0)">轮播图</a></li>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('news/index'); ?>" data-title="新闻" href="javascript:void(0)">新闻</a></li>
					<li data-node-id="26" class="rule_node"><a data-href="<?php echo url('news/message'); ?>" data-title="反馈" href="javascript:void(0)">反馈</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-system" class="guanli super" >
			<dt data-node-id="54" class="rule_node" ><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li data-node-id="54" class="rule_node"><a data-href="<?php echo url('setting/index'); ?>" data-title="基本设置" href="javascript:void(0)">基本设置</a></li>
					<li data-node-id="54" class="rule_node"><a data-href="<?php echo url('setting/system'); ?>" data-title="等级参数" href="javascript:void(0)">等级参数</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box" >
        <div id="Hui-tabNav" class="Hui-tabNav hidden-xs" style="background: #FDF5F2;">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active">
                        <span title="我的桌面" data-href="welcome.html">我的桌面</span>
                        <em></em>
                    </li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group">
            	<a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
            	<a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="<?php echo url('index/welcome'); ?>"></iframe>
            </div>
        </div>
    </section>
    <div class="contextMenu" id="Huiadminmenu">
        <ul>
            <li id="closethis">关闭当前 </li>
            <li id="closeall">关闭全部 </li>
        </ul>
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
    <script type="text/javascript" src="/static/admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
    <script type="text/javascript">
    $(function() {
        $("#min_title_list li").contextMenu('Huiadminmenu', {
            bindings: {
                'closethis': function(t) {
                    console.log(t);
                    if (t.find("i")) {
                        t.find("i").trigger("click");
                    }
                },
                'closeall': function(t) {
                    alert('Trigger was ' + t.id + '\nAction was Email');
                },
            }
        });
    });
    </script>
</body>

</html>