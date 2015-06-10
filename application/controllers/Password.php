<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
    
    public $information;
    
    public $_data;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('form_validation');
        $this->load->library('auth');
        $this->load->library('session');
        $this->information=$this->config->item('user_login_tips');
    }    

	
	public function index()
	{
	    if ($this->auth->hasLogin()) {
	       $this->_data = $this->session->userdata('user_info');
		   $this->load->view('password',$this->_data);
	    }else{
	        $this->_data['error_string'] = $this->information['not_login'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	
	public function update(){
	    if ($this->form_validation->run('resetpasswd') === FALSE) {
	        $user = $this->session->userdata('user_info');
	        $this->_data['col_name'] = $user['col_name'];
	        $this->_data['col_id'] = $user['col_id'];
	        $this->load->view('password',$this->_data);
	    }else {
	        $flag = $this->user_mdl->resetpasswd($this->input->post('username', TRUE), $this->input->post('oldpasswd', TRUE), $this->input->post('newpasswd', TRUE));
	        if($flag){
	            $this->_data['message'] = $this->information['update_passwd_success'];
	            $this->load->view('jump',$this->_data);
	        }else{
	            $user = $this->session->userdata('user_info');
	            $this->_data['col_name'] = $user['col_name'];
	            $this->_data['col_id'] = $user['col_id'];
	            $this->_data['error_string'] = $this->information['password_error'];
	            $this->load->view('password',$this->_data);
	        }
	    }
	}
	
	public function newpasswd_check($str){
	    if($str === $this->input->post('oldpasswd', TRUE)){
	        $this->form_validation->set_message('newpasswd_check','%s不能和旧密码重复');
	        return FALSE;
	    }else{
	        return TRUE;
	    }
	}
	
}
