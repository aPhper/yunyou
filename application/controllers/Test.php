<?php
/**
 * 判断访问是否合法
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * *用户登录与登出
 *
 * @param            
 *
 *
 *
 * @return return_type
 * @author gaoxu
 *         @date 2015-4-17下午3:29:24
 * @version v1.0.0
 *         
 */
class Test extends CI_Controller
{

  public function index(){
      $this->load->database();
      $this->db->select('*');
      $this->db->where('col_role !=','user');
      $this->db->where('col_role !=','author');
      $query=$this->db->get('user');
      echo $this->db->last_query();
  }
}
