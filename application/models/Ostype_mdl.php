<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Ostype_mdl extends CI_Model {
	const TABLE='cloud_ostype';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function  create_ostype($data=array()){
	    if(empty($data)){
	        log_message('info','create offering $data is null');
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
	public function  list_ostype($where=array(),$limit='100',$order_by='col_id'){
	    foreach ($where as  $key=>$value) {
	        $this->db->where($key,$value);
	    }
	    $this->db->limit(intval($limit));
	    $this->db->order_by($order_by);
	    $query=$this->db->get(self::TABLE);
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", 'list offering query error'.mysql_error());
	        return false;
	    }
	}
	public function get_ostype_by_id($col_id) {
	    $query=$this->db->get_where(self::TABLE,array('col_id'=>intval($col_id)));
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message('error', 'get_offering_by_id'.mysql_error());
	        return false;
	    }
	}
	public function update_ostype($col_id='',$data=array()) {
	    if(empty($data)){
	        log_message('info', 'updata_offering  $data is null');
	        return false;
	    }else{
	        $query=$this->db->update(self::TABLE,$data,array('col_id'=>intval($col_id)));
	        if($query){
	            return $this->db->affected_rows();
	        }else{
	            log_message('error', 'update_offering query error'.mysql_error());
	            return false;
	        }
	    }
	}
	
	public function list_ostype_result($where=array()){
	    foreach ($where as $key => $value){
	        $this->db->like($key,$value);
	    }
	    $query=$this->db->get(self::TABLE);
	    return $query->num_rows();
	}
	
	public function list_ostype_con($offset=10,$limit=0,$where=array(),$order_by='col_id'){
	    foreach ($where as $key => $value){
	        $this->db->like($key,$value);
	    }
	    $this->db->limit($limit,$offset);
	    $this->db->order_by($order_by);
	    $query=$this->db->get(self::TABLE);
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", "list_ostype query page error".mysql_error());
	        return false;
	    }
	}
}
//set_ostype
//get_ostype_list
//get_ostype