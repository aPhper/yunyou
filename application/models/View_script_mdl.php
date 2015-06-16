<?php
if (! defined ( 'BASEPATH' ))
    exit ( 'No direct script access allowed' );
/**
 * 完成脚本模板游戏用户直接关联查询
 * @author gaoxu
 *
 */
class View_script_mdl extends CI_Model {
    public function __construct(){
        parent::__construct ();
        $this->load->database ();
        log_message('info', 'view_script_mdl class initialized');
    }
    /**
     * 查script，template，user，game对应的列表
     * @param string $limit 条数
     * @param string $offset 偏移量
     * @param array $where 筛选条件
     * @param string $order_by_type 排序方式 desc asc
     * @param string $order_by_title 排序字段
     * @return Ambigous <string, boolean, NULL>
     */
    public function list_script($where=array(),$limit='5',$offset='0',$order_by_type='desc',$order_by_title='gs.col_id') {
       $mess = array ();
       $this->db->select('ct.col_id as template_id,gs.col_id as script_id,gs.col_date,gs.col_status,gs.col_name as script_name,gs.col_desc as script_info,u.col_nickname,u.col_qq,g.col_name as game_name,g.col_pic,g.col_gtype,(SELECT COUNT(*) FROM vm where col_template_id =st.col_template) as num');
	   $this->db->from(array('cloud_template ct','game g','script_template st','game_script gs','user u'));
	   $this->db->where('st.col_script_id','gs.col_id',FALSE);
	   $this->db->where('st.col_template','ct.col_id',FALSE);
	   $this->db->where('gs.col_game_id','g.col_id',FALSE);
	   $this->db->where('gs.col_author_id','u.col_id',FALSE);
	   if(is_array($where)&&!empty($where)){
	       foreach ($where as $key=>$value){
	           $this->db->where($key,$value);
	       }
	   }
	   $this->db->limit($limit,$offset);
	   $this->db->order_by($order_by_title,$order_by_type);
	   $query=$this->db->get();
	   if($query){
	       $mess ['return'] = $query->result_array();
	       $mess ['info'] = 'lsit_script is success';
	       $mess ['type'] = 'info';
	   }else{
	       $mess ['return'] = false;
	       $mess ['info'] = 'list_script query is error'.mysql_error();
	       $mess ['type'] = 'error';;
	   }
	   log_message ( $mess ['type'], $mess ['info'] );
	   return $mess ['return'];
    }
    /**
     * 脚本总条数
     * @return Ambigous <string, boolean, NULL>
     */
    public function get_script_num($where=array()){
        $mess = array ();
        $this->db->select('ct.col_id as template_id,gs.col_id as script_id,gs.col_name as script_name,gs.col_desc as script_info,u.col_nickname,u.col_qq,g.col_name as game_name,g.col_pic,g.col_gtype,(SELECT COUNT(*) FROM vm where col_template_id =st.col_template) as num');
        $this->db->from(array('cloud_template ct','game g','script_template st','game_script gs','user u'));
        $this->db->where('st.col_script_id','gs.col_id',FALSE);
        $this->db->where('st.col_template','ct.col_id',FALSE);
        $this->db->where('gs.col_game_id','g.col_id',FALSE);
        $this->db->where('gs.col_author_id','u.col_id',FALSE);
        if(is_array($where)&&!empty($where)){
            foreach ($where as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        
        $query=$this->db->get();
        if($query){
            $mess ['return'] = $query->num_rows();
            $mess ['info'] = 'get_script_num is success';
            $mess ['type'] = 'info';
        }else{
            $mess ['return'] = false;
            $mess ['info'] = 'get_script_num query is error'.mysql_error();
            $mess ['type'] = 'error';
        }
        log_message ( $mess ['type'], $mess ['info'] );
        return $mess ['return'];
    }
    /**
     * 获取vm上的脚本
     * @param unknown $where 筛选条件
     * @param string $limit 限制
     * @param string $offset 开始
     */
    public function list_vm_script($where=array(),$limit='5',$offset='0'){
        $mess=array();
        $this->db->select('vm.col_id as vm_id,vm.col_begin as start_time,gs.col_ishoutai,gs.col_isduokai,vs.col_name as vm_status,vs.col_code,vm.col_connection_id,gs.col_name as script_name,g.col_name as game_name,g.col_name as game_name,g.col_pic,g.col_gtype,(select col_nickname from user where col_id=gs.col_author_id) as author_name');
        $this->db->from(array('vm','script_template st','game_script gs','game g','vm_status vs'));
        $this->db->where('vm.col_template_id','st.col_template',FALSE);
        $this->db->where('st.col_script_id','gs.col_id',FALSE);
        $this->db->where('gs.col_game_id','g.col_id',FALSE);
        $this->db->where('vs.col_code','vm.col_status_code',FALSE);
        if(is_array($where)&&!empty($where)){
            foreach ($where as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->limit($limit,$offset);
        $query=$this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
}    