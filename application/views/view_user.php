<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>无标题文档</title>
<link href='<?php echo base_url()?>css/style.css' rel='stylesheet' type='text/css' />
</head>

<body>
<div class='place'> <span>位置：</span>
  <ul class='placeul'>
    <li><a href='#'>首页</a></li>
    <li><a href='#'>运营管理</a></li>
    <li><a href='#'>用户管理</a></li>
  </ul>
</div>
<div class='formbody'>
  <div class='formtitle'><span>查看用户信息</span></div>
  <ul class='forminfo'>
    <li>
      <label>用户名称</label>
      <span class='form_infor'><?php echo $user['col_name']?></span></li>
    <li>
      <label>用户权限</label>
      <span class='form_infor'><?php echo $user['col_role']?></span></li>
    <li>
      <label>用户名</label>
      
      <span class='form_infor'><?php echo $user['col_nickname']?></span></li>
      
    <li>
      <label>邮箱</label>
      <span class='form_infor'><?php echo $user['col_mail']?></span></li>
    <li>
      <label>电话</label>
      <span class='form_infor'><?php echo $user['col_call']?></span></li>
    <li>
     <li>
      <label>QQ</label>
      <span class='form_infor'><?php echo $user['col_qq']?></span></li>
    <li>
    
      <label>&nbsp;</label>
     <a href='<?php echo base_url("manage_user/update_user/".$user['col_id'])?>' target='rightFrame'><input name='' type='button' class='btn' value='修改' /></a> 
    </li>
  </ul>
</div>
</body>
</html>
