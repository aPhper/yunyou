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
      echo form_open(base_url('offering/update'),'post');
      foreach ($results as $key => $value ) ?>
  <ul class="yun_bt">
     <li class="dq"><a href="<?php echo base_url('offering') ?>">新建Offering</a></li>
  </ul>
   <ul class="forminfo">
    <li>
      <label>云平台名称</label>
          <input name="col_cloud_name" type="text" class="dfinput" readonly="true" value="<?php echo $col_cloud_name ?>"/>
          <input type="button" value="请选择云平台" class="btn" onclick="openwin('<?php echo base_url('cloud/list_page/2') ?>','云列表',900,600)"/>
          <input name="col_cloud_id" type="hidden" class="dfinput" value="<?php echo $value['col_cloud_id'] ?>"/>
          <input name="col_id" type="hidden" class="dfinput" value="<?php echo $value['col_id'] ?>"/>
          <input name="currPage" type="hidden" class="dfinput" value="<?php echo $currPage ?>"/>
          <input name="col_offering_id" type="hidden" class="dfinput" value="<?php echo $value['col_offering_id'] ?>"/>
          <i class="red"><?php echo form_error('col_cloud_name') ?></i>
    </li>
    <li>
      <label>offering名称</label>
      <input name="col_name" type="text" class="dfinput" value="<?php echo $value['col_name'] ?>"/>
      <i class="red"><?php echo form_error('col_name') ?></i>
    </li>  
    <li>
      <label>cpu核数</label>
      <input name="col_cpunumber" type="radio" value="1" <?php echo ($value['col_cpunumber'] == '1' ? 'checked="checked"':'') ?>>单核</input>
      <input name="col_cpunumber" type="radio" value="2" <?php echo ($value['col_cpunumber'] == '2' ? 'checked="checked"':'') ?>>双核</input>
      <input name="col_cpunumber" type="radio" value="3" <?php echo ($value['col_cpunumber'] == '3' ? 'checked="checked"':'') ?>>3核</input>
      <input name="col_cpunumber" type="radio" value="4" <?php echo ($value['col_cpunumber'] == '4' ? 'checked="checked"':'') ?>>4核</input>
      <input name="col_cpunumber" type="radio" value="6" <?php echo ($value['col_cpunumber'] == '6' ? 'checked="checked"':'') ?>>6核</input>
      <input name="col_cpunumber" type="radio" value="8" <?php echo ($value['col_cpunumber'] == '8' ? 'checked="checked"':'') ?>>8核</input>
      <input name="col_cpunumber" type="radio" value="16" <?php echo ($value['col_cpunumber'] == '16' ? 'checked="checked"':'') ?>>16核</input>
      <i class="red"><?php echo form_error('col_cpunumber') ?></i>
    </li>  
    <li>
      <label>cpu速度</label>
      <input name="col_cpuspeed" type="text" class="dfinput" value="<?php echo $value['col_cpuspeed'] ?>"/>
      <i class="red"><?php echo form_error('col_cpuspeed') ?></i>
    </li>  
    <li>
      <label>内存大小</label>
      <input name="col_memory" type="radio" value="512" <?php echo ($value['col_memory'] == 512 ? 'checked="checked"':'') ?>>512MB</input>
      <input name="col_memory" type="radio" value="1024" <?php echo ($value['col_memory'] == 1024 ? 'checked="checked"':'') ?>>1GB</input>
      <input name="col_memory" type="radio" value="2048" <?php echo ($value['col_memory'] == 2048 ? 'checked="checked"':'') ?>>2GB</input>
      <input name="col_memory" type="radio" value="4096" <?php echo ($value['col_memory'] == 4096 ? 'checked="checked"':'') ?>>4GB</input>
      <i class="red"><?php echo form_error('col_memory') ?></i>
    </li>  
    <li>
      <label>状态</label>
      <input name="col_status" type="radio" value="1" <?php echo ($value['col_status'] == '1' ? 'checked="checked"':'') ?>>正常</input>
      <input name="col_status" type="radio" value="2" <?php echo ($value['col_status'] == '2' ? 'checked="checked"':'') ?>>默认</input>
      <input name="col_status" type="radio" value="3" <?php echo ($value['col_status'] == '3' ? 'checked="checked"':'') ?>>推荐</input>
      <i class="red"><?php echo form_error('col_status') ?></i>
    </li>  
    <li>
      <label>价格(单位:元)</label>
      <input name="col_price" type="text" class="dfinput" value="<?php echo $value['col_price'] ?>"/>
      <i class="red"><?php echo form_error('col_price') ?></i>
    </li>  
    <li>
      <label>&nbsp;</label>
      <input type="submit" class="btn" value="提交"/>
    </li>
  </ul>   
  
  <?php }else{    
   echo form_open(base_url('offering/create'),'post')?>
  <ul class="yun_bt">
     <li><a href="<?php echo base_url('cloud') ?>">新建云平台</a></li>
     <li><a href="<?php echo base_url('region') ?>">region</a></li>
     <li><a href="<?php echo base_url('zone') ?>">zone</a></li>
     <li><a href="<?php echo base_url('diskoffering') ?>">Diskoffering</a></li>
     <li class="dq"><a href="<?php echo base_url('offering') ?>">Offering</a></li>
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
      <label>offering名称</label>
      <input name="col_name" type="text" class="dfinput" value="<?php echo set_value('col_name') ?>"/>
      <i class="red"><?php echo form_error('col_name') ?></i>
    </li>  
    <li>
      <label>cpu核数</label>
      <input name="col_cpunumber" type="radio" value="1" <?php echo set_radio('col_cpunumber', 1, TRUE); ?>>单核</input>
      <input name="col_cpunumber" type="radio" value="2" <?php echo set_radio('col_cpunumber', 2); ?>>双核</input>
      <input name="col_cpunumber" type="radio" value="3" <?php echo set_radio('col_cpunumber', 3); ?>>3核</input>
      <input name="col_cpunumber" type="radio" value="4" <?php echo set_radio('col_cpunumber', 4); ?>>4核</input>
      <input name="col_cpunumber" type="radio" value="6" <?php echo set_radio('col_cpunumber', 6); ?>>6核</input>
      <input name="col_cpunumber" type="radio" value="8" <?php echo set_radio('col_cpunumber', 8); ?>>8核</input>
      <input name="col_cpunumber" type="radio" value="16" <?php echo set_radio('col_cpunumber', 16); ?>>16核</input>
      <i class="red"><?php echo form_error('col_cpunumber') ?></i>
    </li>  
    <li>
      <label>cpu速度</label>
      <input name="col_cpuspeed" type="text" class="dfinput" value="<?php echo set_value('col_cpuspeed') ?>"/>
      <i class="red"><?php echo form_error('col_cpuspeed') ?></i>
    </li>  
    <li>
      <label>内存大小</label>
      <input name="col_memory" type="radio" value="512" <?php echo set_radio('col_memory', 512, TRUE); ?>>512MB</input>
      <input name="col_memory" type="radio" value="1024" <?php echo set_radio('col_memory', 1024); ?>>1GB</input>
      <input name="col_memory" type="radio" value="2048" <?php echo set_radio('col_memory', 2048); ?>>2GB</input>
      <input name="col_memory" type="radio" value="4096" <?php echo set_radio('col_memory', 4096); ?>>4GB</input>
      <i class="red"><?php echo form_error('col_memory') ?></i>
    </li>  
    <li>
      <label>状态</label>
      <input name="col_status" type="radio" value="1" "<?php echo set_radio('col_status', 1, TRUE); ?>>正常</input>
      <input name="col_status" type="radio" value="2" <?php echo set_radio('col_status', 2); ?>>默认</input>
      <input name="col_status" type="radio" value="3" <?php echo set_radio('col_status', 3); ?>>推荐</input>
      <i class="red"><?php echo form_error('col_status') ?></i>
    </li>  
    <li>
      <label>价格(单位:元)</label>
      <input name="col_price" type="text" class="dfinput" value="<?php echo set_value('col_price') ?>"/>
      <i class="red"><?php echo form_error('col_price') ?></i>
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
