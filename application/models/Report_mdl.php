<?php

class Report_mdl extends CI_Model
{

    //月工单数

    const month_tickets = "select MONTH(col_time) mon,count(col_id) count ,
        (select count(col_status) from ticket where MONTH(col_time)=mon and col_status='Y') county ,
        (select count(col_status) from ticket where MONTH(col_time)=mon and col_status='N') countn
        from ticket where YEAR(col_time)=YEAR(NOW()) group by MONTH(col_time)";
    
    //周工单数
    const week_tickets = "select WEEK(col_time) mon,count(col_id) count ,
        (select count(col_status) from ticket where WEEK(col_time)=mon and col_status='Y') county ,
        (select count(col_status) from ticket where WEEK(col_time)=mon and col_status='N') countn
        from ticket where YEAR(col_time)=YEAR(NOW()) group by WEEK(col_time)";
    
    //最近一周工单
    const recent_week_tickets = "select WEEKDAY(col_time)+1 mon,count(col_id) count ,
        (select count(col_status) from ticket where WEEKDAY(col_time)=mon-1 and col_status='Y') county ,
        (select count(col_status) from ticket where WEEKDAY(col_time)=mon-1 and col_status='N') countn
         from ticket where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(col_time) and col_time<now() group by WEEKDAY(col_time) order by col_time";
    
    //最近一月工单
    const recent_month_tickets = "select DAYOFMONTH(col_time) mon,count(col_id) count ,
        (select count(col_status) from ticket where DAYOFMONTH(col_time)=mon and col_status='Y') county ,
        (select count(col_status) from ticket where DAYOFMONTH(col_time)=mon and col_status='N') countn
        from ticket where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(col_time) and col_time<now() group by DAYOFMONTH(col_time)  order by col_time";
   
    //工单总量
    const tickets = 'select count(col_id) count from ticket where YEAR(col_time)=YEAR(NOW())';
    
    //已处理工单数
    const handle_tickets = "select count(col_id) count from ticket where YEAR(col_time)=YEAR(NOW()) and col_status='Y'";
    
    //未处理工单数
    const no_handle_tickets = "select count(col_id) count from ticket where YEAR(col_time)=YEAR(NOW()) and col_status='N'";
    
    //周内新增工单数
    const week_increase_tickets = 'select count(col_id) count from ticket where WEEK(col_time)=WEEK(NOW())';
    
    //日平均处理量
    const avg_tickets = "select count(col_id)/max(datediff(NOW(),col_time)) avg from ticket where YEAR(col_time)=YEAR(NOW()) and col_status='Y'";
    
    //平均完成率
    
