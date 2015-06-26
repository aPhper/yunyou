<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Zone_mdl extends CI_Model {
	const TABLE='cloud_zone';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function  create_zone($data=array()){
	    if(empty($data)){
	        log_message('info','create zone $data is null');
	        return false;
	    }else{
	
	        $res=$this->db->insert(self::TABLE,$data);
	        if($res){
	            return $this->db->insert_id();
	        }else{
	            log_message("error",mysql_error());
	            return false;
	        }
	    }
	}
	public function  list_zone($where=array(),$limit='100',$order_by='col_id'){
	    foreach ($where as  $key=>$value) {
	        $this->db->where($key,$value);
	    }
	    $this->db->limit(intval($limit));
	    $this->db->order_by($order_by);
	    $query=$this->db->get(self::TABLE);
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", 'list zone query error'.mysql_error());
	        return false;
	    }
	}
	public function get_zone_by_id($col_id) {
	    $query=$this->db->get_where(self::TABLE,array('col_id'=>intval($col_id)));
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message('error', 'get_zone_by_id'.mysql_error());
	        return false;
	    }
	}
	public function update_zone($col_id='',$data=array()) {
	    if(empty($data)){
	        log_message('info', 'updata_zone  $data is null');
	        return false;
	    }else{
	        $query=$this->db->update(self::TABLE,$data,array('col_id'=>intval($col_id)));
	        if($query){
	            return $this->db->affected_rows();
	        }else{
	            log_message('error', 'update_zone query error'.mysql_error());
	            return false;
	        }
	    }
	}
	
	public function list_zone_result($where=array()){
	    foreach ($where as $key => $value){
	        $this->db->like($key,$value);
	    }
	    $query=$this->db->get(self::TABLE);
	    return $query->num_rows();
	}
	
	public function list_zone_con($offset=10,$limit=0,$where=array(),$order_by='col_id'){
	    foreach ($where as $key => $value){
	        $this->db->like($key,$value);
	    }
	    $this->db->limit($limit,$offset);
	    $this->db->order_by($order_by);
	    $query=$this->db->get(self::TABLE);
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", "list_zone query page error".mysql_error());
	        return false;
	    }
	}
}
//set_zone
//get_zone_list
//get_zone
