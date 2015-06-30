<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>无标题文档</title>
<link href='<?php echo base_url() ;?>css/style.css' rel='stylesheet' type='text/css' />
<link href='<?php echo base_url() ;?>css/select.css' rel='stylesheet' type='text/css' />
<script type='text/javascript' src='<?php echo base_url() ;?>js/jquery.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ;?>js/select-ui.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ;?>js/highcharts.js'></script>
<script type='text/javascript' src='<?php echo base_url() ;?>js/exporting.js'></script>
<script type='text/javascript' src='<?php echo base_url() ;?>js/chart.js'></script>
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
    <li><a href='#'>报表管理</a></li>
  </ul>
</div>
<div class='mainbox'>
  <div class='mainleft'>
    <div class='leftinfo'>
      <div class='listtitle'>用户统计</div>
      <div class='rightinfo'>
        <ul class='seachform'>
        <?php echo form_open('report/report_user')?>
          <li>
            <label>按时间段查看</label>
            <div class='vocation'>
              <select class='select3'>
                <option value='day'>天</option>
                <option value='week'>周</option>
                <option value='month' selected='selected'>月</option>
                
              </select>
            </div>
          </li>
          <li>
            <label>&nbsp;</label>
            <input name='' type='button' class='scbtn' value='查询'/>
          </li>
        </ul>
        <div style='clear:both;'id='container'></div>
        
      </div>
      <!--rightinfo end --> 
    </div>
    <!--leftinfo end--> 
    
  </div>
  <!--mainleft end-->
  
  <div class='mainright'>
    <div class='dflist'>
      <div class='listtitle'>用户统计</div>
      <ul class='newlist'>
        <li><i>总会员数：</i><?php echo $total_user['0']['num']?></li>
        <li><i>今日在线用户数：</i><?php echo $online_now_day['0']['num']?></li>
        <li><i>当前在线:</i><?php echo $online_now['0']['num']?></li>
        
      </ul>
    </div>
    <div class='dflist1'>
      <div class='listtitle'>top活跃用户</div>
      <ul class='rightinfo'>
        <table class='tablelist'>
          <thead>
            <tr>
              <th width='60'>序号</th>
              <th>用户名称</th>
              <th>活跃度</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach ($user_top as $key =>$value){?>
              <td><?php echo ($key+1);?></td>
              <td><?php echo $value['username']?></td>
              <td><?php echo $value['num']?></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </ul>
    </div>
  </div>
  <!--mainright end--> 
  
</div>

</body>
<script type='text/javascript' src='<?php echo base_url() ;?>js/chart.js'></script>
<script type='text/javascript'>
	setWidth();
	$(window).resize(function(){
		setWidth();	
	});
	function setWidth(){
		var width = ($('.leftinfos').width()-12)/2;
		$('.infoleft,.inforight').width(width);
	}
</script>
<script type='text/javascript'>
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</html>
