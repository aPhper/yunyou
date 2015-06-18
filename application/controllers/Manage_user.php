<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_user extends CI_Controller
{

    /**
     * 传值到view数据
     * 
     * @var unknown
     */
    private $_data;

    private $_userinfo;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'form_validation',
            'common',
            'auth'
        ));
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->_data['user_info'] = $this->session->userdata();
        if (! $this->auth->hasLogin()) {
            redirect(base_url('login'));
        }
        $this->_userinfo = $this->session->userdata('user_info');
        $this->_data['check'] = $this->config->item('check_res');
        $this->_data['user_type'] = $this->config->item('user_type');
    }

    /**
     * 添加用户
     */
    public function create_user()
    {
        if ($this->form_validation->run('create_user') === FALSE) {
            $data = array(
                'col_nickname' => $this->input->post('username'),
                'col_name' => $this->input->post('name'),
                'col_sex' => $this->input->post('sex'),
                'col_mail' => $this->input->post('mail'),
                'col_call' => $this->input->post('call'),
                'col_qq' => $this->input->post('qq'),
                'col_role' => $this->input->post('role'),
                'col_passwd' => sha1($this->input->post('passwd'))
            );
            $this->load->view('create_user', $this->_data);
        } else {
            $data = array(
                'col_nickname' => $this->input->post('username'),
                'col_name' => $this->input->post('name'),
                'col_sex' => $this->input->post('sex'),
                'col_mail' => $this->input->post('mail'),
                'col_call' => $this->input->post('call'),
                'col_qq' => $this->input->post('qq'),
                'col_role' => $this->input->post('role'),
                'col_passwd' => sha1($this->input->post('passwd'))
            );
            
            $this->load->model('user_mdl');
            if ($this->user_mdl->check_exist('col_nickname', $this->input->post('username'))) {
                $this->_data['post_info'] = '用户名已存在';
                $this->load->view('create_user', $this->_data);
            } else {
                $this->user_mdl->create_user($data);
                $this->_data['post_info'] = '用户创建成功';
                $this->load->view('create_user', $this->_data);
            }
        }
    }

    /**
     * 查看某个用户
     */
    public function view_user()
    {
        $user_id = $this->uri->segment(3);
        if (is_numeric($user_id)) {
            $this->load->model('user_mdl');
            $this->_data['user'] = $this->user_mdl->get_user_by_id($user_id);
            if ($this->_data['user']) {
                $this->load->view('view_user', $this->_data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    /**
     * 删除用户 注:删除用户为将用户置为无效
     */
    public function delete_user()
    {
        if ($this->uri->segment(3)) {
            $this->_data['user_id'] = $this->uri->segment(3);
            $this->load->model('user_mdl');
            if ($this->user_mdl->update_user($this->_data['user_id'], array(
                'col_valid' => 'N'
            ))) {
                $this->common->jump(base_url('manage_user/list_user'), '删除成功');
            } else {
                $this->common->jump(base_url('manage_user/list_user'), '删除失败');
            }
        } else {
            show_404();
        }
    }

    /**
     * 修改用户信息
     */
    public function update_user()
    {
        if ($this->uri->segment(3)) {
            $this->_data['user_id'] = $this->uri->segment(3);
            $this->load->model('user_mdl');
            $user = $this->user_mdl->get_user_by_id($this->uri->segment(3));
            
            if ($user) {
                $this->_data['user'] = $user;
                $this->load->view('update_user', $this->_data);
            } else {
                $this->common->jump(base_url('manage_user/list_user'), '找不到该用户');
            }
        } else {
            $user_id = $this->input->post('user_id');
            $this->_data['user_id'] = $user_id;
            if ($user_id) {
                $data = array(
                    'col_nickname' => $this->input->post('username'),
                    'col_name' => $this->input->post('name'),
                    'col_sex' => $this->input->post('sex'),
                    'col_mail' => $this->input->post('mail'),
                    'col_call' => $this->input->post('call'),
                    'col_qq' => $this->input->post('qq'),
                    'col_role' => $this->input->post('role'),
                    'col_passwd' => $this->input->post('passwd')
                );
                if ($this->user_mdl->update_user($user_id, $data)) {
                    $this->common->jump(base_url('manage_user/list_user'), '修改成功');
                } else {
                    $this->common->jump(base_url('manage_user/list_user'), '修改失败,重新修改');
                }
            } else {
                show_404();
            }
        }
    }

    /**
     * 根据条件列出用户
     */
    public function list_user()
    {
        $limit_arr = $this->config->item('limit');
        $limit = $limit_arr['user_list'];
        $offset = ! empty($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->load->model('user_mdl');
        $where = array(
            'col_role !=' => 'author',
            'col_role  !=' => 'user'
        );
        $url = base_url('manage_user/list_user');
        
        $total = $this->user_mdl->get_user_num($where);
        $this->_data['total'] = $total;
        $this->_data['link'] = $this->common->page_config($total, $limit, $url);
        $this->_data['user_list'] = $this->user_mdl->get_user_list($where, $limit, $offset);
        $this->load->view('list_user', $this->_data);
    }
}