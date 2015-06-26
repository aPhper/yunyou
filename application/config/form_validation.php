<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*************************************************************************************************************************
 *****************************************************表单规则配置***********************************************************
 ************************************************************************************************************************/
$config=array(
    'user_login'=>array(
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'trim|required|min_length[5]|max_length[16]|alpha_dash'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|min_length[6]|max_length[32]'
        )
    ),
    'user_register'=>array(
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'trim|required|min_length[5]|max_length[16]|alpha_dash'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|min_length[6]|max_length[32]'
        ),
        array(
            'field' => 'passwd',
            'label' => '确认密码',
            'rules' => 'trim|required|min_length[6]|max_length[32]'
        )
    ),
    'author_register'=>array(
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'trim|required|min_length[5]|max_length[16]|alpha_dash'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|min_length[6]|max_length[32]|matches[passwd]'
        ),
        array(
            'field' => 'passwd',
            'label' => '确认密码',
            'rules' => 'trim|required|min_length[6]|max_length[32]'
        ),
        array(
            'field' => 'email',
            'label' => '邮箱',
            'rules' => 'trim|required|min_length[6]|max_length[64]|valid_email'
        )    
    ),
    'resetpasswd'=>array(
        array(
            'field' => 'oldpasswd',
            'label' => '旧密码',
            'rules' => 'trim|required|min_length[5]|max_length[32]'
        ),
        array(
            'field' => 'newpasswd',
            'label' => '新密码',
            'rules' => 'trim|required|min_length[5]|max_length[32]|matches[passwdconf]|callback_newpasswd_check'
        ),
        array(
            'field' => 'passwdconf',
            'label' => '确认密码',
            'rules' => 'trim|required|min_length[5]|max_length[32]'
        )
    ),
    'script_desc'=>array(
        array(
            'field' => 'game_id',
            'label' => '游戏类型',
            'rules' => 'trim|required|integer'
        ),
        array(
            'field' => 'script_name',
            'label' => '脚本名称',
            'rules' => 'trim|required|min_length[6]|max_length[64]'
        ),
        array(
            'field' => 'script_desc',
            'label' => '脚本描述',
            'rules' => 'trim|required'
        )
        
    ),
    'cloud'=>array(
        array(
            'field' => 'col_name',
            'label' => '云平台名称',
            'rules' => 'trim|required|max_length[64]'
        ),
        array(
            'field' => 'col_ip',
            'label' => '云平台IP',
            'rules' => 'trim|required|valid_ip'
        ),
        array(
            'field' => 'col_port',
            'label' => '端口号',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'col_url',
            'label' => '云平台接口地址',
            'rules' => 'trim|required|prep_url'
        ),
        array(
            'field' => 'col_apikey',
            'label' => 'Apikey',
            'rules' => 'trim|required|alpha_dash'
        ),
        array(
            'field' => 'col_seckey',
            'label' => 'Seckey',
            'rules' => 'trim|required|alpha_dash'
        ),
        array(
            'field' => 'col_desc',
            'label' => '描述',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_contactname',
            'label' => '联系人',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_contactcall',
            'label' => '联系电话',
            'rules' => 'trim|required|alpha_dash'
        )
    ),
    'region'=>array(
        array(
            'field' => 'col_name',
            'label' => 'region名称',
            'rules' => 'trim|required|min_length[6]|max_length[64]'
        ),
        array(
            'field' => 'col_cloud_name',
            'label' => '云平台名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_desc',
            'label' => 'region描述',
            'rules' => 'trim|required'
        )
    ),
    'zone'=>array(
        array(
            'field' => 'col_name',
            'label' => 'zone名称',
            'rules' => 'trim|required|max_length[64]'
        ),
        array(
            'field' => 'col_region_name',
            'label' => 'region名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_desc',
            'label' => 'zone描述',
            'rules' => 'trim|required'
        )
    ),
    'diskoffering'=>array(
        array(
            'field' => 'col_cloud_name',
            'label' => '云平台名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_name',
            'label' => '磁盘名称',
            'rules' => 'trim|required|max_length[64]'
        ),
        array(
            'field' => 'col_size',
            'label' => '磁盘容积',
            'rules' => 'trim|required|is_natural_no_zero'
        )
    ),
    'offering'=>array(
        array(
            'field' => 'col_cloud_name',
            'label' => '云平台名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_name',
            'label' => 'offering名称',
            'rules' => 'trim|required|max_length[50]'
        ),
        array(
            'field' => 'col_cpunumber',
            'label' => 'cpu核数',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'col_cpuspeed',
            'label' => 'cpu速度',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'col_memory',
            'label' => '内存大小',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'col_status',
            'label' => '状态',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_price',
            'label' => '价格',
            'rules' => 'trim|required|is_natural_no_zero'
        )
    ),
    'ostype'=>array(
        array(
            'field' => 'col_cloud_name',
            'label' => '云平台名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_name',
            'label' => '系统全程',
            'rules' => 'trim|required|max_length[50]'
        )
    ),
    'template'=>array(
        array(
            'field' => 'col_zone_name',
            'label' => 'zone名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_ostype_name',
            'label' => 'ostype名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_offering_name',
            'label' => 'offering名称',
            'rules' => 'trim|required'
        )
    ),
    'gateway'=>array(
        array(
            'field' => 'col_zone_name',
            'label' => 'zone名称',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_ip',
            'label' => '网关IP',
            'rules' => 'trim|required|prep_url'
        ),
        array(
            'field' => 'col_port',
            'label' => '端口号',
            'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
            'field' => 'col_url',
            'label' => '网关地址',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'col_user',
            'label' => '用户名',
            'rules' => 'trim|required|max_length[50]|alpha_dash'
        ),
        array(
            'field' => 'col_passwd',
            'label' => '密码',
            'rules' => 'trim|required|min_length[6]|max_length[50]|matches[col_passwd_conf]'
        ),
        array(
            'field' => 'col_passwd_conf',
            'label' => '确认密码',
            'rules' => 'trim|required|min_length[6]|max_length[50]'
        )
    ),
    

    'create_user'=>array(
        array(
            'field' => 'name',
            'label' => '姓名',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'username',
            'label' => '用户名',
            'rules' => 'trim|required|min_length[5]|max_length[16]|alpha_dash'
        ),
        array(
            'field' => 'mail',
            'label' => '邮箱',
            'rules' => 'trim|required|min_length[6]|max_length[64]|valid_email'
        ),
        array(
            'field' => 'sex',
            'label' => '性别',
            'rules' => 'trim'
        ),
        array(
            'field' => 'call',
            'label' => '电话',
            'rules' => 'trim|numeric|exact_length[11]'
        ),
        array(
            'field' => 'qq',
            'label' => 'QQ',
            'rules' => 'trim|numeric'
        ),
         array(
            'field' => 'passwd',
            'label' => '密码',
            'rules' => 'trim|required|min_length[5]|max_length[32]'
        )
        
    ),
    'create_game'=>array(
        array(
            'field' => 'gamename',
            'label' => '游戏名',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'name',
            'label' => '游戏别名',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'pinyin_jp',
            'label' => '简拼',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'pinyin_qp',
            'label' => '全拼',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'ttype',
            'label' => '游戏类型',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'gtype',
            'label' => '游戏种类',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'version',
            'label' => '游戏版本',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'subversion',
            'label' => '游戏子版本',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'desc',
            'label' => '游戏简介',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'developer',
            'label' => '开发商',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'operator',
            'label' => '运营商',
            'rules' => 'trim|required|'
        ),
        array(
            'field' => 'date',
            'label' => '上线时间',
            'rules' => 'trim|required|'
        ) 
        
    )
    
);























