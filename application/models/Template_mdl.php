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
	public function  list_template($where=array(),$limit='100',$order_by='col_id'){
		foreach ($where as  $key=>$value) {
			$this->db->where($key,$value);
		}
		$this->db->limit(intval($limit));
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
}
//set_template
//get_template_list
//get_template
//make_template
//remove_template
//update_template
//