<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>无标题文档</title>
<link href='<?php echo base_url();?>css/style.css' rel='stylesheet' type='text/css' />
<link href='<?php echo base_url();?>css/select.css' rel='stylesheet' type='text/css' />
<script type='text/javascript' src='<?php echo base_url();?>js/jquery.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/jquery.idTabs.min.js'></script>
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
/*转单弹窗*/
  $('.zd_click').click(function(){
  $('.zd_tip').fadeIn(200);
  });
  
  $('.tiptop a').click(function(){
  $('.zd_tip').fadeOut(200);
});

  $('.sure').click(function(){
  $('.zd_tip').fadeOut(100);
});

  $('.cancel').click(function(){
  $('.zd_tip').fadeOut(100);
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
    <li> <a href='#'> 客服管理 </a> </li>
    <li> <a href='#'> 工单管理 </a> </li>
  </ul>
</div>
<div class='formbody'>
  <div class='formtitle'> <span> 工单详情 </span> </div>
  
  <ul class='forminfo form_over'>
    <li>
      <label>工单类型</label>
      <span class='form_text'><?php echo $ticket_type[$ticket['col_type_id']]?></span> </li>
    <li>
      <label>工单用户</label>
      <span class='form_text'><?php echo $ticket['user_name']?></span> </li>
    <li>
      <label>工单详情</label>
      <span class='form_text'><?php echo $ticket['question']?></span> </li>
    <li>
      <label>工单时间</label>
      <span class='form_text'><?php echo $ticket['ttime']?></li>
    
  </ul>
  <div class='formtitle'> <span> 处理详情 </span> </div>
  <ul class='forminfo form_over'>
  <?php if($ticket['status']=='Y'){?>
    <li>
      <label>处理结果</label>
      <span class='form_text'><?php echo $ticket['col_content']?></span> </li>
    <li>
      <label>处理时间</label>
      <div class='usercity'> <span class='form_text' style='width:680px;'><?php echo $ticket['col_time']?></span></div>
    </li>
    <?php }else{?>
    <li>
      <label>处理结果</label>
      <div class='usercity'> <span class='form_text' style='width:680px;'>未处理</span></div>
    </li>
    <?php }?>
  </ul>
  
  
</div>
<script type='text/javascript'> 
      $('#usual1 ul').idTabs(); 
    </script> 
<script type='text/javascript'>
	$('.tablelist tbody tr:odd').addClass('odd');
	</script> 

</body>
</html>
