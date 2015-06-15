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
            'rules' => 'trim|required|min_length[6]|max_length[32]'
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























