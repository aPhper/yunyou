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
  <div id='usual1' class='usual'>
    <div class='itab'>
      <ul>
        <li> <a href='#tab1' class='selected'> 未处理工单 </a> </li>
        <li> <a href='#tab2'> 已处理工单 </a> </li>
      </ul>
    </div>
    <div id='tab1' class='tabson'>
      
      <table class='tablelist'>
        <thead>
          <tr>
            <th width='60'>序号<i class='sort'><img src='<?php echo base_url();?>images/px.gif' /></i></th>
            <th>类型</th>
            <th>工单用户</th>
            <th>工单详情</th>
            <th>工单时间</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if(!empty($ticket['unfinished'])){ 
                foreach($ticket['unfinished'] as $key=>$value){
                    
        ?>
          <tr>
            <td><?php echo  $key;?></td>
            <td><?php echo $ticket_type[$value['col_type_id']];?></td>
            <td><?php echo $value['user_name'];?></td>
            <td><?php echo $value['question']?></td>
            <td><?php echo $value['ttime']?></td>
            
            <td><a href='<?php echo base_url('manage_ticket/view_ticket/'.$value['ticket_id'])?>' class='tablelink'> 查看 </a> &nbsp;&nbsp;&nbsp; <a href='<?php echo base_url('manage_ticket/reply_ticket/'.$value['ticket_id']);?>' class='tablelink click'> 处理 </a> &nbsp;&nbsp;&nbsp; <a href='<?php echo base_url('manage_ticket/change_ticket/'.$value['ticket_id'])?>' class='tablelink' > 转单 </a> &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>
    <div id='tab2' class='tabson'>
      
      <table class='tablelist'>
        <thead>
          <tr>
            <th width='60'>序号<i class='sort'><img src='<?php echo base_url();?>images/px.gif' /></i></th>
            <th>类型</th>
            <th>工单用户</th>
            <th>工单详情</th>
            <th>工单时间</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($ticket['finished'])){ 
                foreach($ticket['finished'] as $key=>$value){
                   
        ?>
        
          <tr>
            <td><?php echo  $key;?></td>
            <td><?php echo $ticket_type[$value['col_type_id']];?></td>
            <td><?php echo $value['user_name'];?></td>
            <td><?php echo $value['question']?></td>
            <td><?php echo $value['ttime']?></td>
            
            <td><a href='<?php echo base_url('manage_ticket/view_ticket/'.$value['ticket_id'])?>' class='tablelink'> 查看 </a> &nbsp;&nbsp;&nbsp; </td>
          </tr>
          <?php }}?>
        </tbody>
      </table>
    </div>  
    
  </div>
</div>
<script type='text/javascript'> 
      $('#usual1 ul').idTabs(); 
    </script> 
<script type='text/javascript'>
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>
</html>
