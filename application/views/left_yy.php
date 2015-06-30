 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css') ?>"/>
<script language="JavaScript" src="<?php echo base_url('js/jquery.js') ?>"></script>
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
    <div class="title"> <span><img src="<?php echo base_url('images/leftico02.png')?>" /></span>运营管理 </div>
    <ul class="menuson">
      <li class='active'><cite></cite><a href="<?php echo base_url('manage_user/list_user')?>" target="rightFrame">用户管理</a><i></i></li>
      <li><cite></cite><a href="<?php echo base_url('report') ?>" target="rightFrame">报表管理</a><i></i></li>
      <li><cite></cite><a href="<?php echo base_url('manage_template/list_template');?>" target="rightFrame">模板管理</a><i></i></li>
      <li><cite></cite><a href="<?php echo base_url('manage_script/list_script')?>" target="rightFrame">脚本管理</a><i></i></li>
      <li><cite></cite><a href="<?php echo base_url('manage_game/list_game');?>" target="rightFrame">游戏管理</a><i></i></li>
    </ul>
  </dd>
</dl>
</body>
</html>
