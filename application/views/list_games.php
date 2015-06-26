<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/select.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.idTabs.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/select-ui.min.js') ?>"></script>
<script type="text/javascript">

</script>
</head>

<body>
<div class="place"> <span>位置：</span>
  <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">客服管理</a></li>
    <li><a href="#">资源管理</a></li>
  </ul>
</div>
<div class="formbody">
  <div id="usual1" class="usual">
    <div class="itab">
      <ul>
        <li><a href="<?php echo base_url('resource/list_games/'.$userid) ?>" class="selected">游戏记录</a></li>
        <li><a href="">账户记录</a></li>
        <li><a href="<?php echo base_url('resource/list_tickets/'.$userid) ?>">工单记录</a></li>
      </ul>
    </div>
    <div class="tabson">
      <div class="formtext"><b><?php echo ($userrole ==='user' ? '用户':'作者' )?>:<?php echo $username ?></b>的游戏记录信息</div>
      <table class="tablelist">
        <thead>
          <tr>
            <th width="60">序号<i class="sort"><img src="<?php echo base_url('images/px.gif') ?>" /></i></th>
            <th>游戏名称</th>
            <th>脚本标题</th>
            <th>脚本发布日期</th>
            <th>开始使用日期</th>
            <th>截止使用日期</th>
            <th>游戏状态</th>
          </tr>
        </thead>
        <tbody>
       <?php if(!empty($results)){
        foreach ($results as $key => $value){ ?>
          <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $value['game_name'] ?></td>
            <td><a href="javascript:void(0);"><?php echo $value['script_name'] ?></a></td>
            <td><?php echo $value['release_date'] ?></td>
            <td><?php echo $value['start_time'] ?></td>
            <td><?php echo $value['end_time'] ?></td>
            <td><?php echo $value['status'] ?></td>
          </tr>
          <?php }}else { ?>
          <tr align="center">
            <td colspan="7"><h3>暂时没有要查询的记录</h3></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>    
  </div>
</div>
<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script> 
  <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script> 
</body>
</html>
