<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud extends CI_Controller {
    
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
        $this->load->model('cloud_web_mdl');
        $this->load->library('common');
    }    

	
	public function index()
	{
	    if ($this->auth->hasLogin()) {
		   $this->load->view('cloud');
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	//cloud/select/id/currPage
	public function select(){
	    if ($this->auth->hasLogin()) {
	        $this->_data = array(
	            'col_id' => intval($this->uri->segment(3))
	        );
	        $this->_data['results'] = $this->cloud_web_mdl->list_cloud($this->_data);
	        $this->_data['currPage'] = intval($this->uri->segment(4));
	        $this->load->view('cloud',$this->_data);
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	public function update(){
	    if ($this->auth->hasLogin()) {
	        if ($this->form_validation->run('cloud') === FALSE) {
	            $this->load->view('cloud');
	        }else {
	            $this->_data = array(
	                'col_name' => $this->input->post('col_name', TRUE),
	                'col_ip' => $this->input->post('col_ip', TRUE),
	                'col_port' => $this->input->post('col_port', TRUE),
	                'col_url' => $this->input->post('col_url', TRUE),
	                'col_apikey' => $this->input->post('col_apikey', TRUE),
	                'col_seckey' => $this->input->post('col_seckey', TRUE),
	                'col_desc' => $this->input->post('col_desc', TRUE),
	                'col_contactname' => $this->input->post('col_contactname', TRUE),
	                'col_contactcall' => $this->input->post('col_contactcall', TRUE)
	            );
	            $this->information=$this->config->item('cloud_tips');
	            $mess = $this->cloud_web_mdl->update_cloud($this->input->post('col_id', TRUE),$this->_data);
	            if($mess){
	                $this->_data['message'] = $this->information['update_cloud_success'];
	            }else{
	                $this->_data['message'] = $this->information['update_cloud_error'];
	            }
	            $this->_data['currPage'] = base_url('cloud/list_page/1').'/'.($this->input->post('currPage', TRUE));
	            $this->load->view('jump',$this->_data);
	        }
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	//本方法是将记录置为无效
	public function delete(){
	    if ($this->auth->hasLogin()) {
	        $this->information=$this->config->item('cloud_tips');
	        if($this->uri->segment(3) === NULL){
	            $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode(array(
	                'message' => $this->information['uri_error'],
	                'flag' => 'error'
	            )));
	        }else{
    	        $this->_data = array(
    	            'col_valid' => 'N'
    	        );
    	        $mess = $this->cloud_web_mdl->update_cloud($this->uri->segment(3),$this->_data);
    	        if($mess){
    	            $this->output
    	            ->set_content_type('application/json')
    	            ->set_output(json_encode(array(
    	                'message' => $this->information['delete_cloud_success'],
    	                'flag' => 'success'
    	            )));
    	        }else{
    	            $this->output
    	            ->set_content_type('application/json')
    	            ->set_output(json_encode(array(
    	                'message' => $this->information['delete_cloud_error'],
    	                'flag' => 'error'
    	            )));
    	        }
	        }
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	public function create(){
	    if ($this->auth->hasLogin()) {
	        if ($this->form_validation->run('cloud') === FALSE) {
	            $this->load->view('cloud');
	        }else {
	            $this->_data = array(
	                'col_name' => $this->input->post('col_name', TRUE),
	                'col_ip' => $this->input->post('col_ip', TRUE),
	                'col_port' => $this->input->post('col_port', TRUE),
	                'col_url' => $this->input->post('col_url', TRUE),
	                'col_apikey' => $this->input->post('col_apikey', TRUE),
	                'col_seckey' => $this->input->post('col_seckey', TRUE),
	                'col_desc' => $this->input->post('col_desc', TRUE),
	                'col_contactname' => $this->input->post('col_contactname', TRUE),
	                'col_contactcall' => $this->input->post('col_contactcall', TRUE)
	            );
	            $this->information=$this->config->item('cloud_tips');
	            $mess = $this->cloud_web_mdl->create_cloud($this->_data);
	            if($mess){
	                $this->_data['message'] = $this->information['create_cloud_success'];
	            }else{
	                $this->_data['message'] = $this->information['create_cloud_error'];
	            }
	            $this->_data['currPage'] = base_url('cloud');
	            $this->load->view('jump',$this->_data);
	        }
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	    
	}
	//cloud/list_page/?/currPage/条件(?=1是直接显示列表，2是弹出框列表)
	public function list_page(){
	    if ($this->auth->hasLogin()) {
	        $this->_data['resultTotal'] = $this->cloud_web_mdl->list_cloud_result();
	        $this->_data['perpage'] = 1;
            if(($this->_data['resultTotal'])%($this->_data['perpage']) === 0){
                $this->_data['pages'] = ($this->_data['resultTotal'])/($this->_data['perpage']);
            }else{
                $this->_data['pages'] = ($this->_data['resultTotal'])/($this->_data['perpage']) + 1;
            }
	        if($this->uri->segment(4) === NULL){
	            $this->_data['currPage'] = 1;
	        }else{
	            $this->_data['currPage'] = intval($this->uri->segment(4));
	        }
            $this->_data['results'] = $this->cloud_web_mdl->list_cloud_con(($this->_data['currPage']-1)*$this->_data['perpage'],$this->_data['perpage']);
            $this->_data['link'] = $this->common->page_config($this->_data['resultTotal'],$this->_data['perpage'],base_url('cloud/list_page/'.$this->uri->segment(3)));
	        $this->_data['flagopen'] = intval($this->uri->segment(3));
            $this->load->view('list_cloud',$this->_data);
	        
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
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
