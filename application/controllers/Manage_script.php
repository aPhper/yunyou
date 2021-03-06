<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_script extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','url'));
       $this->load->model('game_script_mdl');
       if(!$this->auth->hasLogin()){
           redirect(base_url('login'));
       }
       $this->_userinfo=$this->session->userdata('user_info');
       $this->_data['check']=$this->config->item('check_res');
   }

   /**
    * 查看某个脚本
    */
   private $_data;
   private $_userinfo;
   public function view_script(){
       $script_id=$this->uri->segment(3);
       if(is_numeric($script_id)){
           $this->load->model('game_script_mdl');
           $script=$this->game_script_mdl->get_script_by_id($script_id);
           if($script){
               $this->_data['script']=$script['0'];
               $this->load->view('view_script',$this->_data);
           }else{
               show_404();
           }
       }else{
           show_404();
       }
   }
    /**
     * 删除脚本     注:删除脚本为将脚本置为无效
     */
   public function delete_script(){
       if($this->uri->segment(3)){
           $this->_data['script_id']=$this->uri->segment(3);
           $this->load->model('game_script_mdl');
           if($this->game_script_mdl->update_script($this->_data['script_id'],array('col_valid'=>'N'))){
               $this->common->jump(base_url('manage_script/list_script'),'删除成功');
           }else{
               $this->common->jump(base_url('manage_script/list_script'),'删除失败');
           }
       
       }else{
           show_404();
       }
   }
  
   /**
    * 根据条件列出脚本
    */
   public function list_script(){
       $limit_arr=$this->config->item('limit');
       $limit=$limit_arr['script_list'];
       $offset=!empty($this->uri->segment(3))?$this->uri->segment(3):0;
       $this->load->model('view_script_mdl');
       $where=array(
           'gs.col_valid'=>'Y'
       );
       $url=base_url('manage_script/list_script');
       $total=$this->view_script_mdl->get_all_script_num($where);
       $this->_data['total']=$total;
       $this->_data['link']=$this->common->page_config_gx($total,$limit,$url);
       $this->_data['script_list']=$this->view_script_mdl->list_all_script($where,$limit,$offset);
       $this->load->view('list_script',$this->_data);
}
   public function check_script(){
       if($this->uri->segment(3)&&$this->uri->segment(4)){
           $this->_data['script_id']=$this->uri->segment(3);
           $this->load->model('game_script_mdl');
           if($this->uri->segment(4)=='yes'){
               $res=1;
           }elseif($this->uri->segment(4)=='no'){
               $res=2;
           }else{
               $res=0;
           }
           if($this->game_script_mdl->update_script($this->_data['script_id'],array('col_check'=>$res))){
               $this->common->jump(base_url('manage_script/list_script'),'操作成功');
           }else{
               $this->common->jump(base_url('manage_script/list_script'),'操作失败');
           }
            
       }else{
           show_404();
       }
   }
}