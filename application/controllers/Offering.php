<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offering extends CI_Controller {
    
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
        $this->load->model('offering_mdl');
        $this->load->library('common');
    }    

	
	public function index()
	{
	    if ($this->auth->hasLogin()) {
	       $this->_data = $this->session->userdata('user_info');
		   $this->load->view('offering');
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	//offering/select/id/currPage
	public function select(){
	    if ($this->auth->hasLogin()) {
	        $this->_data = array(
	            'col_id' => intval($this->uri->segment(3))
	        );
	        $offeringrecord = $this->_data['results'] = $this->offering_mdl->list_offering($this->_data);
	        $this->_data['currPage'] = intval($this->uri->segment(4));
	        $this->load->model('cloud_web_mdl');
	        $cloudrecord = $this->cloud_web_mdl->list_cloud(array(
	            'col_id' => $offeringrecord[0]['col_cloud_id']
	        ));
	        $this->_data['col_cloud_name'] = $cloudrecord[0]['col_name'];
	        $this->load->view('offering',$this->_data);
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	

	public function update(){
	    if ($this->auth->hasLogin()) {
	        if ($this->form_validation->run('offering') === FALSE) {
	            $this->load->view('offering');
	        }else {
	            $this->_data = array(
	                'col_name' => $this->input->post('col_name', TRUE),
	                'col_cloud_id' => intval($this->input->post('col_cloud_id', TRUE)),
	                'col_offering_id' => $this->input->post('col_offering_id', TRUE),
	                'col_cpunumber' => intval($this->input->post('col_cpunumber', TRUE)),
	                'col_cpuspeed' => intval($this->input->post('col_cpuspeed', TRUE)),
	                'col_memory' => intval($this->input->post('col_memory', TRUE)),
	                'col_status' => intval($this->input->post('col_status', TRUE)),
	                'col_price' => intval($this->input->post('col_price', TRUE))
	            );
	            $this->information=$this->config->item('offering_tips');
	            $mess = $this->offering_mdl->update_offering($this->input->post('col_id', TRUE),$this->_data);
	            if($mess){
	                $this->_data['message'] = $this->information['update_offering_success'];
	            }else{
	                $this->_data['message'] = $this->information['update_offering_error'];
	            }
	            $this->_data['currPage'] = base_url('offering/list_page/1').'/'.($this->input->post('currPage', TRUE));
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
	        $this->information=$this->config->item('offering_tips');
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
	            $mess = $this->offering_mdl->update_offering($this->uri->segment(3),$this->_data);
	            if($mess){
	                $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(array(
	                    'message' => $this->information['delete_offering_success'],
	                    'flag' => 'success'
	                )));
	            }else{
	                $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(array(
	                    'message' => $this->information['delete_offering_error'],
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
	        if ($this->form_validation->run('offering') === FALSE) {
	            $this->load->view('offering');
	        }else {
	            $this->_data = array(
	                'col_name' => $this->input->post('col_name', TRUE),
	                'col_cloud_id' => intval($this->input->post('col_cloud_id', TRUE)),
	                'col_cpunumber' => intval($this->input->post('col_cpunumber', TRUE)),
	                'col_cpuspeed' => intval($this->input->post('col_cpuspeed', TRUE)),
	                'col_memory' => intval($this->input->post('col_memory', TRUE)),
	                'col_status' => intval($this->input->post('col_status', TRUE)),
	                'col_price' => intval($this->input->post('col_price', TRUE))
	            );
	            $this->load->library('common');
	            $this->_data['col_offering_id'] = $this->common->guid();
	            $this->information=$this->config->item('offering_tips');
	            $mess = $this->offering_mdl->create_offering($this->_data);
	            if($mess){
	                $this->_data['message'] = $this->information['create_offering_success'];
	            }else{
	                $this->_data['message'] = $this->information['create_offering_error'];
	            }
	            $this->_data['currPage'] = base_url('offering');
	            $this->load->view('jump',$this->_data);
	        }
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	    
	}
	
	//offering/list_page/?/currPage/条件(?=1是直接显示列表，2是弹出框列表)
	public function list_page(){
	    if ($this->auth->hasLogin()) {
	        $this->_data['resultTotal'] = $this->offering_mdl->list_offering_result();
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
            $this->_data['results'] = $this->offering_mdl->list_offering_con(($this->_data['currPage']-1)*$this->_data['perpage'],$this->_data['perpage']);
            $this->_data['link'] = $this->common->page_config($this->_data['resultTotal'],$this->_data['perpage'],base_url('offering/list_page/'.$this->uri->segment(3)));
            $this->_data['flagopen'] = intval($this->uri->segment(3));
	        $this->load->view('list_offering',$this->_data);

	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
}
