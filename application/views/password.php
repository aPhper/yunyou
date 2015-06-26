<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/select.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/select-ui.min.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>

<body>
<div class="place"> <span>位置：</span>
  <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">运维管理</a></li>
    <li><a href="#">修改密码</a></li>
  </ul>
</div>
<div class="formbody">
  <div class="formtitle"><span>修改密码</span></div>
  <?php echo form_open(base_url('password/update'),'post')?>
  <ul class="forminfo">
    <li>
      <label>用户名称</label>
      <span class="form_infor"><?php echo $col_name ?></span>
      <input type="hidden" name="username" value="<?php echo $col_id ?>"/>
    </li>
    <li>
      <label>旧密码</label>
      <input name="oldpasswd" type="password" class="dfinput" value="<?php echo set_value("oldpasswd")?>"/>
      <i class="red"><?php echo form_error('oldpasswd'); ?></i>
      <i class="red"><?php if(isset($error_string)){echo $error_string;}?></i>
    </li>
    <li>
      <label>新密码</label>
      <input name="newpasswd" type="password" class="dfinput" value="<?php echo set_value("newpasswd")?>"/>
      <i class="red"><?php echo form_error('newpasswd'); ?></i>
    </li>
    <li>
      <label>确认密码</label>
      <input name="passwdconf" type="password" class="dfinput" value="<?php echo set_value("passwdconf")?>" />
      <i class="red"><?php echo form_error('passwdconf'); ?></i>
    </li>
    <li>
      <label>&nbsp;</label>
      <input name="" type="submit" class="btn click" value="确认修改"/>
    </li>
  </ul>
</div>


</body>
</html>
