<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Ticket_comment_mdl extends CI_Model {
	const TABLE='ticket_comment';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	/**
	 * 工单的回复
	 * @param unknown $data
	 * @return Ambigous <string, boolean, NULL>
	 */
	public function create_ticket_comment($data = array())
	{
	    $mess = array();
	    if (empty($data)) {
	        $mess['info'] = 'create_ticket_comment $data is null';
	        $mess['type'] = 'info';
	        $mess['return'] = false;
	    } else {
	        $res = $this->db->insert(self::TABLE, $data);
	        if ($res) {
	            $mess['info'] = 'create_ticket_comment $data is null';
	            $mess['type'] = 'info';
	            $mess['return'] = $this->db->insert_id();
	        } else {
	            $mess['info'] = 'create_ticket_comment  is error' . mysql_error();
	            $mess['type'] = 'info';
	            $mess['return'] = false;
	        }
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	/**
	 * 列出回复的工单
	 * @param unknown $where
	 * @param number $limit
	 * @param number $offset
	 * @param string $order_by
	 * @return Ambigous <string, boolean, NULL>
	 */
	public function list_ticket_comment($where = array(), $limit = 100, $offset = 0, $order_by = 'col_id')
	{
	    $mess = array();
	    foreach ($where as $key => $value) {
	        $this->db->where($key, $value);
	    }
	    $this->db->limit(intval($limit), $offset);
	    $this->db->order_by($order_by);
	    $query = $this->db->get(self::TABLE);
	    if ($query) {
	        $mess['return'] = $query->result_array();
	        $mess['info'] = 'list ticket_comment is success';
	        $mess['type'] = 'info';
	    } else {
	        $mess['info'] = 'list ticket_comment query error' . mysql_error();
	        $mess['type'] = 'error';
	        $mess['return'] = false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	/**
	 * 
	 * @param unknown $col_id
	 * @return Ambigous <string, boolean, NULL>
	 */
	public function get_ticket_comment_by_id($col_id)
	{
	    $mess = array();
	    $query = $this->db->get_where(self::TABLE, array(
	        'col_id' => intval($col_id)
	    ));
	    if ($query) {
	        $mess['return'] = $query->result_array();
	        $mess['info'] = 'get_ticket_comment_by_id is success';
	        $mess['type'] = 'info';
	    } else {
	        $mess['info'] = 'get_ticket_comment_by_id' . mysql_error();
	        $mess['type'] = 'error';
	        $mess['return'] = false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	
	public function update_ticket_comment($col_id = '', $data = array())
	{
	    if (empty($data)) {
	        log_message('info', 'updata_ticket_comment  $data is null');
	        return false;
	    } else {
	        $query = $this->db->update(self::TABLE, $data, array(
	            'col_id' => intval($col_id)
	        ));
	        if ($query) {
	            log_message('debug', $this->db->last_query());
	            return $this->db->affected_rows();
	        } else {
	            log_message('error', 'update_ticket_comment query error' . mysql_error());
	            return false;
	        }
	    }
	}
	public function delete_ticket_comment($col_id)
	{
	    $this->db->delete(self::TABLE, array(
	        'col_id' => $col_id
	    ));
	    return $this->db->affected_rows();
	}
	public function get_ticket_comment_num($where=array()){
	    $mess = array();
	    foreach ($where as $key => $value) {
	        $this->db->where($key, $value);
	    }
	    $query = $this->db->get(self::TABLE);
	    if ($query) {
	        $mess['return'] = $query->num_rows();
	        $mess['info'] = 'get ticket_comment num is success';
	        $mess['type'] = 'info';
	    } else {
	        $mess['info'] = 'get ticket_comment num query error' . mysql_error();
	        $mess['type'] = 'error';
	        $mess['return'] = false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	public function list_ticket_and_comment($where,$limit='100',$offset='0'){
	    $this->db->select('t.col_id,tc.col_id as ticket_id,t.col_time as ttime,t.col_status as status ,t.col_question as question,t.col_attachment as attachment , t.col_type_id,u.col_nickname as user_name ,tc.col_time,tc.col_content');
	    $this->db->from(array('ticket t','ticket_comment tc','user u'));
	    $this->db->where('u.col_id','t.col_user_id',false);
	    $this->db->where('t.col_id','tc.col_ticket_id',false);
	    if(!empty($where)){ 
	        foreach ($where as $key=>$value){
	            $this->db->where($key,$value);
	        }
	    }
	    $this->db->limit($limit,$offset);
	    $query=$this->db->get();
	    if($query){
	        log_message('info', 'list_ticket_and_comment is success');
	        log_message('debug', $this->db->last_query());
	        return $query->result_array();
	    }else{
	        log_message('error', 'list_ticket_and_comment error '.mysql_error());
	        return false;
	    }
	    
	}
	
}




















