<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_template extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','url'));
   }
   private $_data;

   /**
    * 查看某个模板
    */
   public function view_template(){
       $template_id=$this->uri->segment(3);
       if(is_numeric($template_id)){
           $this->load->model('template_mdl');
           $template=$this->template_mdl->get_template_by_id($template_id);
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
        
   }
   /**
    * 根据条件列出模板
    */
   public function list_template(){
       
   }
}