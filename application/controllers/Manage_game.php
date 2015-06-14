<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_game extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','uri'));
   }
   /**
    * 添加游戏
    */
   public function create_game(){
       
   }
   /**
    * 查看某个游戏
    */
   public function view_game(){
       
   }
    /**
     * 删除游戏     注:删除游戏为将游戏置为无效
     */
   public function delete_game(){

   }
   /**
    * 修改游戏信息
    */
   public function update_game(){
       
   }
   /**
    * 根据条件列出游戏
    */
   public function list_game(){
       
   }
}