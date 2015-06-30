<?php
/**
 * 判断访问是否合法
 */
defined('BASEPATH') or exit('No direct script access allowed');


class Test extends CI_Controller
{

  public function index(){
     $this->load->database();
     $query=$this->db->query('select count(*) as num from ci_sessions where timestamp between (unix_timestamp(now())-900) and unix_timestamp(now())');
     print_r($query->result_array());
     //$query1=$this->db->query('');
     //当前天 select date(col_timestamp) as time, count(distinct(col_user_id)) as num from login_log where to_days(now())=to_days(col_timestamp);
    
  }
  
}
