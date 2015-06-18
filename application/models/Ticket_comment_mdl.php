<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Ticket_comment_mdl extends CI_Model {
	const TABLE='ticket_comment';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
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
}