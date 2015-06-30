<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    
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
        $this->load->model('report_mdl');
        $this->load->library('common');
    }    

	
	public function index()
	{
	    if ($this->auth->hasLogin()) {
	        //工单总量
	        $this->_data['tickets']=$this->report_mdl->get_data('tickets');
	        //已处理工单量
	        $this->_data['handle_tickets']=$this->report_mdl->get_data('handle_tickets');
	        //未处理工单量
	        $this->_data['no_handle_tickets']=$this->report_mdl->get_data('no_handle_tickets');
            //周内新增工单量
	        $this->_data['week_increase_tickets']=$this->report_mdl->get_data('week_increase_tickets');
            //日平均处理量
	        $this->_data['avg_tickets']=$this->report_mdl->get_data('avg_tickets');
            //平均完成率
	        $this->_data['avg_complate']=(intval($this->_data['handle_tickets'][0]['count']))*100/(intval($this->_data['tickets'][0]['count'])).'%';
	        
	        //虚拟机总数
	        $this->_data['vms']=$this->report_mdl->get_data('vms');
	        //虚拟机使用量
	        $this->_data['use_vms']=$this->report_mdl->get_data('use_vms');
	        //虚拟机闲置量
	        $this->_data['no_used_vms']=$this->report_mdl->get_data('no_used_vms');
	        //虚拟机故障率：
	        $this->_data['error_vms']=$this->report_mdl->get_data('error_vms');
	        
	        //脚本总量
	        $this->_data['scripts']=$this->report_mdl->get_data('scripts');
	        //已使用脚本数
	        $this->_data['use_scripts']=$this->report_mdl->get_data('use_scripts');
	        //审核未通过的脚本数
	        $this->_data['no_pass_scripts']=$this->report_mdl->get_data('no_pass_scripts');
	        //热门脚本数
	        $this->_data['hot_scripts']=$this->report_mdl->get_data('hot_scripts');
	        //总用户数
	        $this->_data['total_user']=$this->report_mdl->get_data('total_user');
	        //当日上线用户
	        $this->_data['online_now_day']=$this->report_mdl->get_data('online_now_day');
		    $this->load->view('report_index',$this->_data);
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	
	public function report_ticket()
	{
	    if ($this->auth->hasLogin()) {
	        
	        $serch=$this->input->post('col_name', TRUE);
	        if(empty($serch)){
	            $serch='1';
	        }
	        //工单总量
	        $this->_data['tickets']=$this->report_mdl->get_data('tickets');
	        //已处理工单量
	        $this->_data['handle_tickets']=$this->report_mdl->get_data('handle_tickets');
	        //未处理工单量
	        $this->_data['no_handle_tickets']=$this->report_mdl->get_data('no_handle_tickets');
	        //周内新增工单量
	        $this->_data['week_increase_tickets']=$this->report_mdl->get_data('week_increase_tickets');
	        //日平均处理量
	        $this->_data['avg_tickets']=$this->report_mdl->get_data('avg_tickets');
	        //平均完成率
	        $this->_data['avg_complate']=(intval($this->_data['handle_tickets'][0]['count']))*100/(intval($this->_data['tickets'][0]['count'])).'%';
	         
	        if($serch =='1'){
	            $month_ticket=$this->report_mdl->get_data('month_tickets');
	        }
	        //top工单脚本排行
	        $this->_data['tickets_top']=$this->report_mdl->get_data('tickets_top');
	        
	        $this->_data['serch']=$serch;
	        $this->load->view('report_ticket',$this->_data);
	    }else{
	        $this->information=$this->config->item('user_login_tips');
	        $this->_data['error_string'] = $this->information['nologin_sessionout'];
	        $this->load->view('login',$this->_data);
	    }
	}
	
	public function handleMonth($array){
	    
	}
	public function report_user(){
	    //总用户数
	    $this->_data['total_user']=$this->report_mdl->get_data('total_user');
	    //当日上线用户
	    $this->_data['online_now_day']=$this->report_mdl->get_data('online_now_day');
	    //当前在线
	    $this->_data['online_now']=$this->report_mdl->get_data('online_now');
	    $this->_data['user_top']=$this->report_mdl->get_data('user_top');
	    $this->load->view('report_user',$this->_data);
	}
	
}
