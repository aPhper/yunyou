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
     'select count(distinct(col_user_id)) as num from login_log where to_days(now())=to_days(col_timestamp)';
     //当前在线
     'select count(*) as num from ci_sessions where timestamp between (unix_timestamp(now())-900) and unix_timestamp(now())';
     //每个周的在线
     "select date_format(col_timestamp,'%Y%u') as time, count(distinct(col_user_id)) as num from login_log group by date_format(col_timestamp,'%Y%u')";
     //每一天的在线数
     'select date(col_timestamp) as time, count(distinct(col_user_id)) as num from login_log group by date_format(col_timestamp,"%Y-%m-%d")';
     //每个月的在线数
     "select date_format(col_timestamp,'%Y%m') as time, count(distinct(col_user_id)) as num from login_log group by date_format(col_timestamp,'%Y%m');";
     //总用户量
     'select count(*) from user where col_role="user" or col_role="author"';
     //日新增用户量
     //select date_format(col_datetime,'%Y-%m-%d') as time, count(*) as num from user where col_role='user' or col_role='author' group by date_format(col_datetime,'$Y-%m-%d');
     //周新增用户后量
     //select date_format(col_datetime,'%Y-%u') as time, count(*) as num from user where col_role='user' or col_role='author' group by date_format(col_datetime,'$Y-%u');
     //月新增用户量 
     //select date_format(col_datetime,'%Y-%m') as time, count(*) as num from user where col_role='user' or col_role='author' group by date_format(col_datetime,'$Y-%m');
     //用户活跃排名前十
     //select u.col_nickname as username,count(*) as num from user as u,login_log as ll where u.col_id= ll.col_user_id and(col_role='user' or col_role='author') group by ll.col_user_id order by num desc limit 10;
  }
  
}
