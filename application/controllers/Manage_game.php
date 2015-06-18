<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_game extends CI_Controller {
   public function __construct(){
       parent::__construct();
       $this->load->library(array('session','form_validation','common','auth'));
       $this->load->helper(array('form','url'));
       
       if(!$this->auth->hasLogin()){
           redirect(base_url('login'));
       }
       $this->load->model('game_mdl');
       $this->_userinfo=$this->session->userdata('user_info');
       $this->_data['check']=$this->config->item('check_res');
 }
   /**
    * 添加游戏
    */
   private $_data;
   private $_userinfo;
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
       
      
   }
   /**
    * 查看某个游戏
    */
   public function view_game(){
       $game_id=$this->uri->segment(3);
       if(is_numeric($game_id)){
           $this->load->model('game_mdl');
           $game=$this->game_mdl->get_game_by_id($game_id);
           if($game){
               $this->_data['game']=$game['0'];
               $this->load->view('view_game',$this->_data);
           }else{
               show_404();
           }
       }else{
           show_404();
       }
   }
    /**
     * 删除游戏     注:删除游戏为将游戏置为无效
     */
   public function delete_game(){
       if($this->uri->segment(3)){
           $this->_data['game_id']=$this->uri->segment(3);
           $this->load->model('game_mdl');
           if($this->game_mdl->update_game($this->_data['game_id'],array('col_valid'=>'N'))){
               $this->common->jump(base_url('manage_game/list_game'),'删除成功');
           }else{
               $this->common->jump(base_url('manage_game/list_game'),'删除失败');
           }
            
       }else{
           show_404();
       }
   }
   /**
    * 修改游戏信息
    */
   public function update_game(){
       if($this->uri->segment(3)){
           $this->_data['game_id']=$this->uri->segment(3);
           $this->load->model('game_mdl');
           $game=$this->game_mdl->get_game_by_id($this->uri->segment(3));
            
           if($game){
               $this->_data['game']=$game[0];
               $this->load->view('update_game',$this->_data);
           }else{
               $this->common->jump(base_url('manage_game/list_game'),'找不到该游戏');
           }
       }else{
           $game_id=$this->input->post('game_id');
           $this->_data['game_id']=$game_id;
           if($game_id){
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
                   'col_date'=>$this->input->post('date')
               );
               if($this->game_mdl->update_game($game_id,$data)){
                   $this->common->jump(base_url('manage_game/list_game'),'修改成功');
               }else{
                   $this->common->jump(base_url('manage_game/list_game'),'修改失败,重新修改');
               }
           }else{
               show_404();
           }
            
       }
   }
   /**
    * 根据条件列出游戏
    */
   public function list_game(){
       $limit_arr=$this->config->item('limit');
       $limit=$limit_arr['game_list'];
       $offset=!empty($this->uri->segment(3))?$this->uri->segment(3):0;
       $this->load->model('game_mdl');
       $where=array(
           'col_valid'=>'Y'
       );
       $url=base_url('manage_game/list_game');
       $total=$this->game_mdl->get_game_num($where);
       $this->_data['total']=$total;
       $this->_data['link']=$this->common->page_config($total,$limit,$url);
       $this->_data['game_list']=$this->game_mdl->list_game($where,$limit,$offset);
       $this->load->view('list_game',$this->_data);
   }
   public function fuzzy_query(){
       
   }
}