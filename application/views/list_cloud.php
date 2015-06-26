<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script type="text/javascript">

function handle(col_cloud_id,col_cloud_name){
	window.opener.document.getElementsByName("col_cloud_name")[0].value = col_cloud_name;
	window.opener.document.getElementsByName("col_cloud_id")[0].value = col_cloud_id;
	window.close();
}

function deleteOne(url,url1){
	$(".tip").fadeIn(200);
	$(".sure").click(function(){
	  $(".tip").fadeOut(100);
	  $.ajax({
          //提交数据的类型 POST GET
          type:"POST",
          //提交的网址
          url:url,
          //提交的数据
          data:{},
          //返回数据的格式
          datatype: "json",//"xml", "html", "script", "html", "jsonp", "text".
          //在请求之前调用的函数
          beforeSend:function(){

	        },
          //成功返回之后调用的函数             
          success:function(data){
//               alert(typeof(data));
        	  $(".tipbtn").empty();
        	  $(".tipright > p").html(data.message);
        	  $(".tip").fadeIn(500);
        	  $(".tip").fadeOut(1000,function(){
        		  window.location = url1;
      		  });             
          },
          //调用执行后调用的函数
          complete: function(XMLHttpRequest, textStatus){
             
          },
          //调用出错执行的函数
          error: function(){
              
          }         
       });
	});
	$(".cancel").click(function(){
	  $(".tip").fadeOut(100);
	});
	  }
</script>
</head>

<body>
<div class="place">
  <span>
  位置：
  </span>
  <ul class="placeul">
    <li>
      <a href="#">
      首页
      </a>
    </li>
    <li>
      <a href="#">
      运维管理
      </a>
    </li>
    <li>
      <a href="#">
  配置云平台信息
      </a>
    </li>
    <li>
      <a>
  cloud
      </a>
    </li>
  </ul>
</div>
<div class="formbody">
  <div class="formtitle"> <span> 云平台列表 </span> </div>
  <?php if($flagopen === 1){ ?>
  <ul class="yun_bt">
     <li class="dq"><a href="<?php echo base_url('cloud/list_page/1') ?>">云平台信息列表</a></li>
     <li><a href="<?php echo base_url('region/list_page/1') ?>">region列表</a></li>
     <li><a href="<?php echo base_url('zone/list_page/1') ?>">zone列表</a></li>
     <li><a href="<?php echo base_url('diskoffering/list_page/1') ?>">Diskoffering列表</a></li>
     <li><a href="<?php echo base_url('offering/list_page/1') ?>">Offering列表</a></li>
     <li><a href="<?php echo base_url('ostype/list_page/1') ?>">Ostype系统列表</a></li>
     <li><a href="<?php echo base_url('template/list_page/1') ?>">配置模板信息列表</a></li>
     <li><a href="<?php echo base_url('gateway/list_page/1') ?>">网关列表</a></li>
  </ul>
   <table class="tablelist">
    <thead>
      <tr>
        <th width="60">序号<i class="sort"><img src="<?php echo base_url('images/px.gif') ?>" /></i></th>
        <th>云平台名称</th>
        <th>云平台IP</th>
        <th>云平台接口地址</th>
        <th>联系人</th>
        <th>创建日期</th>
        <th>验证日期</th>
        <th>验证状态</th>
        <th>状态</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(isset($results)&&is_array($results)){
    foreach ($results as $key => $value){ ?>
    <tr>
        <td><?php echo $key+1 ?></td>
        <td><?php echo $value['col_name']?></td>
        <td><?php echo $value['col_ip']?></td>
        <td><?php echo $value['col_url']?></td>
        <td><?php echo $value['col_contactname']?></td>
        <td><?php echo $value['col_datetime']?></td>
        <td><?php echo ($value['col_check_date']===NULL ? '/':$value['col_check_date']) ?></td>
        <td><?php if ($value['status'] == 0){
            echo '未验证';
        }elseif ($value['status'] ==1){
            echo '验证成功';   
        }else{
            echo '验证失败';
        }
        ?></td>
        <td><?php echo ($value['col_valid']==='Y' ? '有效':'无效') ?></td>
        <td>
        <?php if ($value['status'] == 0){ ?>
        <a href="#" class="tablelink" onclick="">
          验证
          </a>
        <?php }elseif ($value['status'] ==2){ ?>
        <a href="#" class="tablelink" onclick="">
          重新验证
          </a>      
        <?php } ?>
          &nbsp;&nbsp;&nbsp;
          <a href="<?php echo base_url('cloud/select/'.$value['col_id'].'/'.$currPage) ?>" class="tablelink">
          修改
          </a>
          <?php if ($value['col_valid'] == 'Y'){ ?>
          &nbsp;&nbsp;&nbsp;
          <a href="javascript:void(0)" class="tablelink" onclick="deleteOne('<?php echo base_url('cloud/delete/'.$value['col_id'].'/'.$currPage) ?>','<?php echo base_url('cloud/list_page/1/'.$currPage) ?>')" >
          删除
          </a>
          <?php } ?>
        </td>
    </tr>
<?php }}else{ ?>
    <tr align="center">
        <td colspan="10">暂时没有记录，请先<a href="<?php echo base_url('cloud') ?>" target="rightFrame">新建云信息</a></td>
    </tr>
<?php }?>
    </tbody>
  </table>     
  <?php  }else{ ?>
  <ul class="yun_bt">
     <li class="dq"><a href="<?php echo base_url('cloud/list_page/2') ?>">云平台信息列表</a></li>
  </ul>
  <table class="tablelist">
    <thead>
      <tr>
        <th width="60">序号<i class="sort"><img src="<?php echo base_url('images/px.gif') ?>" /></i></th>
        <th>云平台名称</th>
        <th>云平台IP</th>
        <th>云平台接口地址</th>
        <th>联系人</th>
        <th>创建日期</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(isset($results)&&is_array($results)){
    foreach ($results as $key => $value){ ?>
    <tr>
        <td><?php echo $key+1 ?></td>
        <td><?php echo $value['col_name']?></td>
        <td><?php echo $value['col_ip']?></td>
        <td><?php echo $value['col_url']?></td>
        <td><?php echo $value['col_contactname']?></td>
        <td><?php echo $value['col_datetime']?></td>
        <td><input type="button" value="确定" class="btn" onclick="handle(<?php echo $value['col_id']?>,'<?php echo $value['col_name']?>')"/></td>
    </tr>
<?php }}else{ ?>
    <tr align="center">
        <td colspan="7">暂时没有记录，请先<a href="<?php echo base_url('cloud') ?>" target="rightFrame"">新建云信息</a></td>
    </tr>
<?php }?>
    </tbody>
  </table>
  <?php }?>

  <div class="pagin">
    <div class="message">共<i class="blue"><?php echo $resultTotal ?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $currPage?>&nbsp;</i>页  
    <ul class='paginList'>
    <?php echo $link;?> 
    </ul>
    </div>
  </div>
  <div class="tip">
    <div class="tiptop">
      <span>
      提示信息
      </span>
      <a>
      </a>
    </div>
    <div class="tipinfo">
      <span>
      <img src="<?php echo base_url('images/ticon.png') ?>" />
      </span>
      <div class="tipright">
        <p>是否确认对信息的删除 ？</p>
      </div>
    </div>
    <div class="tipbtn">
      <input name="" type="button"  class="sure" value="确定" />
      &nbsp;
      <input name="" type="button"  class="cancel" value="取消" />
    </div>
  </div>
</div>
<script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>
</html>
