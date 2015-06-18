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
    <li><a href='#'>脚本管理</a></li>
  </ul>
</div>
<div class='formbody'>
  <div class='formtitle'><span>查看脚本信息</span></div>
  <ul class='forminfo'>
    <li>
      <label> 脚本名称</label>
      <span class='form_infor'><?php echo $script['col_name']?></span></li> 
    <li>
      <label>版本号 </label>
      <span class='form_infor'><?php echo $script['col_version']?></span></li>
    <li>  
      <label>脚本简介 </label>
      <span class='form_infor'><?php echo $script['col_intro']?></span></li>
    <li>  
      <label>脚本描述 </label>
      <span class='form_infor'><?php echo $script['col_desc']?></span></li>
    <li>  
      <label>操作系统</label>
      <span class='form_infor'><?php echo $script['col_os']?></span></li>
    <li>  
      <label>分辨率 </label>
      <span class='form_infor'><?php echo $script['col_resolution']?></span></li>
    <li>  
      <label>色深</label>
      <span class='form_infor'><?php echo $script['col_color']?></span></li>
    <li> 
     <label>主题</label>
      <span class='form_infor'><?php echo $script['col_theme']?></span></li>
    <li>  
      <label>字体 </label>
      <span class='form_infor'><?php echo $script['col_font']?></span></li>
    <li>  
      <label>后台运行</label>
      <span class='form_infor'><?php echo $script['col_ishoutai']?></span></li>
    <li>  
      <label>多开 </label>
      <span class='form_infor'><?php echo $script['col_isduokai']?></span></li>
    <li>  
      <label>推荐 </label>
        <span class='form_infor'><?php echo $script['col_hot']?></span></li>
    <li>  
      <label>上传日期 </label>
      <span class='form_infor'><?php echo $script['col_date']?></span></li>
    <li>  
      <label>状态 </label>
      <span class='form_infor'><?php echo $script['col_status']?></span></li>
     <li>  
      <label>审核结果 </label>
      <span class='form_infor'><?php echo $check[$script['col_check']]?></span></li>
    <li>  
      <label>脚本下载 </label>
      <span class='form_infor'><a href=''><?php echo $script['col_url']?></a></span></li>
      <li>
      <label>&nbsp;</label>
     <a href='<?php echo base_url("manage_script/check_script/".$script['col_id'].'/yes')?>' target='rightFrame'><input name='' type='button' class='btn' value='通过' /></a>
      <a href='<?php echo base_url("manage_script/check_script/".$script['col_id']).'/no'?>' target='rightFrame'><input name='' type='button' class='btn' value='拒绝' /></a>  
    </li>
  </ul>
</div>
</body>
</html>
