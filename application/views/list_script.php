<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>无标题文档</title>
<link href='<?php echo base_url();?>css/style.css' rel='stylesheet' type='text/css' />
<link href='<?php echo base_url();?>css/select.css' rel='stylesheet' type='text/css' />
<script type='text/javascript' src='<?php echo base_url();?>js/jquery.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/select-ui.min.js'></script>
<script type='text/javascript'>
$(document).ready(function(){
  $('.click').click(function(){
  $('.tip').fadeIn(200);
  });
  
  $('.tiptop a').click(function(){
  $('.tip').fadeOut(200);
});

  $('.sure').click(function(){
  $('.tip').fadeOut(100);
});

  $('.cancel').click(function(){
  $('.tip').fadeOut(100);
});

});
</script>
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
<div class='place'> <span> 位置： </span>
  <ul class='placeul'>
    <li> <a href='#'> 首页 </a> </li>
    <li> <a href='#'> 运营管理 </a> </li>
    <li> <a href='#'> 脚本管理 </a> </li>
  </ul>
</div>
<div class='rightinfo'>
 
  <table class='tablelist'>
    <thead>
      <tr>
        <th width='60'>序号<i class='sort'><img src='<?php echo base_url();?>images/px.gif' /></i></th>
        <th>游戏</th>
        <th>标题</th>
        <th>作者</th>
        <th>状态</th>
        <th>审核结果</th>
        <th>上传日期</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(isset($script_list)){
        foreach ($script_list as $key =>$value){
    ?>
      <tr>
        <td><?php echo $key?></td>
        <td><?php echo $value['game_name']?></td>
        <td><?php echo $value['script_name']?></td>
        <td><?php echo $value['col_nickname']?></td>
        <td><?php echo $value['col_status']?></td>
        <td><?php echo $check[$value['col_check']]?></td>
        <td><?php echo $value['col_date']?></td>
        <td><a href='<?php echo base_url("manage_script/view_script/".$value['script_id'])?>' class='tablelink' target='rightFrame'>查看审核</a> &nbsp;&nbsp;&nbsp;
         
         <a href='<?php echo base_url("manage_script/delete_script/".$value['script_id'])?>' class='tablelink'> 删除 </a></td>
      </tr>
      <?php }}?>
    </tbody>
  </table>
  <div class='pagin'>
    <div class='message'>共<i class='blue'><?php echo $total;?></i>条记录
    <ul class='paginList'>
    <?php echo $link;?> 
    </ul>
  </div>

<script type='text/javascript'>
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>
</html>
