<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/select.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/select-ui.min.js') ?>"></script>
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
});
function openwin(url,name,iWidth,iHeight){
	var iTop = (window.screen.availHeight-30-iHeight)/2;       //获得窗口的垂直位置;
	var iLeft = (window.screen.availWidth-10-iWidth)/2;           //获得窗口的水平位置;
	window.open(url,name,'height='+iHeight+',innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
}
</script>
</head>

<body>
<div class="place"> <span>位置：</span>
  <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">运维管理</a></li>
    <li><a href="#">创建云平台</a></li>
  </ul>
</div>
<div class="formbody">
  <div class="formtitle"><span>配置云平台信息</span></div>
  <?php if(!empty($results)){ 
      echo form_open(base_url('gateway/update'),'post');
      foreach ($results as $key => $value ) ?>
   <ul class="yun_bt">
     <li class="dq"><a href="<?php echo base_url('gateway') ?>">新建gateway</a></li>
   </ul>
  <ul class="forminfo">
    <li>
      <label>zone名称</label>
      <input name="col_zone_name" type="text" class="dfinput" readonly="true" value="<?php echo $col_zone_name ?>"/>
      <input type="button" value="请选择zone" class="btn" onclick="openwin('<?php echo base_url('zone/list_page/2') ?>','zone列表',900,600)"/>
      <input name="col_zone_id" type="hidden" class="dfinput" value="<?php echo $value['col_zone_id'] ?>"/>
      <input name="col_id" type="hidden" class="dfinput" value="<?php echo $value['col_id'] ?>"/>
      <input name="currPage" type="hidden" class="dfinput" value="<?php echo $currPage ?>"/>
      <i class="red"><?php echo form_error('col_zone_name') ?></i>
    </li>
    <li>
      <label>网关IP</label>
      <input name="col_ip" type="text" class="dfinput" value="<?php echo $value['col_ip'] ?>"/>
      <i class="red"><?php echo form_error('col_ip') ?></i>
    </li>  
    <li>
      <label>端口号</label>
      <input name="col_port" type="text" class="dfinput" value="<?php echo $value['col_port'] ?>"/>
      <i class="red"><?php echo form_error('col_port') ?></i>
    </li>
    <li>
      <label>网关地址</label>
      <input name="col_url" type="text" class="dfinput" value="<?php echo $value['col_url'] ?>"/>
      <i class="red"><?php echo form_error('col_url') ?></i>
    </li>
    <li>
      <label>用户名</label>
      <input name="col_user" type="text" class="dfinput" value="<?php echo $value['col_user'] ?>"/>
      <i class="red"><?php echo form_error('col_user') ?></i>
    </li>
    <li>
      <label>密码</label>
      <input name="col_passwd" type="password" class="dfinput" value="<?php echo $value['col_passwd'] ?>"/>
      <i class="red"><?php echo form_error('col_passwd') ?></i>
    </li>
    <li>
      <label>确认密码</label>
      <input name="col_passwd_conf" type="password" class="dfinput" value="<?php echo $value['col_passwd'] ?>"/>
      <i class="red"><?php echo form_error('col_passwd_conf') ?></i>
    </li>
    <li>
      <label>&nbsp;</label>
      <input type="submit" class="btn" value="提交"/>
    </li>
  </ul>
  <?php }else{
   echo form_open(base_url('gateway/create'),'post')?> 
  <ul class="yun_bt">
     <li><a href="<?php echo base_url('cloud') ?>">新建云平台</a></li>
     <li><a href="<?php echo base_url('region') ?>">region</a></li>
     <li><a href="<?php echo base_url('zone') ?>">zone</a></li>
     <li><a href="<?php echo base_url('diskoffering') ?>">Diskoffering</a></li>
     <li><a href="<?php echo base_url('offering') ?>">Offering</a></li>
     <li><a href="<?php echo base_url('ostype') ?>">Ostype系统</a></li>
     <li><a href="<?php echo base_url('template') ?>">配置模板</a></li>
     <li class="dq"><a href="<?php echo base_url('gateway') ?>">设置网关</a></li>
  </ul>
  <ul class="forminfo">
    <li>
      <label>zone名称</label>
      <input name="col_zone_name" type="text" class="dfinput" readonly="true" value="<?php echo set_value('col_zone_name') ?>"/>
      <input type="button" value="请选择zone" class="btn" onclick="openwin('<?php echo base_url('zone/list_page/2') ?>','zone列表',900,600)"/>
      <input name="col_zone_id" type="hidden" class="dfinput" value="<?php echo set_value('col_zone_id') ?>"/>
      <i class="red"><?php echo form_error('col_zone_name') ?></i>
    </li>
    <li>
      <label>网关IP</label>
      <input name="col_ip" type="text" class="dfinput" value="<?php echo set_value('col_ip') ?>"/>
      <i class="red"><?php echo form_error('col_ip') ?></i>
    </li>  
    <li>
      <label>端口号</label>
      <input name="col_port" type="text" class="dfinput" value="<?php echo set_value('col_port') ?>"/>
      <i class="red"><?php echo form_error('col_port') ?></i>
    </li>
    <li>
      <label>网关地址</label>
      <input name="col_url" type="text" class="dfinput" value="<?php echo set_value('col_url') ?>"/>
      <i class="red"><?php echo form_error('col_url') ?></i>
    </li>
    <li>
      <label>用户名</label>
      <input name="col_user" type="text" class="dfinput" value="<?php echo set_value('col_user') ?>"/>
      <i class="red"><?php echo form_error('col_user') ?></i>
    </li>
    <li>
      <label>密码</label>
      <input name="col_passwd" type="password" class="dfinput" value="<?php echo set_value('col_passwd') ?>"/>
      <i class="red"><?php echo form_error('col_passwd') ?></i>
    </li>
    <li>
      <label>确认密码</label>
      <input name="col_passwd_conf" type="password" class="dfinput" value="<?php echo set_value('col_passwd_conf') ?>"/>
      <i class="red"><?php echo form_error('col_passwd_conf') ?></i>
    </li>
    <li>
      <label>&nbsp;</label>
      <input type="submit" class="btn" value="提交"/>
    </li>
  </ul>
  <?php } ?>
</div>
</body>
</html>
