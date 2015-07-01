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
         <ul class="seachform">
        <?php echo form_open(base_url('report/report_user'),'post'); ?>
          <li>
            <label>按时间段查看</label>
            <div class="vocation">
              <select class="select3" name='serch'>
                <option value='1' <?php echo ($serch == '1' ? 'selected="selected"':'') ?>>月</option>
                <option value='2' <?php echo ($serch == '2' ? 'selected="selected"':'') ?>>周</option>
                <option value='3' <?php echo ($serch == '3' ? 'selected="selected"':'') ?>>最近一周</option>
                <option value='4' <?php echo ($serch == '4' ? 'selected="selected"':'') ?>>最近一月</option>
              </select>
            </div>
          </li>
          <li>
            <label>&nbsp;</label>
            <input name="" type="submit" class="scbtn" value="查询"/>
          </li>
        </ul>
        <div style='clear:both;'id='container'></div>
        <table class="tablelist">
          <thead>
            <tr>
              <th width="60">序号<i class="sort"><img src="<?php echo base_url('images/px.gif') ?>" /></i></th>
              <th>日期</th>
              <th>新增用户</th>
            </tr>
          </thead>
          <tbody>
          <?php if(!empty($user_records)){
        foreach ($user_records as $key1 => $value1){ ?>
            <tr>
              <td><?php echo $key1+1 ?></td>
              <td><?php 
              if($serch =='1'){//月工单数
                  echo $value1['mon'].'月';
              }elseif ($serch =='2'){//周工单数
                  echo $value1['mon'].'周';
              }elseif ($serch == '3'){//最近一周工单
                  echo '周'.$value1['mon'];
              }elseif ($serch == '4'){
                  echo $value1['mon'].'号';
              }    
               ?></td>
              <td><?php echo $value1['count'] ?></td>
              
            </tr>
            <?php }}else { ?>
          <tr align="center">
            <td colspan="6"><h3>暂时没有要查询的记录</h3></td>
          </tr>
          <?php } ?>            
          </tbody>
        </table>
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
<div>
<input type='hidden' id='x' value="<?php print_r($x);?>" />
<input type='hidden' id='y' value="<?php print_r($y);?>"  />
<input type='hidden' id='title' value='用户统计图'/>
<input  type='hidden' id='y_title' value='用户条数'/>
<input type='hidden' id='line_name'value='用户总量'/>
<input type='hidden' id='series_name' value='用户统计'/>
<input type='hidden' id='x_title' value='<?php if($serch =='1'){//月用户数
                  echo $value1['mon'].'月';
              }elseif ($serch =='2'){//周用户数
                  echo $value1['mon'].'周';
              }elseif ($serch == '3'){//最近一周用户
                  echo '周'.$value1['mon'];
              }elseif ($serch == '4'){
                  echo $value1['mon'].'号';
              } ?>'/>
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
	drawing();
</script>
<script type='text/javascript'>
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</html>
