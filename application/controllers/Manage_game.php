<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_game extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','url'));
       $this->load->model('game_mdl');
 }
   /**
    * 添加游戏
    */
   public function create_game(){
       //$this->load->view('create_game');
       $config=$this->config->item('image_config');
       $this->load->library('upload',$config);
       if($this->form_validation->run('create_game')===false){
            $this->load->view('create_game');
       }else{
           if($this->upload->do_upload('pic')){
               $image=$this->upload->data();
               $data=array(
                   'col_name'=>$this->input->post('gamename'),
                   'col_alias'=>$this->input->post('name'),
                   'col_pinyin_jp'=>$this->input->post('pinyin_jp'),
                   'col_pinyin_qp'=>$this->input->post('pinyin_qp'),
                   'col_ttype'=>$this->input->post('ttype'),
                   'col_gtype'=>$this->input->post('gtype'),
                   'col_version'=>$this->input->post('version'),
                   'col_subversion'=>$this->input->post('subversion'),
                   'col_desc'=>$this->input->post('desc'),
                   'col_developer'=>$this->input->post('developer'),
                   'col_operator'=>$this->input->post('operator'),
                   'col_date'=>$this->input->post('date'),
                   'col_pic'=>$image['file_name']
               );
               if($this->game_mdl->create_game($data)){
                   $this->common->jump(base_url('manage_game/list_game'),'操作成功');
               }else{
                   $this->common->jump(base_url('manage_game/list_game'),'操作失败');
               }
               
           }else{
               $this->upload->display_errors();
               $this->load->view('create_game');
           }
       }
       
//        if($this->form_validation->run('create_user') === FALSE){
//            $data=array(
//                'col_nickname'=>$this->input->post('username'),
//                'col_name'=>$this->input->post('name'),
//                'col_sex'=>$this->input->post('sex'),
//                'col_mail'=>$this->input->post('mail'),
//                'col_call'=>$this->input->post('call'),
//                'col_qq'=>$this->input->post('qq'),
//                'col_role'=>$this->input->post('role'),
//                'col_passwd'=>sha1($this->input->post('passwd'))
//            );
//            $this->load->view('create_user',$this->_data);
//        }else{
//            $data=array(
//                'col_nickname'=>$this->input->post('username'),
//                'col_name'=>$this->input->post('name'),
//                'col_sex'=>$this->input->post('sex'),
//                'col_mail'=>$this->input->post('mail'),
//                'col_call'=>$this->input->post('call'),
//                'col_qq'=>$this->input->post('qq'),
//                'col_role'=>$this->input->post('role'),
//                'col_passwd'=>sha1($this->input->post('passwd'))
//            );
            
//            $this->load->model('user_mdl');
//            if($this->user_mdl->check_exist('col_nickname',$this->input->post('username'))){
//                $this->_data['post_info']='用户名已存在';
//                $this->load->view('create_user',$this->_data);
//            }else{
//                $this->user_mdl->create_user($data);
//                $this->_data['post_info']='用户创建成功';
//                $this->load->view('create_user',$this->_data);
//            }
            
//        }
      
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