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
      echo form_open(base_url('diskoffering/update'),'post');
      foreach ($results as $key => $value ) ?>
   <ul class="yun_bt">
     <li class="dq"><a href="<?php echo base_url('diskoffering') ?>">新建Diskoffering</a></li>
   </ul>
   <ul class="forminfo">
    <li>
      <label>云平台名称</label>
          <input name="col_cloud_name" type="text" class="dfinput" readonly="true" value="<?php echo $col_cloud_name ?>"/>
          <input type="button" value="请选择云平台" class="btn" onclick="openwin('<?php echo base_url('cloud/list_page/2') ?>','云列表',900,600)"/>
          <input name="col_cloud_id" type="hidden" class="dfinput" value="<?php echo $value['col_cloud_id'] ?>"/>
          <input name="col_id" type="hidden" class="dfinput" value="<?php echo $value['col_id'] ?>"/>
          <input name="currPage" type="hidden" class="dfinput" value="<?php echo $currPage ?>"/>
          <input name="col_diskoffering_id" type="hidden" class="dfinput" value="<?php echo $value['col_diskoffering_id'] ?>"/>
          <i class="red"><?php echo form_error('col_cloud_name') ?></i>
    </li>
    <li>
      <label>磁盘名称</label>
      <input name="col_name" type="text" class="dfinput" value="<?php echo $value['col_name'] ?>"/>
      <i class="red"><?php echo form_error('col_name') ?></i>
    </li>  
    <li>
      <label>磁盘容积</label>
      <input name="col_size" type="text" class="dfinput" value="<?php echo $value['col_size'] ?>"/>
      <i class="red"><?php echo form_error('col_size') ?></i>
    </li>
    <li>
      <label>磁盘类型</label>
      <input name="col_storagetype" type="radio" value="local" <?php echo ($value['col_storagetype']=='local' ? 'checked="checked"':'' ) ?>>local</input>
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      <input name="col_storagetype" type="radio" value="shared" <?php echo ($value['col_storagetype']=='shared' ? 'checked="checked"':'' ) ?> >shared</input>
    </li>
    <li>
      <label>&nbsp;</label>
      <input type="submit" class="btn" value="提交"/>
    </li>
  </ul>
   <?php }else{
   echo form_open(base_url('diskoffering/create'),'post')?>
   <ul class="yun_bt">
     <li><a href="<?php echo base_url('cloud') ?>">新建云平台</a></li>
     <li><a href="<?php echo base_url('region') ?>">region</a></li>
     <li><a href="<?php echo base_url('zone') ?>">zone</a></li>
     <li class="dq"><a href="<?php echo base_url('diskoffering') ?>">Diskoffering</a></li>
     <li><a href="<?php echo base_url('offering') ?>">Offering</a></li>
     <li><a href="<?php echo base_url('ostype') ?>">Ostype系统</a></li>
     <li><a href="<?php echo base_url('template') ?>">配置模板</a></li>
     <li><a href="<?php echo base_url('gateway') ?>">设置网关</a></li>
  </ul>
  <ul class="forminfo">
    <li>
      <label>云平台名称</label>
          <input name="col_cloud_name" type="text" class="dfinput" readonly="true" value="<?php echo set_value('col_cloud_name') ?>"/>
          <input type="button" value="请选择云平台" class="btn" onclick="openwin('<?php echo base_url('cloud/list_page/2') ?>','云列表',800,600)"/>
          <input name="col_cloud_id" type="hidden" class="dfinput" value="<?php echo set_value('col_cloud_id') ?>"/>
          <i class="red"><?php echo form_error('col_cloud_name') ?></i>
    </li>
    <li>
      <label>磁盘名称</label>
      <input name="col_name" type="text" class="dfinput" value="<?php echo set_value('col_name') ?>"/>
      <i class="red"><?php echo form_error('col_name') ?></i>
    </li>  
    <li>
      <label>磁盘容积</label>
      <input name="col_size" type="text" class="dfinput" value="<?php echo set_value('col_size') ?>"/>
      <i class="red"><?php echo form_error('col_size') ?></i>
    </li>
    <li>
      <label>磁盘类型</label>
      <input name="col_storagetype" type="radio" value="local" <?php echo set_radio('col_storagetype', 'local', TRUE); ?>>local</input>
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      <input name="col_storagetype" type="radio" value="shared" <?php echo set_radio('col_storagetype', 'shared'); ?> >shared</input>
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
