<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_list extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session','form_validation','common','auth'));
        $this->load->helper(array('form','url'));
        if(!$this->auth->hasLogin()){
            redirect(base_url('login'));
        }
        $this->_userinfo=$this->session->userdata('user_info');
        $this->_data['userinfo']=$this->_userinfo;
        $this->_data['check']=$this->config->item('check_res');
    }    

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    private $_data;
    private $_userinfo;
	public function index()
	{
		$this->load->library(array('common','session','auth'));
		if($this->auth->hasLogin()){
		    $user=$this->session->userdata('user_info');
		    
		    $left_url = $this->config->item('left_url');
		    $main_url = $this->config->item('main_url');
		    $this->_data['left_url']= $left_url[$user['col_role']];
		    $this->_data['main_url']= $main_url[$user['col_role']];
		    $this->load->view('main',$this->_data);
		}else{
		    
		}
	}
	public function left_yy(){
	    $this->load->view('left_yy');
	}
	public function left_yw(){
	    $this->load->view('left_yw');
	}
	public function left_kf(){
	    $this->load->view('left_kf');
	}
	public function top(){
	    $this->load->view('top',$this->_data);
	}
}
