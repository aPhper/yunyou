<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
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
      <div class="listtitle"><a href="yye.html" class="more1">详情</a>平台营业额</div>
      <div class="maintj">
        <img src="<?php echo base_url('images/zx.jpg') ?>" width="" height="253" />
      </div>
    </div>
    <!--leftinfo end-->
    
    <div class="leftinfos">
      <div class="infoleft">
        <div class="listtitle"><a href="<?php echo base_url('report/report_ticket') ?>" class="more1">详情</a>工单统计</div>
         <ul class="newlist">
           <li><i>工单总量：</i><?php echo $tickets[0]['count'] ?></li>
           <li><i>已处理工单量：</i><?php echo $handle_tickets[0]['count'] ?></li>
           <li><i>未处理工单量：</i><?php echo $no_handle_tickets[0]['count'] ?></li>
           <li><i>周内新增工单量：</i><?php echo $week_increase_tickets[0]['count'] ?></li>
           <li><i>日平均处理量：</i><?php echo $avg_tickets[0]['avg'] ?></li>
           <li><i>平均完成率：</i><?php echo $avg_complate ?></li>
         </ul>
      </div>
      <div class="inforight">
        <div class="listtitle"><a href="yye_xnj.html" class="more1">详情</a>虚拟机统计</div>
         <ul class="newlist">
           <li><i>虚拟机总数：</i><?php echo $vms[0]['count'] ?></li>
           <li><i>虚拟机使用量：</i><?php echo $use_vms[0]['count'] ?></li>
           <li><i>虚拟机闲置量：</i><?php echo $no_used_vms[0]['count'] ?></li>
           <li><i>虚拟机故障率：</i><?php echo $error_vms[0]['count'] ?></li>
         </ul>
      </div>
    </div>
  </div>
  <!--mainleft end-->
  
  <div class="mainright">
    <div class="dflist">
      <div class="listtitle"><a href="yye_yh.html" class="more1">详情</a>用户统计</div>
      <ul class="newlist">
        <li><i>总会员数：</i>2535462</li>
        <li><i>今日在线用户数：</i>5546</li>
        <li><i>最高用户在线数：</i>2315</li>
        <li><i>最高在线数日期：</i>2015-5-20</li>
      </ul>
    </div>
    <div class="dflist1">
      <div class="listtitle"><a href="yye_jb.html" class="more1">详情</a>top脚本</div>
      <ul class="newlist">
        <li><i>脚本总量：</i><?php echo $scripts[0]['count'] ?></li>
        <li><i>已使用脚本数：</i><?php echo $use_scripts[0]['count'] ?></li>
        <li><i>审核未通过的脚本数：</i><?php echo $no_pass_scripts[0]['count'] ?></li>
        <li><i>热门脚本数：</i><?php echo $hot_scripts[0]['count'] ?></li>
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
</html>
