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
<div class="formbody">
  <div class="formtitle"><span>回复工单</span></div>
  <ul class="forminfo">
    <li>
      <label>用户</label>
      <span class="form_text"><?php echo $ticket['user_name']?></span> </li>
    <li>
      <label>产生日期</label>
      <span class="form_text"><?php echo $ticket['ttime']?></span> </li>
    <li>
      <label>工单描述</label>
      <div class="usercity"> <span class="form_text" style="width:680px;"><?php echo $ticket['question']?></span></div>
    </li>
  </ul>
  <?php echo form_open('manage_ticket/reply_ticket')?>
  <?php echo form_hidden('hidden','hidden')?>
  <input name="ticket_id" type="hidden" class="dfinput" value="<?php echo $ticket_id?>"/>
  <ul class="forminfo">
   <li>
          <label>回复</label>
          <input type='text' name='reply' class="dfinput"/>
    </li>
    <li>
      <label>&nbsp;</label>
      <input name="submit" type="submit" class="btn click" value="提交"/>
    </li>
  </ul>
  </form>
</div>

<div class='formbody'>
 
</div>
<script type='text/javascript'> 
      $('#usual1 ul').idTabs(); 
    </script> 
<script type='text/javascript'>
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

</body>
</html>




































