<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?php echo base_url();?>js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>
</head>

<body style="background:#f0f9fd;">
<div class="lefttop"><span></span>管理册</div>
<dl class="leftmenu">
  <dd>
    <div class="title"><span><img src="<?php echo base_url();?>images/leftico03.png" /></span>客服管理</div>
    <ul class="menuson">
      <li><cite></cite><a href="<?php echo base_url('manage_ticket/list_ticket')?>" target="rightFrame">工单管理</a><i></i></li>
      <li><cite></cite><a href="zy.html" target="rightFrame">资源管理</a><i></i></li>
      <li><cite></cite><a href="zh.html" target="rightFrame">账户管理</a><i></i></li>
      <li><cite></cite><a href="tx.html" target="rightFrame">申请提现</a><i></i></li>
      <li><cite></cite><a href="<?php echo base_url('password')?>" target="rightFrame">修改密码</a><i></i></li>
    </ul>
  </dd>
</dl>
</body>
</html>
