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
    <li><a href='#'>游戏管理</a></li>
  </ul>
</div>
<div class='formbody'>
  <div class='formtitle'><span>查看用户信息</span></div>
  <ul class='forminfo'>
      <li>
      <label>游戏名称</label>
      <span class='form_infor'><?php echo $game['col_name']?></span></li>
      <li>
      <label>游戏别名</label>
      <span class='form_infor'><?php echo $game['col_alias']?></span></li>
      <li>
      <label>游戏简拼</label>
      <span class='form_infor'><?php echo $game['col_pinyin_jp']?></span></li>
      <li>
      <label>游戏全拼</label>
      <span class='form_infor'><?php echo $game['col_pinyin_qp']?></span></li>
       <li>
      <label>游戏类型</label>
      <span class='form_infor'><?php echo $game['col_ttype']?></span></li>
        <li>
      <label>游戏种类</label>
      <span class='form_infor'><?php echo $game['col_gtype']?></span></li>
      <li>
      <label>版本号</label>
      <span class='form_infor'><?php echo $game['col_version']?></span></li>
      <li>
      <label>子版本号</label>
      <span class='form_infor'><?php echo $game['col_subversion']?></span></li>
      <li>
      <label>游戏描述</label>
      <span class='form_infor'><?php echo $game['col_desc']?></span></li>
      <label>开发商</label>
      <span class='form_infor'><?php echo $game['col_developer']?></span></li>
      <label>运营商</label>
      <span class='form_infor'><?php echo $game['col_operator']?></span></li>
      <label>游戏上线时间</label>
      <span class='form_infor'><?php echo $game['col_date']?></span></li>
      
      
      <label>&nbsp;</label>
     <a href='<?php echo base_url("manage_game/update_game/".$game['col_id'])?>' target='rightFrame'><input name='' type='button' class='btn' value='修改' /></a> 
    </li>
  </ul>
</div>
</body>
</html>
