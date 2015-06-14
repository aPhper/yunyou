<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_user extends CI_Controller {
   /**
    * 传值到view数据
    * @var unknown
    */
   private $_data;
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','url'));
       $this->_data['user_info']=$this->session->userdata();
   }
   /**
    * 添加用户
    */
   public function create_user(){
       if($this->form_validation->run('create_user') == FALSE){
           $this->load->view('create_user',$this->_data);
       }else{
           $this->load->view('create_user');
       }
   }
   /**
    * 查看某个用户
    */
   public function view_user(){
       $user_id=$this->uri->segment(3);
       if(is_numeric($user_id)){
           $this->load->model('user_mdl');
           $this->_data['user']=$this->user_mdl->get_user_by_id($user_id);
           if($this->_data['user']){
               $this->load->view('view_user',$this->_data);
           }else{
               show_404();
           }
       }else{
           show_404();
       }
   }
    /**
     * 删除用户     注:删除用户为将用户置为无效
     */
   public function delete_user(){
        
   }
   /**
    * 修改用户信息
    */
   public function update_user(){
       
   }
   /**
    * 根据条件列出用户
    */
   public function list_user(){
       $limit_arr=$this->config->item('limit');
       $limit=$limit_arr['user_list'];
       $offset=empty($this->uri->segment(3))?$this->uri->segment(3):0;
       $this->load->model('user_mdl');
       $where=array(
           'col_role !='=>'author', 
           'col_role  !='=>'user'
       );
       $url=base_url('manage_user/list_user');
       $total=$this->user_mdl->get_user_num($where);
       $this->_data['link']=$this->common->page_config($total,$limit,$url);
       $this->_data['user_list']=$this->user_mdl->get_user_list($where,$limit,$offset);
       $this->load->view('user_list',$this->_data);
       
   }
}