<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="<?php echo base_url('js/jquery.js')?>"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>


</head>

<body style="background:url(<?php echo  base_url('images/topbg.gif')?>) repeat-x;">

    <div class="topleft">
    <a href="main.html" target="_parent"><img src="<?php echo base_url('images/logo.png');?>" title="系统首页" /></a>
    </div>
 
    <div class="topright">    
    <ul>
    <li><span><img src="<?php echo base_url('images/help.png');?>" title="帮助"  class="helpimg"/></span><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    <li><a href="<?php echo base_url('login/loginout')?>" target="_parent">退出</a></li>
    </ul>
     
    <div class="user">
    <span><?php echo $userinfo['col_nickname']?></span>
    <i>消息</i>
    <b>5</b>
    </div>    
    
    </div>

</body>
</html>
