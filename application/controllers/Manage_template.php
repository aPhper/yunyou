<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_template extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','uri'));
   }
   /**
    * 添加模板
    */
   public function create_template(){
       
   }
   /**
    * 查看某个模板
    */
   public function view_template(){
       
   }
    /**
     * 删除模板     注:删除模板为将模板置为无效
     */
   public function delete_template(){

   }
   /**
    * 修改模板信息
    */
   public function update_template(){
       
   }
   /**
    * 根据条件列出模板
    */
   public function list_template(){
       
   }
}