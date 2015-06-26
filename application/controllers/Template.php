<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {
    
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
        $this->load->model('template_mdl');
        $this->load->library('common');
    }    

	
	public function index()
	{
	    if ($this->auth->hasLogin()) {
	       $this->_data = $this->session->userdata('user_info');
		   $this->load->view('template');
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	//template/select/id/currPage
	public function select(){
	    if ($this->auth->hasLogin()) {
	        $this->_data = array(
	            'a.col_id' => intval($this->uri->segment(3))
	        );
	        $user = $this->session->userdata('user_info');
	        $this->_data['col_user_id'] = intval($user['col_id']);
	        $templaterecord = $this->_data['results'] = $this->template_mdl->list_template_con(0,1,$this->_data);
	        $this->_data['currPage'] = intval($this->uri->segment(4));
	        $this->load->view('template',$this->_data);
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	public function update(){
	    if ($this->auth->hasLogin()) {
	        if ($this->form_validation->run('template') === FALSE) {
	            $this->load->view('template');
	        }else {
	            $this->_data = array(
	                'col_zone_id' => intval($this->input->post('col_zone_id', TRUE)),
	                'col_ostype_id' => intval($this->input->post('col_ostype_id', TRUE))
	            );
	            $user = $this->session->userdata('user_info');
	            $this->_data['col_user_id'] = intval($user['col_id']);
	            $this->information=$this->config->item('template_tips');
	            $this->db->trans_begin();
	            $this->db->where('col_id', intval($this->input->post('col_id', TRUE)));
	            $this->db->update('cloud_template',$this->_data);
	            
	            $template_offering = array(
	                'col_offering_id' => intval($this->input->post('col_offering_id', TRUE))
	            );
	            $this->db->where('col_template_id', intval($this->input->post('col_id', TRUE)));
	            $this->db->update('template_offering_map',$template_offering);
	            if($this->db->trans_status() === false){
	                $this->db->trans_rollback();
	                $this->_data['message'] = $this->information['update_template_error'];
	            }else{
	                $this->db->trans_commit();
	                $this->_data['message'] = $this->information['update_template_success'];
	            }
	            $this->_data['currPage'] = base_url('template/list_page/1').'/'.($this->input->post('currPage', TRUE));
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
	        $this->information=$this->config->item('template_tips');
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
	            $mess = $this->template_mdl->update_template($this->uri->segment(3),$this->_data);
	            if($mess){
	                $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(array(
	                    'message' => $this->information['delete_template_success'],
	                    'flag' => 'success'
	                )));
	            }else{
	                $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode(array(
	                    'message' => $this->information['delete_template_error'],
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
	        if ($this->form_validation->run('template') === FALSE) {
	            $this->load->view('template');
	        }else {
	            $this->_data = array(
	                'col_zone_id' => intval($this->input->post('col_zone_id', TRUE)),
	                'col_ostype_id' => intval($this->input->post('col_ostype_id', TRUE))
	            );
	            $this->load->library('common');
	            $this->_data['col_template_id'] = $this->common->guid();
	            $user = $this->session->userdata('user_info');
	            $this->_data['col_user_id'] = intval($user['col_id']);
	            $this->information=$this->config->item('template_tips');
                $this->db->trans_begin();
                $this->db->insert('cloud_template',$this->_data);
                $template_offering = array(
                    'col_template_id' => $this->db->insert_id(),
                    'col_offering_id' => intval($this->input->post('col_offering_id', TRUE))
                );
                $this->db->insert('template_offering_map',$template_offering);
                if($this->db->trans_status() === false){
                    $this->db->trans_rollback();
                    $this->_data['message'] = $this->information['create_template_error'];
                }else{
                    $this->db->trans_commit();
                    $this->_data['message'] = $this->information['create_template_success'];
                }
                $this->_data['currPage'] = base_url('template');
	            $this->load->view('jump',$this->_data);
	        }
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	    
	}
	
	//template/list_page/?/currPage/条件(?=1是直接显示列表，2是弹出框列表)
	public function list_page(){
	    if ($this->auth->hasLogin()) {
	        $user = $this->session->userdata('user_info');
	        $this->_data['resultTotal'] = $this->template_mdl->list_template_result(array('col_user_id' => intval($user['col_id'])));
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
            $this->_data['results'] = $this->template_mdl->list_template_con(($this->_data['currPage']-1)*$this->_data['perpage'],$this->_data['perpage'],array('col_user_id' => intval($user['col_id'])));
            $this->_data['link'] = $this->common->page_config($this->_data['resultTotal'],$this->_data['perpage'],base_url('template/list_page/'.$this->uri->segment(3)));
            $this->_data['flagopen'] = intval($this->uri->segment(3));
            $this->load->view('list_template_dw',$this->_data);
	         
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
}
