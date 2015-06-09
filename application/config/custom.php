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
    'login_type_error' => '身份验证错误',
    'not_login'=>'您还未登录,请先登录'
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
$config['farmer']=array(//安全检测配置
    'url'=>'192.168.1.112',
    'username'=>'admin',
    'passwd'=>'Admin@123'
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
    'tech'=>'left_yw',
    'admin'=>'left_yy',
    'cm'=>'left_kf'
);
$config['main_url']=array(
    'tech'=>'main_list/list_cloud',
    'admin'=>'main_list/list_user',
    'cm'=>'main_list/list_resource'
);

















