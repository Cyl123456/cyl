<?php /*a:2:{s:75:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\index\welcome.html";i:1540458602;s:74:"D:\phpstudy123\PHPTutorial\WWW\ac\application\admin\view\public\_meta.html";i:1530598598;}*/ ?>
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
<title>我的桌面</title>
</head>

<body>
	<div class="page-container">
		<div class="f-14 c-error" style="margin:20px auto;">提示：为避免一些兼容问题，建议您使用Chrome浏览器、及含有急速内核的浏览器等打开本后台。</div>
		<!-- <table class="table table-border table-bordered table-bg">
			<thead>
				<tr>
					<th colspan="8" scope="col">会员统计</th>
				</tr>
				<tr class="text-c">
					<th>会员数</th>
					<th>商家数</th>

				</tr>
			</thead>
			<tbody>
				<tr class="text-c">
					<td>0</td>
					<td>0</td>
				</tr>
			</tbody>
		</table> -->

		<table class="table table-border table-bordered table-bg mt-20">
			<thead>
				<tr>
					<th colspan="2" scope="col">服务器信息</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>服务器IP地址</td>
					<td><?php echo htmlentities($request->ip()); ?></td>
				</tr>
				<tr>
					<td>服务器域名</td>
					<td><?php echo htmlentities($request->domain()); ?></td>
				</tr>
				<tr>
					<td>服务器PHP版本 </td>
					<td><?php echo PHP_VERSION; ?></td>
				</tr>
				<tr>
					<td>本文件所在文件夹 </td>
					<td><?php echo __DIR__; ?></td>
				</tr>
				<tr>
					<td>服务器操作系统 </td>
					<td><?php echo PHP_OS; ?></td>
				</tr>
				<tr>
					<td>服务器当前时间 </td>
					<td><?php echo date("Y-m-d H:i"); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<footer class="footer mt-20">
		<div class="container">
			<p><br> Copyright &copy;<?php echo config('WEB_BQ'); ?><br> 
				<a href="http://www.jugekeji.cn" target="_blank" title=""></a></p>
		</div>
	</footer>
	<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
	<!-- <script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.min.js"></script>  -->

</body>

</html>
<script>
	var obj = document.getElementsByClassName('container');
	console.log(obj);
	// console.log(obj[0].innerText);
	// console.log(obj.length);
	var b = {};
	console.log(obj.__proto__);
	console.log(obj.__proto__.__proto__);
	console.log(b);
	console.log(b.__proto__);
</script>