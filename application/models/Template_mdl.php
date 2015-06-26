<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Template_mdl extends CI_Model {
	const TABLE='cloud_template';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function showTable(){
	    return self::TABLE;
	}
	public function  create_template($data=array()){
		if(empty($data)){
			log_message('info','create template $data is null');
			return false;
		}else{
			//如果用户不存在 return false;
			
				$res=$this->db->insert(self::TABLE,$data);
				if($res){
					return $this->db->insert_id();
					log_message('debug', $this->db->lat_query());
				}else{
					log_message("error",mysql_error());
					return false;
				}
		}
	}
	public function  list_template($where=array(),$limit='100',$offset=0,$order_by='col_id'){
		foreach ($where as  $key=>$value) {
			$this->db->where($key,$value);
		}
		$this->db->limit(intval($limit),$offset);
		$this->db->order_by($order_by);
		$query=$this->db->get(self::TABLE);
		if($query){
			return $query->result_array();
		}else{
			log_message("error", 'list template query error'.mysql_error());
			return false;
		}
	}
	public function get_template_by_id($col_id) {
		$query=$this->db->get_where(self::TABLE,array('col_id'=>intval($col_id)));
		if($query){
			return $query->result_array();
		}else{
			log_message('error', 'get_template_by_id'.mysql_error());
			return false;
		}
	}
	public function update_template($col_id='',$data=array()) {
		if(empty($data)){
			log_message('info', 'updata_template  $data is null');
			return false;
		}else{
			$query=$this->db->update(self::TABLE,$data,array('col_id'=>intval($col_id)));
			if($query){
				return $this->db->affected_rows();
			}else{
				log_message('error', 'update_template query error'.mysql_error());
				return false;
			}
		}
	}
	
	public function list_template_result($where=array()){
	    $this->db->select('d.col_name col_zone_name,d.col_id col_zone_id, b.col_name col_ostype_name,b.col_id col_ostype_id,c.col_name col_offering_name,c.col_id col_offering_id,a.status,a.col_valid,a.col_check,a.col_template_id,a.col_id');
	    $this->db->from('cloud_template a');
	    $this->db->join('cloud_ostype b','a.col_ostype_id=b.col_id','inner');
	    $this->db->join('cloud_zone d','a.col_zone_id=d.col_id','inner');
	    $this->db->join('template_offering_map e','a.col_id=e.col_template_id','inner');
	    $this->db->join('cloud_offering c','e.col_offering_id=c.col_id','inner');
	    $this->db->where('e.col_offering_id=c.col_id');
	    foreach ($where as $key => $value){
	        $this->db->where($key,$value);
	    };
	    $query = $this->db->get();
	    return $query->num_rows();
	}
	
	public function list_template_con($offset=10,$limit=0,$where=array(),$order_by='a.col_id'){
	    $this->db->limit($limit,$offset);
	    $this->db->order_by($order_by);
	    $this->db->select('d.col_name col_zone_name,d.col_id col_zone_id, b.col_name col_ostype_name,b.col_id col_ostype_id,c.col_name col_offering_name,c.col_id col_offering_id,a.status,a.col_valid,a.col_check,a.col_template_id,a.col_id');
	    $this->db->from('cloud_template a');
	    $this->db->join('cloud_ostype b','a.col_ostype_id=b.col_id','inner');
	    $this->db->join('cloud_zone d','a.col_zone_id=d.col_id','inner');
	    $this->db->join('template_offering_map e','a.col_id=e.col_template_id','inner');
	    $this->db->join('cloud_offering c','e.col_offering_id=c.col_id','inner');
	    $this->db->where('e.col_offering_id=c.col_id');
	    foreach ($where as $key => $value){
	        $this->db->where($key,$value);
	    };
	    $query = $this->db->get();
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", "list_template query page error".mysql_error());
	        return false;
	    }
	}
}