    //top工单脚本排行
    const tickets_top = 'select k.game_name,k.script_name,count(k.col_id) count from (select e.col_name game_name,d.col_name script_name,g.col_id,g.col_time
        from vm a,script_template c,game_script d,game e,user f,ticket g 
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id and d.col_game_id=e.col_id and a.col_user_id=f.col_id and f.col_id=g.col_user_id
        and YEAR(g.col_time)=YEAR(NOW()) group by game_name,script_name) k group by k.game_name,k.script_name order by count(k.col_id) desc limit 10';
    
    //月虚拟机使用数
    const month_vms = 'select MONTH(col_begin) mon,count(col_id) count from vm where YEAR(col_begin)=YEAR(NOW()) and col_end is not null group by MONTH(col_begin)';
    
    //周虚拟机使用数
    const week_vms = 'select WEEK(col_begin) mon,count(col_id) count from vm where YEAR(col_begin)=YEAR(NOW()) and col_end is not null group by WEEK(col_begin)';
    
    //最近一周虚拟机使用数
    const recent_week_vms = 'select WEEKDAY(col_begin)+1 mon,count(col_id) count from vm where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(col_begin) and col_end is not null group by WEEKDAY(col_begin) order by col_begin';
    
    //最近一月虚拟机使用数
    const recent_month_vms = 'select DAYOFMONTH(col_begin) mon,count(col_id) count from vm where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(col_begin) and col_end is not null group by DAYOFMONTH(col_begin) order by col_begin';
    
    //虚拟机总数
    const vms = "select count(col_id) count from vm where YEAR(col_begin)=YEAR(NOW()) and col_status_code not in('Destroyed','Expunging')";
    
    //虚拟机使用量
    const use_vms = "select count(col_id) count from vm where YEAR(col_begin)=YEAR(NOW()) and col_end is not null and col_status_code not in('Destroyed','Expunging')";
    
    //虚拟机闲置量
    const no_used_vms = "select count(col_id) count from vm where YEAR(col_begin)=YEAR(NOW()) and col_end is null and col_status_code in('Active','Inactive','Shutdowned','Stopped','Stopping','PowerOff','Migrating')";
    
    //虚拟机故障量
    const error_vms = "select count(col_id) count from vm where YEAR(col_begin)=YEAR(NOW()) and col_status_code in('Error','Unknown','PowerReportMissing','PowerUnknown')";
    
    //top虚拟机使用时间最长排行
    const vms_top = 'select col_vm_id,datediff(col_end,col_begin) dd
        from (select col_vm_id,col_begin,col_end from vm where YEAR(col_begin)=YEAR(NOW()) and col_end is not null group by col_vm_id) k group by k.col_vm_id order by datediff(col_end,col_begin) desc limit 10';

    //月使用脚本数、
    const month_scripts = "select MONTH(col_date) mon,count(script_name) count
        from(select a.col_user_id,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2
        group by script_name) k
        group by MONTH(col_date) order by MONTH(col_date)";
    
    //周脚本使用数
    const week_scripts = "select WEEK(col_date) mon,count(script_name) count
        from(select a.col_user_id,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2
        group by script_name) k
        group by WEEK(col_date) order by WEEK(col_date)";
    
    //最近一周脚本使用数
    const recent_week_scripts = "select WEEKDAY(col_date)+1 mon,count(script_name) count
        from(select a.col_user_id,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2
        group by script_name) k
        where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(col_date)
        group by WEEKDAY(col_date) order by col_date";
    
    //最近一月脚本使用数
    const recent_month_scripts = "select DAYOFMONTH(col_date)+1 mon,count(script_name) count
        from(select a.col_user_id,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2
        group by script_name) k
        where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(col_date)
        group by DAYOFMONTH(col_date) order by col_date";
    
    //脚本总量
    const scripts = "select count(col_id) count from game_script where YEAR(col_date)=YEAR(NOW())";
    
    //已使用的脚本数
    const use_scripts = "select count(script_name) count
        from(select a.col_user_id,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2
        group by script_name) k";
    
    //审核未通过的脚本数
    const no_pass_scripts = "select count(script_name) count
        from(select a.col_user_id,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid!='Y' or d.col_check!=1 or d.col_status!=2
        group by script_name) k";
    
    //热门脚本使用数
    const hot_scripts = "select count(script_name) count
        from(select a.col_user_id,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2 and d.col_hot='Y'
        group by script_name) k";
    
    //热门脚本排行
    const scripts_top = "select game_name,script_name,count(script_name) count
        from(select a.col_user_id,e.col_name game_name,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d,game e
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id and d.col_game_id=e.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2 and d.col_hot='Y'
        group by game_name,script_name) k
        order by count(script_name) desc limit 10";
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //月用户
    
    const month_user = "select MONTH(col_datetime) mon,count(col_id) count 
        
        
        from user where YEAR(col_datetime)=YEAR(NOW()) and (col_role='user' or col_role='author') group by MONTH(col_datetime)";
    
//     //周用户
    const week_user = "select WEEK(col_datetime) mon,count(col_id) count 
        
        
        from user where YEAR(col_datetime)=YEAR(NOW()) and (col_role='user' or col_role='author') group by WEEK(col_datetime)";
    
//     //最近一周用户
    const recent_week_user = "select WEEKDAY(col_datetime)+1 mon,count(col_id) count 
        
        
         from user where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(col_datetime) and (col_role='user' or col_role='author') and col_datetime<now() group by WEEKDAY(col_datetime) order by col_datetime";
    
