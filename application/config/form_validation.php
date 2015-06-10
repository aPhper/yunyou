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
        
    )
    
);























