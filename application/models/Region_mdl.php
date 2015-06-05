<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Region_mdl extends CI_Model {
	const TABLE='cloud_region';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function  create_region($data=array()){
	    if(empty($data)){
	        log_message('info','create region $data is null');
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
	public function  list_region($where=array(),$limit='100',$order_by='col_id'){
	    foreach ($where as  $key=>$value) {
	        $this->db->where($key,$value);
	    }
	    $this->db->limit(intval($limit));
	    $this->db->order_by($order_by);
	    $query=$this->db->get(self::TABLE);
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", 'list region query error'.mysql_error());
	        return false;
	    }
	}
	public function get_region_by_id($col_id) {
	    $query=$this->db->get_where(self::TABLE,array('col_id'=>intval($col_id)));
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message('error', 'get_region_by_id'.mysql_error());
	        return false;
	    }
	}
	public function update_region($col_id='',$data=array()) {
	    if(empty($data)){
	        log_message('info', 'updata_region  $data is null');
	        return false;
	    }else{
	        $query=$this->db->update(self::TABLE,$data,array('col_id'=>intval($col_id)));
	        if($query){
	            return $this->db->affected_rows();
	        }else{
	            log_message('error', 'update_region query error'.mysql_error());
	            return false;
	        }
	    }
	}
}
//set_region
//get_region_list
//get_region
