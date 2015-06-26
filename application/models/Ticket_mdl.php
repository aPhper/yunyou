<?php
if (! defined('BASEPATH'))
    exit('No direct ticket access allowed');

class Ticket_mdl extends CI_Model
{

    const TABLE = 'ticket';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    /**
     * 创建一个工单
     * @param unknown $data
     * @return Ambigous <string, boolean, NULL>
     */
    public function create_ticket($data = array())
    {
        $mess = array();
        if (empty($data)) {
            $mess['info'] = 'create_ticket $data is null';
            $mess['type'] = 'info';
            $mess['return'] = false;
        } else {
            $res = $this->db->insert(self::TABLE, $data);
            if ($res) {
                $mess['info'] = 'create_ticket $data is null';
                $mess['type'] = 'info';
                $mess['return'] = $this->db->insert_id();
            } else {
                $mess['info'] = 'create_ticket  is error' . mysql_error();
                $mess['type'] = 'info';
                $mess['return'] = false;
            }
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }
    /**
     * 根据条件列出工单
     * @param unknown $where
     * @param number $limit
     * @param number $offset
     * @param string $order_by
     * @return Ambigous <string, boolean, NULL>
     */
    public function list_ticket($where = array(), $limit = 100, $offset = 0, $order_by = 'col_id')
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
            $mess['info'] = 'list ticket is success';
            $mess['type'] = 'info';
        } else {
            $mess['info'] = 'list ticket query error' . mysql_error();
            $mess['type'] = 'error';
            $mess['return'] = false;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }
    /**
     * 根据id获取工单
     * @param unknown $col_id
     * @return Ambigous <string, boolean, NULL>
     */
    public function get_ticket_by_id($col_id)
    {
        $mess = array();
        $query = $this->db->get_where(self::TABLE, array(
            'col_id' => intval($col_id)
        ));
        if ($query) {
            $mess['return'] = $query->result_array();
            $mess['info'] = 'get_ticket_by_id is success';
            $mess['type'] = 'info';
        } else {
            $mess['info'] = 'get_ticket_by_id' . mysql_error();
            $mess['type'] = 'error';
            $mess['return'] = false;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }
    /**
     * 更新工单
     * @param string $col_id
     * @param unknown $data
     * @return boolean
     */
    public function update_ticket($col_id = '', $data = array())
    {
        if (empty($data)) {
            log_message('info', 'updata_ticket  $data is null');
            return false;
        } else {
            $query = $this->db->update(self::TABLE, $data, array(
                'col_id' => intval($col_id)
            ));
            if ($query) {
                log_message('debug', $this->db->last_query());
                return $this->db->affected_rows();
            } else {
                log_message('error', 'update_ticket query error' . mysql_error());
                return false;
            }
        }
    }
    /**
     * 删除工单 注:置为无效
     * @param unknown $col_id
     */
    public function delete_ticket($col_id)
    {
        $this->db->delete(self::TABLE, array(
            'col_id' => $col_id
        ));
        return $this->db->affected_rows();
    }
    /**
     * 根据条件得到工单的条数
     * @param unknown $where
     * @return Ambigous <string, boolean, NULL>
     */
    public function get_ticket_num($where=array()){
        $mess = array();
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get(self::TABLE);
        if ($query) {
            $mess['return'] = $query->num_rows();
            $mess['info'] = 'get ticket num is success';
            $mess['type'] = 'info';
        } else {
            $mess['info'] = 'get ticket num query error' . mysql_error();
            $mess['type'] = 'error';
            $mess['return'] = false;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }
    // 	select a.col_time create_time,b.col_content type,d.col_name creator,a.col_question introduce,e.col_name anser,c.col_time end_time,c.col_content content
// 	from ticket a,ticket_type b,ticket_comment c,user d,user e
// 	where a.col_type_id=b.col_id
// 	and a.col_id=c.col_ticket_id
// 	and a.col_user_id=d.col_id
// 	and c.col_uid=e.col_id
    	public function list_ticket_dw($where=array(),$order_by='a.col_id'){
	    $this->db->order_by($order_by);
	    $this->db->select('a.col_time create_time,b.col_content type,d.col_name creator,a.col_question introduce,e.col_name anser,c.col_time end_time,c.col_content content');
	    $this->db->from('ticket a');
	    $this->db->join('ticket_type b','a.col_type_id=b.col_id','inner');
	    $this->db->join('ticket_comment c','a.col_id=c.col_ticket_id','inner');
	    $this->db->join('user d','a.col_user_id=d.col_id','inner');
	    $this->db->join('user e','c.col_uid=e.col_id','inner');
	    foreach ($where as $key => $value){
	        $this->db->where($key,$value);
	    };
	    $query = $this->db->get();
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", "list_ticket query page error".mysql_error());
	        return false;
	    }
	}
}