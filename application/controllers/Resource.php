<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resource extends CI_Controller {
    
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
        $this->load->model('game_script_mdl');
        $this->load->model('ticket_mdl');
        $this->load->library('common');
    }    

    public function list_tickets()
    {
        if ($this->auth->hasLogin()) {
            $this->_data['userid']=intval($this->uri->segment(3));
            $user = $this->user_mdl->get_user_by_id($this->_data['userid']);
            $this->_data['username']=$user['col_name'];
            $this->_data['userrole']=$user['col_role'];
            $this->_data['results'] = $this->ticket_mdl->list_ticket_dw(array('d.col_id'=> $this->_data['userid']));
            $this->load->view('list_tickets',$this->_data);
        }else{
            $this->information=$this->config->item('user_login_tips');
            $this->_data['error_string'] = $this->information['nologin_sessionout'];
            $this->load->view('login',$this->_data);
        }
    }
	
	public function list_games()
	{
	    if ($this->auth->hasLogin()) {
	        $this->_data['userid']=intval($this->uri->segment(3));
	        $user = $this->user_mdl->get_user_by_id($this->_data['userid']);
	        $this->_data['username']=$user['col_name'];
	        $this->_data['userrole']=$user['col_role'];
	        $this->_data['results'] = $this->game_script_mdl->list_script_con(array('f.col_id'=> $this->_data['userid']));
	        $this->load->view('list_games',$this->_data);
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	//resource/list_page/条件/currPage
	public function list_page(){
	    if ($this->auth->hasLogin()) {
	        $in_where = array('user','author');
	        $key=$this->input->post('key', TRUE);
	        $serch=$this->input->post('serch', TRUE);
	        $this->_data['perpage'] = 1;
	        
	        if($this->uri->segment(3) != null){
	            $key=$this->uri->segment(3);
	        }
	        
	        if($this->uri->segment(4) != null){
	            $serch=$this->uri->segment(4);
	        }
	        
	        if(!empty($serch)){
	            if($this->uri->segment(5) === NULL){
	                $this->_data['currPage'] = 1;
	            }else{
	                $this->_data['currPage'] = intval($this->uri->segment(5));
	            }
	            if(!empty($key)){
	                $where = array($key => $serch);
	                $this->_data['resultTotal'] = $this->user_mdl->list_user_result($in_where,$where);
	                $this->_data['results'] = $this->user_mdl->list_user_con($in_where,($this->_data['currPage']-1)*$this->_data['perpage'],$this->_data['perpage'],$where);
	                $this->_data['link'] = $this->common->page_config($this->_data['resultTotal'],$this->_data['perpage'],base_url('resource/list_page/'.$key.'/'.$serch),5);
	            }else{
	                $key='col_name';
	                $where = array($key => $serch);
	                $this->_data['resultTotal'] = $this->user_mdl->list_user_result($in_where,$where);
	                $this->_data['results'] = $this->user_mdl->list_user_con($in_where,($this->_data['currPage']-1)*$this->_data['perpage'],$this->_data['perpage'],$where);
	                $this->_data['link'] = $this->common->page_config($this->_data['resultTotal'],$this->_data['perpage'],base_url('resource/list_page/col_name/'.$serch),5);
	            }
	        }else{
	            if($this->uri->segment(3) === NULL){
	                $this->_data['currPage'] = 1;
	            }else{
	                $this->_data['currPage'] = intval($this->uri->segment(3));
	            }
	            $this->_data['resultTotal'] = $this->user_mdl->list_user_result($in_where);
	            $this->_data['results'] = $this->user_mdl->list_user_con($in_where,($this->_data['currPage']-1)*$this->_data['perpage'],$this->_data['perpage']);
	            $this->_data['link'] = $this->common->page_config($this->_data['resultTotal'],$this->_data['perpage'],base_url('resource/list_page'),3);
	        }
	        
            if(($this->_data['resultTotal'])%($this->_data['perpage']) === 0){
                $this->_data['pages'] = ($this->_data['resultTotal'])/($this->_data['perpage']);
            }else{
                $this->_data['pages'] = ($this->_data['resultTotal'])/($this->_data['perpage']) + 1;
            }
	        
	        $this->_data['serch'] = $serch;
	        $this->_data['key'] = $key;
            $this->load->view('list_resource',$this->_data);
	        
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
}
