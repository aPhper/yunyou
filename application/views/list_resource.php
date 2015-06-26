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
$(document).ready(function(e) {
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>

<body>
<div class="place"> <span> 位置： </span>
  <ul class="placeul">
    <li> <a href="#"> 首页 </a> </li>
    <li> <a href="#"> 客服管理 </a> </li>
    <li> <a href="#"> 资源管理 </a> </li>
  </ul>
</div>
<div class="formbody">
  <div id="usual1" class="usual">
    <div id="tab1" class="tabson">
      <?php echo form_open(base_url('resource/list_page'),'post')?>
      <ul class="seachform">
        <li>
          <label>条件</label>
          <div class="vocation">
           <select name='key'  class="select3" >
                <option value='' <?php echo (empty($key) ? 'selected="selected"':'') ?>>全部</option>
                <option value='col_name' <?php echo ($key == 'col_name' ? 'selected="selected"':'') ?>>用户名</option>
                <option value='col_nickname' <?php echo ($key == 'col_nickname' ? 'selected="selected"':'') ?>>用户ID</option>
            </select>
          </div>
        </li>
        <li>
          <label>模糊搜索</label>
          <input name="serch" type="text" class="scinput" id='sid' value="<?php echo $serch ?>"/>
        </li>
        <li>
          <label>&nbsp;</label>
          <input type="submit" class="btn" value="查询"/>
        </li>
      </ul>
      <table class="tablelist">
        <thead>
          <tr>
            <th width="60">序号<i class="sort"><img src="<?php echo base_url('images/px.gif') ?>" /></i></th>
            <th>用户名称</th>
            <th>用户ID</th>
            <th>用户类型</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        <?php 
    if(isset($results)&&is_array($results)){
    foreach ($results as $key1 => $value){ ?>
          <tr>
            <td><?php echo $key1+1 ?></td>
            <td><?php echo ($key=='col_name'&&!empty($serch)) ? str_replace($serch,'<font color="red">'.$serch.'</font>', $value['col_name']):$value['col_name']?></td>
            <td><?php echo ($key=='col_nickname'&&!empty($serch)) ? str_replace($serch,'<font color="red">'.$serch.'</font>', $value['col_nickname']):$value['col_nickname']?></td>
            <td><?php echo ($value['col_role'] ==='user' ? '用户':'作者' )?></td>
            <td><?php echo ($value['col_valid'] ==='Y' ? '有效':'无效' )?></td>
            <td><a href="<?php echo base_url('resource/list_games/'.$value['col_id']) ?>" class="tablelink"> 查看信息 </a></td>
          </tr>
          <?php }}else{ ?>
    <tr align="center">
        <td colspan="6">暂时没有记录</td>
    </tr>
<?php }?>
        </tbody>
      </table>
      <div class="pagin">
          <div class="message">共<i class="blue"><?php echo $resultTotal ?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $currPage?>&nbsp;</i>页  
          <ul class='paginList'>
    <?php echo $link;?> 
    </ul>
      </div>
  </div>
    </div>
</div>
<script type="text/javascript">
    $("#usual1 ul").idTabs(); 
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>
</html>
