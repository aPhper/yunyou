<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gateway extends CI_Controller {
    
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
        $this->load->model('gateway_mdl');
        $this->load->library('common');
    }    

	
	public function index()
	{
	    if ($this->auth->hasLogin()) {
	       $this->_data = $this->session->userdata('user_info');
		   $this->load->view('gateway');
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	//gateway/select/id/currPage
	public function select(){
	    if ($this->auth->hasLogin()) {
	        $this->_data = array(
	            'col_id' => intval($this->uri->segment(3))
	        );
	        $gatewayrecord = $this->_data['results'] = $this->gateway_mdl->list_gateway($this->_data);
	        $this->_data['currPage'] = intval($this->uri->segment(4));
	        $this->load->model('zone_mdl');
	        $zonerecord = $this->zone_mdl->list_zone(array(
	            'col_id' => $gatewayrecord[0]['col_zone_id']
	        ));
	        $this->_data['col_zone_name'] = $zonerecord[0]['col_name'];
	        $this->load->view('gateway',$this->_data);
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	public function update(){
	    if ($this->auth->hasLogin()) {
	        if ($this->form_validation->run('gateway') === FALSE) {
	            $this->load->view('gateway');
	        }else {
	            $this->_data = array(
	                'col_ip' => $this->input->post('col_ip', TRUE),
	                'col_user' => $this->input->post('col_user', TRUE),
	                'col_passwd' => $this->input->post('col_passwd', TRUE),
	                'col_zone_id' => intval($this->input->post('col_zone_id', TRUE)),
	                'col_port' => intval($this->input->post('col_port', TRUE)),
	                'col_url' => $this->input->post('col_url', TRUE)
	            );
	            $this->information=$this->config->item('gateway_tips');
	            $mess = $this->gateway_mdl->update_gateway($this->input->post('col_id', TRUE),$this->_data);
	            if($mess){
	                $this->_data['message'] = $this->information['update_gateway_success'];
	            }else{
	                $this->_data['message'] = $this->information['update_gateway_error'];
	            }
	            $this->_data['currPage'] = base_url('gateway/list_page/1').'/'.($this->input->post('currPage', TRUE));
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
	        $this->information=$this->config->item('gateway_tips');
	        if($this->uri->segment(3) === NULL){
	            $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode(array(
	                'message' => $this->information['uri_error'],
	                'flag' => 'error'
	            )));
	        }else{
	            $this->_data = array(
	                'status' => 'N'
	            );
	            $mess = $this->gateway_mdl->update_gateway($this->uri->segment(3),$this->_data);
	            if($mess){
	                $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(array(
	                    'message' => $this->information['delete_gateway_success'],
	                    'flag' => 'success'
	                )));
	            }else{
	                $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(array(
	                    'message' => $this->information['delete_gateway_error'],
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
	        if ($this->form_validation->run('gateway') === FALSE) {
	            $this->load->view('gateway');
	        }else {
	            $this->_data = array(
	                'col_ip' => $this->input->post('col_ip', TRUE),
	                'col_user' => $this->input->post('col_user', TRUE),
	                'col_passwd' => $this->input->post('col_passwd', TRUE),
	                'col_zone_id' => intval($this->input->post('col_zone_id', TRUE)),
	                'col_port' => intval($this->input->post('col_port', TRUE)),
	                'col_url' => $this->input->post('col_url', TRUE)
	            );
	            $this->information=$this->config->item('gateway_tips');
	            $mess = $this->gateway_mdl->create_gateway($this->_data);
	            if($mess){
	                $this->_data['message'] = $this->information['create_gateway_success'];
	            }else{
	                $this->_data['message'] = $this->information['create_gateway_error'];
	            }
	            $this->_data['currPage'] = base_url('gateway');
	            $this->load->view('jump',$this->_data);
	        }
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	    
	}
	
	//gateway/list_page/?/currPage/条件(?=1是直接显示列表，2是弹出框列表)
	public function list_page(){
	    if ($this->auth->hasLogin()) {
	        $this->_data['resultTotal'] = $this->gateway_mdl->list_gateway_result();
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
            $this->_data['results'] = $this->gateway_mdl->list_gateway_con(($this->_data['currPage']-1)*$this->_data['perpage'],$this->_data['perpage']);
            $this->_data['link'] = $this->common->page_config($this->_data['resultTotal'],$this->_data['perpage'],base_url('gateway/list_page/'.$this->uri->segment(3)));
            $this->_data['flagopen'] = intval($this->uri->segment(3));
	        $this->load->view('list_gateway',$this->_data);
	         
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
}
