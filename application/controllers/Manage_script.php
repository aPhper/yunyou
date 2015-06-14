<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_script extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','uri'));
   }
   /**
    * 添加脚本
    */
   public function create_script(){
       
   }
   /**
    * 查看某个脚本
    */
   public function view_script(){
       
   }
    /**
     * 删除脚本     注:删除脚本为将脚本置为无效
     */
   public function delete_script(){

   }
   /**
    * 修改脚本信息
    */
   public function update_script(){
       
   }
   /**
    * 根据条件列出脚本
    */
   public function list_script(){
       
   }
}