//     //最近一月用户
    const recent_month_user = "select DAYOFMONTH(col_datetime) mon,count(col_id) count 
        
        
        from user where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(col_datetime) and (col_role='user' or col_role='author') and col_datetime<now() group by DAYOFMONTH(col_datetime) order by col_datetime";

    /**
     * 活跃用户前十
     * @var unknown
     */
    const user_top="select u.col_nickname as username,count(*) as num from user as u,login_log as ll where
         u.col_id= ll.col_user_id and(col_role='user' or col_role='author') group by ll.col_user_id order 
        by num desc limit 10";
    /**
     * 当前在线用户数
     * @var unknown
     */
    const online_now="select count(*) as num from ci_sessions where timestamp between (unix_timestamp(now())-900) and unix_timestamp(now())";
    /**
     * 当天上线用户数
     */
    const online_now_day="select count(distinct(col_user_id)) as num from login_log where to_days(now())=to_days(col_timestamp)";
    /**
     * 每天在线用户数
     * @var unknown
     */
    const online_day="select date(col_timestamp) as time, count(distinct(col_user_id)) as num from login_log group by date_format(col_timestamp,'%Y-%m-%d')";
    /**
     * 每个月的在线用户
     */
    const online_moth="select date_format(col_timestamp,'%Y%m') as time, count(distinct(col_user_id)) as num from login_log group by date_format(col_timestamp,'%Y%m')";
    /**
     * 每周在线用户数
     * @var unknown
     */
    const online_week="select date_format(col_timestamp,'%Y%u') as time, count(distinct(col_user_id)) as num from login_log group by date_format(col_timestamp,'%Y%u')";
    /**
     * 总用户数
     */
    const total_user='select count(*) as num from user where col_role="user" or col_role="author"';
    /**
     * 日新增用户数
     */
    const new_user_day="select date_format(col_datetime,'%Y-%m-%d') as mon, count(*) as count from user where col_role='user' or col_role='author' group by date_format(col_datetime,'%Y-%m-%d')";
    /**
     * 周新增用户数
     */
    const new_user_week="select date_format(col_datetime,'%Y-%u') as mon, count(*) as conut from user where col_role='user' or col_role='author' group by date_format(col_datetime,'%Y-%u')";
    /**
     * 月新增用户数
     */
    const new_user_moth="select date_format(col_datetime,'%Y-%u') as mon, count(*) as conut from user where col_role='user' or col_role='author' group by date_format(col_datetime,'%Y-%u')";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    /**
     * 
     */
    public function get_data($sql_name)
    {
        $mess = array();
        if($sql_name == 'month_tickets'){
            $query = $this->db->query(self::month_tickets);
        }else if($sql_name == 'week_tickets'){
            $query = $this->db->query(self::week_tickets);
        }else if($sql_name == 'recent_week_tickets'){
            $query = $this->db->query(self::recent_week_tickets);
        }else if($sql_name == 'recent_month_tickets'){
            $query = $this->db->query(self::recent_month_tickets);
        }else if($sql_name == 'tickets'){
            $query = $this->db->query(self::tickets);
        }else if($sql_name == 'handle_tickets'){
            $query = $this->db->query(self::handle_tickets);
        }else if($sql_name == 'no_handle_tickets'){
            $query = $this->db->query(self::no_handle_tickets);
        }else if($sql_name == 'week_increase_tickets'){
            $query = $this->db->query(self::week_increase_tickets);
        }else if($sql_name == 'avg_tickets'){
            $query = $this->db->query(self::avg_tickets);
        }else if($sql_name == 'tickets_top'){
            $query = $this->db->query(self::tickets_top);
        }else if($sql_name == 'month_vms'){
            $query = $this->db->query(self::month_vms);
        }else if($sql_name == 'week_vms'){
            $query = $this->db->query(self::week_vms);
        }else if($sql_name == 'recent_week_vms'){
            $query = $this->db->query(self::recent_week_vms);
        }else if($sql_name == 'recent_month_vms'){
            $query = $this->db->query(self::recent_month_vms);
        }else if($sql_name == 'vms'){
            $query = $this->db->query(self::vms);
        }else if($sql_name == 'use_vms'){
            $query = $this->db->query(self::use_vms);
        }else if($sql_name == 'no_used_vms'){
            $query = $this->db->query(self::no_used_vms);
        }else if($sql_name == 'error_vms'){
            $query = $this->db->query(self::error_vms);
        }else if($sql_name == 'vms_top'){
            $query = $this->db->query(self::vms_top);
        }else if($sql_name == 'month_scripts'){
            $query = $this->db->query(self::month_scripts);
        }else if($sql_name == 'week_scripts'){
            $query = $this->db->query(self::week_scripts);
        }else if($sql_name == 'recent_week_scripts'){
            $query = $this->db->query(self::recent_week_scripts);
        }else if($sql_name == 'recent_month_scripts'){
            $query = $this->db->query(self::recent_month_scripts);
        }else if($sql_name == 'scripts'){
            $query = $this->db->query(self::scripts);
        }else if($sql_name == 'use_scripts'){
            $query = $this->db->query(self::use_scripts);
        }else if($sql_name == 'no_pass_scripts'){
            $query = $this->db->query(self::no_pass_scripts);
        }else if($sql_name == 'hot_scripts'){
            $query = $this->db->query(self::hot_scripts);
        }else if($sql_name == 'script_top'){
            $query = $this->db->query(self::script_top);
        }else if($sql_name == 'user_top'){
            $query = $this->db->query(self::user_top);
        }else if($sql_name == 'online_now'){
            $query = $this->db->query(self::online_now);
        }else if($sql_name == 'online_now_day'){
            $query = $this->db->query(self::online_now_day);
        }else if($sql_name == 'online_day'){
            $query = $this->db->query(self::online_day);
        }else if($sql_name == 'online_moth'){
            $query = $this->db->query(self::online_moth);
        }else if($sql_name == 'online_week'){
            $query = $this->db->query(self::online_week);
        }else if($sql_name == 'total_user'){
            $query = $this->db->query(self::total_user);
        }else if($sql_name == 'new_user_day'){
            $query = $this->db->query(self::new_user_day);
        }else if($sql_name == 'new_user_week'){
            $query = $this->db->query(self::new_user_week);
        }else if($sql_name == 'new_user_moth'){
            $query = $this->db->query(self::new_user_moth);
        }else if($sql_name == 'month_user'){
            $query = $this->db->query(self::month_user);
        }else if($sql_name == 'week_user'){
            $query = $this->db->query(self::week_user);
        }else if($sql_name == 'recent_week_user'){
            $query = $this->db->query(self::recent_week_user);
        }else if($sql_name == 'recent_month_user'){
            $query = $this->db->query(self::recent_month_user);
        }elseif($sql_name=='scripts_top'){
            $query = $this->db->query(self::scripts_top);
        }
            
        if ($query) {
            log_message('debug', (string)$this->db->last_query());
            $mess['data'] = $query->result_array();
        } else {
            $mess['data'] = false;
        }
        return $mess['data'];
    }

    
}

