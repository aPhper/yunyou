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
    <li><a href='#'>模板管理</a></li>
  </ul>
</div>
<div class='formbody'>
  <div class='formtitle'><span>查看脚本信息</span></div>
  <ul class='forminfo'>
    <li>
      <label> 脚本名称</label>
      <span class='form_infor'><?php echo $template['script_name']?></span></li> 
      <li>
      <label> 作者</label>
      <span class='form_infor'><?php echo $template['user_name']?></span></li> 
      <li>
      <label> 模板id</label>
      <span class='form_infor'><?php echo $template['col_template_id']?></span></li> 
      <li>
      <label> 时间</label>
      <span class='form_infor'><?php echo $template['time']?></span></li> 
      <li>
      <label> 状态</label>
      <span class='form_infor'><?php echo $template['status']?></span></li> 
      <li>
      <label> 模板状态</label>
      <span class='form_infor'><?php echo $template['col_status_code']?></span></li> 
      <li>
      <label> 审核状态</label>
      <span class='form_infor'><?php echo $check[$template['col_check']]?></span></li> 
      <li>
      <label>&nbsp;</label>
     <a href='<?php echo base_url("manage_template/check_template/".$template['template_id'])?>' target='rightFrame'><input name='' type='button' class='btn' value='审核' /></a> 
    </li>
  </ul>
</div>
</body>
</html>
