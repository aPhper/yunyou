<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * ***********************************************************************************************************************
 * ***************************************************自定义配置项***********************************************************
 * ***********************************************************************************************************************
 */
$config['user_login_tips'] = array(//登录提示
    'logined' => '您已经登录',
    'login_error' => '用户名或密码错误',
    'login_type_error' => '用户角色错误',
    'not_login'=>'您还未登录,请先登录',
    'nologin_sessionout'=>'原因可能是您还未登录或页面停留太久',
    'password_error'=>'旧密码错误',
    'update_passwd_success'=>'密码修改成功'
);

$config['cloud_tips'] = array(
    'create_cloud_success' => '创建云平台信息成功',
    'create_cloud_error' => '创建云平台信息失败',
    'update_cloud_success' => '修改云平台信息成功',
    'update_cloud_error' => '修改云平台信息失败',
    'delete_cloud_success' => '删除云平台信息成功',
    'delete_cloud_error' => '删除云平台信息失败',
    'uri_error' => '无效的链接地址'
);
$config['region_tips'] = array(
    'create_region_success' => '创建Region信息成功',
    'create_region_error' => '创建Region信息失败',
    'update_region_success' => '修改Region信息成功',
    'update_region_error' => '修改Region信息失败',
    'delete_region_success' => '删除region信息成功',
    'delete_region_error' => '删除region信息失败',
    'uri_error' => '无效的链接地址'
);
$config['zone_tips'] = array(
    'create_zone_success' => '创建Zone信息成功',
    'create_zone_error' => '创建Zone信息失败',
    'update_zone_success' => '修改Zone信息成功',
    'update_zone_error' => '修改Zone信息失败',
    'delete_zone_success' => '删除Zone信息成功',
    'delete_zone_error' => '删除Zone信息失败',
    'uri_error' => '无效的链接地址'
);
$config['diskoffering_tips'] = array(
    'create_diskoffering_success' => '创建Diskoffering信息成功',
    'create_diskoffering_error' => '创建Diskoffering信息失败',
    'update_diskoffering_success' => '修改Diskoffering信息成功',
    'update_diskoffering_error' => '修改Diskoffering信息失败',
    'delete_diskoffering_success' => '删除Diskoffering信息成功',
    'delete_diskoffering_error' => '删除Diskoffering信息失败',
    'uri_error' => '无效的链接地址'
);
$config['offering_tips'] = array(
    'create_offering_success' => '创建Offering信息成功',
    'create_offering_error' => '创建Offering信息失败',
    'update_offering_success' => '修改Offering信息成功',
    'update_offering_error' => '修改Offering信息失败',
    'delete_offering_success' => '删除Offering信息成功',
    'delete_offering_error' => '删除Offering信息失败',
    'uri_error' => '无效的链接地址'
);
$config['ostype_tips'] = array(
    'create_ostype_success' => '创建Ostype信息成功',
    'create_ostype_error' => '创建Ostype信息失败',
    'update_ostype_success' => '修改Ostype信息成功',
    'update_ostype_error' => '修改Ostype信息失败',
    'delete_ostype_success' => '删除Ostype信息成功',
    'delete_ostype_error' => '删除Ostype信息失败',
    'uri_error' => '无效的链接地址'
);
$config['template_tips'] = array(
    'create_template_success' => '创建模板信息成功',
    'create_template_error' => '创建模板失败',
    'update_template_success' => '修改模板信息成功',
    'update_template_error' => '修改模板失败',
    'delete_template_success' => '删除模板信息成功',
    'delete_template_error' => '删除模板失败',
    'uri_error' => '无效的链接地址'
);
$config['gateway_tips'] = array(
    'create_gateway_success' => '创建网关信息成功',
    'create_gateway_error' => '创建网关失败',
    'update_gateway_success' => '修改网关信息成功',
    'update_gateway_error' => '修改网关失败',
    'delete_gateway_success' => '删除网关信息成功',
    'delete_gateway_error' => '删除网关失败',
    'uri_error' => '无效的链接地址'
);
$config['web_info'] = array(//网站信息
    'web_name'=>'大圣云游',
    'web_url'=>'www.dsyy.com'
);
$config['user_register_tips']=array(//注册提示
    'user_exist'=>'用户已经存在,换个名字试试',
    'register_success'=>'注册成功',
    'not_login'=>'您还未登录,请先登录',
    'register_error'=>'注册失败,稍后再试',
    'different_password'=>'两次密码不相同',
    'password_error'=>'密码错误',
    'resetpassword_success'=>'密码修改成功,请使用新密码登录'
);
$config['adog_url']='http://192.168.1.100:8089/resource/job';//adog地址
$config['guaca_url']='http://192.168.1.100:8080/guacamole/api/connections';//网关接口地址
$config['vm_console']=array(
    'no_vm'=>'你还没有脚本',
    'vm_starting'=>'正在启动中',
    'action_error'=>'操作失败'
);
$config['script_path']='../upload_file';//脚本上传web目录
$config['image_path']='../upload_image';//图片上传web目录
$config['ftp_username']='admin';//vm的ftp服务器用户名
$config['ftp_passwd']='Admin@123';//vm的ftp服务器密码
$config['script_config']=array(//脚本上传配置
    'upload_path'=>'../upload_file',
    'allowed_types'=>'zip|rar',
    'max_size'=>'20480',
    'max_filename'=>'1024',
    'encrypt_name'=>TRUE
);
$config['image_config'] = array(
    'upload_path' => '../upload_image',
    'allowed_types' => 'gif|jpg|png|jpeg',
    'max_size' => '2048',
    'max_filename' => '1024',
    'encrypt_name' => TRUE
);
$config['farmer'] = array( // 安全检测配置
    'url' => '192.168.1.112',
    'username' => 'admin',
    'passwd' => 'Admin@123'
);
$config['ostypeid']='09c1d526-fb86-11e4-a0f4-d6ed8d2c551f';//默认操作系统
$config['ostype_id']='914';
$config['farmer_data']=array(//farmer发送数据
    "resourceType"=>"script",
        "resourceId"=>"col_id",
        "action"=>"antivirus",
        "jobId"=>"file_name"
);
$config['left_url']=array(
    'tech'=>'main_list/left_yw',
    'admin'=>'main_list/left_yy',
    'cm'=>'main_list/left_kf'
);
$config['main_url'] = array(
    'tech' => 'cloud/list_page/1',
    'admin' => 'manage_user/list_user',
    'cm' => 'manage_ticket/list_ticket'
);
$config['limit'] = array(
    'user_list' => 2,
    'game_list' => 3,
    'script_list' => 3,
    'template_list' => 3,
    'ticket_list'=>3
);
$config['check_res'] = array(
    '0' => '未审核',
    '1' => '审核通过',
    '2' => '审核未通过'
);
$config['user_type']=array(
    'user' => '用户',
    'cm' => '客服',
    'tech' => '运维',
    'admin'=>'运营管理员',
    'author'=>'作者'
);

















