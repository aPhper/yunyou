<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/select.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/select-ui.min.js') ?>"></script>
<script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/exporting.js"></script>
  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
	$('#container').highcharts({
        title: {
            text: 'Monthly Average Temperature',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: WorldClimate.com',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'New York',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Berlin',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
});
</script>
</head>

<body>
<div class="place"> <span>位置：</span>
  <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">运营管理</a></li>
    <li><a href="#">报表管理</a></li>
  </ul>
</div>
<div class="mainbox">
  <div class="mainleft">
    <div class="leftinfo">
      <div class="listtitle">工单统计</div>
      <div class="rightinfo">
        <ul class="seachform">
        <?php echo form_open(base_url('report/report_ticket'),'post'); ?>
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
        <div style="clear:both;" id='container'>  </div>
        <table class="tablelist">
          <thead>
            <tr>
              <th width="60">序号<i class="sort"><img src="<?php echo base_url('images/px.gif') ?>" /></i></th>
              <th>日期</th>
              <th>工单总量</th>
              <th>已处理工单量</th>
              <th>未处理工单量</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php if(!empty($ticket_records)){
        foreach ($ticket_records as $key1 => $value1){ ?>
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
              <td><?php echo $value1['county'] ?></td>
              <td><?php echo $value1['countn'] ?></td>
              <td><a href="">查看详情</a></td>
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
  
  <div class="mainright">
    <div class="dflist">
      <div class="listtitle">工单总统计</div>
         <ul class="newlist">
           <li><i>工单总量：</i><?php echo $tickets[0]['count'] ?></li>
           <li><i>已处理工单量：</i><?php echo $handle_tickets[0]['count'] ?></li>
           <li><i>未处理工单量：</i><?php echo $no_handle_tickets[0]['count'] ?></li>
           <li><i>周内新增工单量：</i><?php echo $week_increase_tickets[0]['count'] ?></li>
           <li><i>日平均处理量：</i><?php echo $avg_tickets[0]['avg'] ?></li>
           <li><i>平均完成率：</i><?php echo $avg_complate ?></li>
         </ul>
    </div>
    <div class="dflist1">
      <div class="listtitle">top工单脚本排行</div>
      <ul class="rightinfo">
        <table class="tablelist">
          <thead>
            <tr>
              <th width="60">序号</th>
              <th>游戏名称</th>
              <th>脚本名称</th>
              <th>工单数量</th>
            </tr>
          </thead>
          <tbody>
          <?php if(!empty($tickets_top)){
        foreach ($tickets_top as $key => $value){ ?>
            <tr>
              <td><?php echo $key+1 ?></td>
              <td><?php echo $value['game_name'] ?></td>
              <td><a href="javascript:void(0);"><?php echo $value['script_name'] ?></a></td>
              <td><?php echo $value['count'] ?></td>
            </tr>
            <?php }}else { ?>
          <tr align="center">
            <td colspan="4"><h3>暂时没有要查询的记录</h3></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </ul>
    </div>
  </div>
  <!--mainright end--> 
  
</div>
</body>
<script type="text/javascript">
	setWidth();
	$(window).resize(function(){
		setWidth();	
	});
	function setWidth(){
		var width = ($('.leftinfos').width()-12)/2;
		$('.infoleft,.inforight').width(width);
	}
</script>
<script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</html>
