<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css') ?>"/>
<script language="JavaScript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/cloud.js') ?>"></script>

<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script>
</head>

<body style="background-color:#1c77ac; background-image:url(images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
<div id="mainBody">
  <div id="cloud1" class="cloud"></div>
  <div id="cloud2" class="cloud"></div>
</div>
<div class="logintop"> <span>欢迎登录后台管理界面平台</span>
  <ul>
    <li><a href="#">回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
  </ul>
</div>
<div class="loginbody"> <span class="systemlogo"></span>
  <div class="loginbox">
  <?php echo form_open(base_url('login'),'post')?>
    <ul>
      <li>
        <i class="red"><?php if(isset($error_string)){echo $error_string;}?></i>
        <input type="text" class='loginuser' name="username" value="<?php echo set_value('username'); ?>" tautocomplete="off" />
        <i class="yanz_info red"><?php echo form_error('username'); ?></i>
      </li>
      <li>
        <input type="password" name="password" class='loginpwd' value="<?php echo set_value('password'); ?>" tautocomplete="off"/>
        <i class="yanz_info red"><?php echo form_error('password'); ?></i>
      </li>
      <li>
           <select class="loginform" name='user_type'>
              <option value='tech' <?php echo set_select('user_type','tech',true) ?> >运维管理</option>
              <option value='admin' <?php echo set_select('user_type','admin') ?>>运营管理</option>
              <option value='cm' <?php echo set_select('user_type','cm') ?>>客服管理</option>
            </select>        
      </li>
      <li>
        <input name="submit" type="submit" class="loginbtn" value="登录"   />
        <label>
          <input name="" type="checkbox" value="" checked="checked" /> 
                                     记住密码</label>
      </li>
    </ul>
  </div>
</div>
</body>
</html>
