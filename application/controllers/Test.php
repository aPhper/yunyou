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
      $this->load->library('common');
     echo  $this->common->page_config(2,1,base_url('test'));
  }
}
