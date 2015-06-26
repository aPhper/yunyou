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
      echo form_open(base_url('cloud/update'),'post');
      foreach ($results as $key => $value ) ?>
  <ul class="yun_bt">
     <li class="dq"><a href="<?php echo base_url('cloud') ?>">新建云平台</a></li>
  </ul>
  <ul class="forminfo">
    <li>
      <label>云平台名称</label>
      <input name="col_name" type="text" class="dfinput" value="<?php echo $value['col_name'] ?>"/>
      <input name="col_id" type="hidden" class="dfinput" value="<?php echo $value['col_id'] ?>"/>
      <input name="currPage" type="hidden" class="dfinput" value="<?php echo $currPage ?>"/>
      <i class="red"><?php echo form_error('col_name') ?></i>
    </li>
    <li>
      <label>云平台IP</label>
      <input name="col_ip" type="text" class="dfinput" value="<?php echo $value['col_ip'] ?>"/>
      <i class="red"><?php echo form_error('col_ip') ?></i>
    </li>  
    <li>
      <label>端口号</label>
      <input name="col_port" type="text" class="dfinput" value="<?php echo $value['col_port'] ?>"/>
      <i class="red"><?php echo form_error('col_port') ?></i>
    </li>
    <li>
      <label>云平台接口地址</label>
      <input name="col_url" type="text" class="dfinput" value="<?php echo $value['col_url'] ?>"/>
      <i class="red"><?php echo form_error('col_url') ?></i>
    </li>
    <li>
      <label>Apikey</label>
      <input name="col_apikey" type="text" class="dfinput" value="<?php echo $value['col_apikey'] ?>"/>
      <i class="red"><?php echo form_error('col_apikey') ?></i>
    </li>
    <li>
      <label>Seckey</label>
      <input name="col_seckey" type="text" class="dfinput" value="<?php echo $value['col_seckey'] ?>"/>
      <i class="red"><?php echo form_error('col_seckey') ?></i>
    </li>
    <li>
      <label>描述</label>
      <textarea name="col_desc" cols="" rows="" class="textinput"><?php echo $value['col_desc'] ?></textarea>
      <i class="red"><?php echo form_error('col_desc') ?></i>
    </li>
    <li>
      <label>联系人</label>
      <input name="col_contactname" type="text" class="dfinput" value="<?php echo $value['col_contactname'] ?>"/>
      <i class="red"><?php echo form_error('col_contactname') ?></i>
    </li>
    <li>
      <label>联系人电话</label>
      <input name="col_contactcall" type="text" class="dfinput" value="<?php echo $value['col_contactcall'] ?>"/>
      <i class="red"><?php echo form_error('col_contactcall') ?></i>
    </li>
    <li>
      <label>&nbsp;</label>
      <input type="submit" class="btn" value="提交"/>
    </li>
  </ul>
  <?php }else{
  echo form_open(base_url('cloud/create'),'post');?>
  <ul class="yun_bt">
     <li class="dq"><a href="<?php echo base_url('cloud') ?>">新建云平台</a></li>
     <li><a href="<?php echo base_url('region') ?>">region</a></li>
     <li><a href="<?php echo base_url('zone') ?>">zone</a></li>
     <li><a href="<?php echo base_url('diskoffering') ?>">Diskoffering</a></li>
     <li><a href="<?php echo base_url('offering') ?>">Offering</a></li>
     <li><a href="<?php echo base_url('ostype') ?>">Ostype系统</a></li>
     <li><a href="<?php echo base_url('template') ?>">配置模板</a></li>
     <li><a href="<?php echo base_url('gateway') ?>">设置网关</a></li>
  </ul>
  <ul class="forminfo">
    <li>
      <label>云平台名称</label>
      <input name="col_name" type="text" class="dfinput" value="<?php echo set_value('col_name') ?>"/>
      <i class="red"><?php echo form_error('col_name') ?></i>
    </li>
    <li>
      <label>云平台IP</label>
      <input name="col_ip" type="text" class="dfinput" value="<?php echo set_value('col_ip') ?>"/>
      <i class="red"><?php echo form_error('col_ip') ?></i>
    </li>  
    <li>
      <label>端口号</label>
      <input name="col_port" type="text" class="dfinput" value="<?php echo set_value('col_port') ?>"/>
      <i class="red"><?php echo form_error('col_port') ?></i>
    </li>
    <li>
      <label>云平台接口地址</label>
      <input name="col_url" type="text" class="dfinput" value="<?php echo set_value('col_url') ?>"/>
      <i class="red"><?php echo form_error('col_url') ?></i>
    </li>
    <li>
      <label>Apikey</label>
      <input name="col_apikey" type="text" class="dfinput" value="<?php echo set_value('col_apikey') ?>"/>
      <i class="red"><?php echo form_error('col_apikey') ?></i>
    </li>
    <li>
      <label>Seckey</label>
      <input name="col_seckey" type="text" class="dfinput" value="<?php echo set_value('col_seckey') ?>"/>
      <i class="red"><?php echo form_error('col_seckey') ?></i>
    </li>
    <li>
      <label>描述</label>
      <textarea name="col_desc" cols="" rows="" class="textinput"><?php echo set_value('col_desc') ?></textarea>
      <i class="red"><?php echo form_error('col_desc') ?></i>
    </li>
    <li>
      <label>联系人</label>
      <input name="col_contactname" type="text" class="dfinput" value="<?php echo set_value('col_contactname') ?>"/>
      <i class="red"><?php echo form_error('col_contactname') ?></i>
    </li>
    <li>
      <label>联系人电话</label>
      <input name="col_contactcall" type="text" class="dfinput" value="<?php echo set_value('col_contactcall') ?>"/>
      <i class="red"><?php echo form_error('col_contactcall') ?></i>
    </li>
    <li>
      <label>&nbsp;</label>
      <input type="submit" class="btn" value="提交"/>
    </li>
  </ul>
  <?php }?>
</div>
</body>
</html>
