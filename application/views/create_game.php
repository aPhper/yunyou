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
  <div class='formtitle'><span>增加游戏</span></div>
  <?php echo form_open_multipart('manage_game/create_game')?>
  <ul class='forminfo'>
    <li>
      <label>游戏名称</label>
      <input name='gamename' type='text' class='dfinput' value="<?php echo set_value('gamename'); ?>" /><?php echo form_error('gamename'); ?>
    </li>
    
    <li>
      <label>游戏别名</label>
      <input name='name' type='text ' class='dfinput' value="<?php echo set_value('name'); ?>"  /><?php echo form_error('name'); ?>
    </li>
   <li>
      <label>游戏简拼</label>
      <input name='pinyin_jp' type='text' class='dfinput' value="<?php echo set_value('pinyin_jp'); ?>"  /><?php echo form_error('pinyin_jp'); ?>
    </li>
    <li>
      <label>游戏全拼</label>
      <input name='pinyin_qp' type='text'  class='dfinput' value="<?php echo set_value('pinyin_qp'); ?>"  /><?php echo form_error('pinyin_qp'); ?>
    </li>
    <li>
      <label>游戏类型</label>
      <input name='ttype' type='text'  class='dfinput' value="<?php echo set_value('ttype'); ?>"  /><?php echo form_error('ttype'); ?>
    </li>
    <li>
      <label>游戏种类</label>
      <input name='gtype' type='text'  class='dfinput' value="<?php echo set_value('gtype'); ?>"  /><?php echo form_error('gtype'); ?>
    </li>
    <li>
      <label>版本号</label>
      <input name='version' type='text'  class='dfinput' value="<?php echo set_value('version'); ?>"  /><?php echo form_error('version'); ?>
    </li>
    <li>
      <label>子版本号</label>
      <input name='subversion' type='text' class='dfinput' value="<?php echo set_value('subversion'); ?>"  /><?php echo form_error('subversion'); ?>
    </li>
    <li>
      <label>游戏描述</label>
      <textarea rows="" cols="" name='desc'><?php echo set_value('desc'); ?></textarea><?php echo form_error('desc');?>
    </li>
    <li>
      <label>开发商</label>
      <input name='developer' type='text' class='dfinput' value="<?php echo set_value('developer'); ?>"  /><?php echo form_error('developer'); ?>
    </li>
     <li>
      <label>运营商</label>
      <input name='operator' type='text'  class='dfinput' value="<?php echo set_value('operator'); ?>"  /><?php echo form_error('operator'); ?>
    </li>
    <li>
      <label>游戏上线时间</label>
      <input name='date' type='text'  class='dfinput' value="<?php echo set_value('date'); ?>"  /><?php echo form_error('date'); ?>
    </li>
    <li>
      <label>游戏图片</label>
      <input type="file" name="pic" value="<?php echo set_value('date'); ?>"/>
      
    </li>
    <li>
      <label>&nbsp;</label>
      <input name='submit' type='submit' class='btn' value='增加'/><?php if(isset($post_info)){echo $post_info;}?>
    </li>
  </ul>
</div>
</body>
</html>
