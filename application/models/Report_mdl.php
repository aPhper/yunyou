<?php

class Report_mdl extends CI_Model
{

    //月工单数
    const month_tickets = 'select MONTH(col_time) mon,count(col_id) count from ticket where YEAR(col_time)=YEAR(NOW()) group by MONTH(col_time)';
    
    //周工单数
    const week_tickets = 'select WEEK(col_time) wee,count(col_id) count from ticket where YEAR(col_time)=YEAR(NOW()) group by WEEK(col_time)';
    
    //最近一周工单
    const recent_week_tickets = 'select WEEKDAY(col_time)+1 wee,count(col_id) count from ticket where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(col_time) group by WEEKDAY(col_time) order by col_time';
    
    //最近一月工单
    const recent_month_tickets = 'select DAYOFMONTH(col_time) dd,count(col_id) count from ticket where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(col_time) group by DAYOFMONTH(col_time) order by col_time';
    
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
    const week_vms = 'select WEEK(col_begin) wee,count(col_id) count from vm where YEAR(col_begin)=YEAR(NOW()) and col_end is not null group by WEEK(col_begin)';
    
    //最近一周虚拟机使用数
    const recent_week_vms = 'select WEEKDAY(col_begin)+1 wee,count(col_id) count from vm where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(col_begin) and col_end is not null group by WEEKDAY(col_begin) order by col_begin';
    
    //最近一月虚拟机使用数
    const recent_month_vms = 'select DAYOFMONTH(col_begin) dd,count(col_id) count from vm where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(col_begin) and col_end is not null group by DAYOFMONTH(col_begin) order by col_begin';
    
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
        group by MONTH(col_date) order by MONTH(col_date";
    
    //周脚本使用数
    const week_scripts = "select WEEK(col_date) wee,count(script_name) count
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
    const script_top = "select game_name,script_name,count(script_name) count
        from(select a.col_user_id,e.col_name game_name,d.col_name script_name,d.col_date
        from vm a,script_template c,game_script d,game e
        where a.col_template_id=c.col_template and c.col_script_id=d.col_id and d.col_game_id=e.col_id
        and YEAR(d.col_date)=YEAR(NOW()) and a.col_end is not null 
        and d.col_valid='Y' and d.col_check=1 and d.col_status=2 and d.col_hot='Y'
        group by game_name,script_name) k
        order by count(script_name) desc limit 10";
    
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

