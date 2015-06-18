<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_template extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','url'));
       if(!$this->auth->hasLogin()){
           redirect(base_url('login'));
       }
       $this->_userinfo=$this->session->userdata('user_info');
       $this->_data['check']=$this->config->item('check_res');
   }
   private $_data;
   private $_userinfo;
   /**
    * 查看某个模板
    */
   public function view_template(){
       $template_id=$this->uri->segment(3);
       if(is_numeric($template_id)){
           $this->load->model('view_template_mdl');
           $template=$this->view_template_mdl->list_template(array('ct.col_id'=>$template_id));
           if($template){
               $this->_data['template']=$template['0'];
               $this->load->view('view_template',$this->_data);
           }else{
               show_404();
           }
       }else{
           show_404();
       }
   }
    /**
     * 删除模板     注:删除模板为将模板置为无效
     */
   public function delete_template(){
       if($this->uri->segment(3)){
           $this->_data['template_id']=$this->uri->segment(3);
           $this->load->model('template_mdl');
           if($this->template_mdl->update_template($this->_data['template_id'],array('col_valid'=>'N'))){
               $this->common->jump(base_url('manage_template/list_template'),'删除成功');
           }else{
               $this->common->jump(base_url('manage_template/list_template'),'删除失败');
           }
            
       }else{
           show_404();
       }
   }
   /**
    * 根据条件列出模板
    */
   public function list_template(){
      
      $limit_arr=$this->config->item('limit');
      $limit=$limit_arr['template_list'];
      $offset=!empty($this->uri->segment(3))?$this->uri->segment(3):0;
      $where=array(
          'ct.col_valid'=>'Y'
      );
      $this->load->model('view_template_mdl');
      $url=base_url('manage_template/list_template');
      $total=$this->view_template_mdl->get_template_num($where);
      $this->_data['total']=$total;
      $this->_data['link']=$this->common->page_config($total,$limit,$url);
      $this->_data['template_list']=$this->view_template_mdl->list_template($where,$limit,$offset);
      $this->load->view('list_template',$this->_data);
   }
   public function check_template(){
       $template_id=$this->uri->segment(3);
       if($template_id){
           $this->load->model('view_template_mdl');
           $template=$this->view_template_mdl->list_template(array('ct.col_id'=>$template_id));
           $this->_data['template']=$template['0'];
           $this->_check_vm($template_id, $this->_userinfo['col_id']);
           $this->load->view('check_template',$this->_data);
       }else{
           show_404();
       }   
   }
   public function vm_create(){
       $this->load->model('cloud_mdl');
       if(is_numeric($this->uri->segment(3))){
               $res=$this->cloud_mdl->vm_create($this->uri->segment(3),$this->_userinfo['col_id']);
               if($res){
                   $this->common->jump(base_url('manage_template/check_template/'.$this->uri->segment(3)),'正在启动中');
               }else{
                   $this->common->jump(base_url('manage_template/check_template/'.$this->uri->segment(3)),'操作失败');
               }
       }else{
           show_404();
       }
   }
   private function _check_vm($template_id,$user_id){
       $this->load->model('vm_mdl');
       $vm=$this->vm_mdl->list_vm(array('col_user_id'=>$user_id,'col_template_id'=>$template_id));     
       if(empty($vm)){
           
           return false;
       }else{
           $this->_data['vm']=$vm[0];
           if($this->_data['vm']['col_status_code']=='Running'&&empty($this->_data['vm']['col_connection_id'])){
               $gate_res=$this->cloud_mdl->set_gateway($this->_data['vm']['vm_id']);
           }elseif(!empty($this->_data['vm']['col_connection_id'])){
               $this->_data['vm']['url']=$this->vm_mdl->get_vm_url($this->_data['vm']['col_id']);
           }
           return $this->_data['vm'];
       }
   }
  
}