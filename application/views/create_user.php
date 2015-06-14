<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>无标题文档</title>
<link href='../css/style.css' rel='stylesheet' type='text/css' />
<link href='../css/select.css' rel='stylesheet' type='text/css' />
<script type='text/javascript' src='../js/jquery.js'></script>
<script type='text/javascript' src='../js/select-ui.min.js'></script>
<script type='text/javascript'>
$(document).ready(function(e) {
    $('.select1').uedSelect({
		width : 345			  
	});
	$('.select2').uedSelect({
		width : 167  
	});
	$('.select3').uedSelect({
		width : 100
	});
});
</script>
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
  <div class='formtitle'><span>增加用户</span></div>
  <?php echo form_open('manage_user/create_user')?>
  <ul class='forminfo'>
    <li>
      <label>用户名称</label>
      <input name='username' type='text' class='dfinput' />
    </li>
    <li>
      <label>用户权限</label>
      <div class='vocation'>
        <select name='role' class='select2'>
          <option value='tech'>运维管理</option>
          <option value='admin'>运营管理</option>
          <option value='cm'>客服管理</option>
        </select>
      </div>
    </li>
    <li><label>性别</label>男<input type="radio" value='男' >女<input type="radio" value='女' ></li>
    <li>
      <label>用户真实姓名</label>
      <input name='name' type='text'value='' class='dfinput' >
    </li>
    <li>
      <label>邮箱</label>
      <input name='mail' type='text' class='dfinput' value='' />
    </li>
   <li>
      <label>电话</label>
      <input name='call' type='text' class='dfinput' value='' />
    </li>
    <li>
      <label>QQ</label>
      <input name='qq' type='text' class='dfinput' value='' />
    </li>
    <li>
      <label>密码重置</label>
      <input name='passwd' type='text' class='dfinput' value='' />
    </li>
    
    <li>
      <label>&nbsp;</label>
      <input name='submit' type='submit' class='btn' value='增加' />
    </li>
  </ul>
</div>
</body>
</html>
