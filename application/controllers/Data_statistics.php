<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_statistics extends CI_Controller
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
}
