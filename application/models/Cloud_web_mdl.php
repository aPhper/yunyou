<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Cloud_web_mdl extends CI_Model {
	const TABLE='cloud';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
		log_message('info', 'Cloud_web_mdl class initialized');
	}
	public function update_cloud($col_id='',$data=array()){
		$mess=array();
		if (!empty($data)&&!empty($col_id)) {
			$this->db->where('col_id',intval($col_id));
			$query=$this->db->update(self::TABLE,$data);
			if($query){
				$mess['type']='info';
				$mess['message']='update_cloud success';
				$mess['return']=true;
			}else{
				$mess['type']='info';
				$mess['message']='update_cloud $query is error'.mysql_error();
				$mess['return']=false;
			}
		}else{
		$mess['type']='info';
		$mess['message']='update_cloud $col_id||$data is null';
		$mess['return']=false;
		}
		log_message($mess['type'],$mess['message']);
		return $mess['return'];
	}
	public function create_cloud($data){
		$mess=array();
		if (!empty($data)) {
			$query=$this->db->insert(self::TABLE,$data);
			if($query){
				$mess['type']='info';
				$mess['message']='update_cloud success';
				$mess['return']=$this->db->insert_id();
			}else{
				$mess['type']='error';
				$mess['message']='update_cloud $query is error'.mysql_error();
				$mess['return']=false;
			}
		}else{
			$mess['type']='info';
			$mess['message']='update_cloud $col_id||$data is null';
			$mess['return']=false;
		}
		log_message($mess['type'],$mess['message']);
		return $mess['return'];
	}
	public function remve_cloud($col_id){
		$mess=array();
		if(is_numeric($col_id)){
		$query = $this->db->delete(self::TABLE,array('col_id'=>$col_id));
			if($query){
				$mess['type']='info';
				$mess['message']='remove_cloud success';
				$mess['return']=true;
			}else{
				$mess['type']='error';
				$mess['message']='remove_cloud $query is error'.mysql_error();
				$mess['return']=false;
			}
		}else{
			$mess['type']='info';
			$mess['message']='remove_cloud $col_id is not num';
			$mess['return']=false;
		}
		log_message($mess['type'],$mess['message']);
		return $mess['return'];
	}
	public function list_cloud($where=array(),$limit='100',$order_by='col_id') {
		foreach ($where as  $key=>$value) {
				$this->db->where($key,$value);
			}
			$this->db->limit(intval($limit));
			$this->db->order_by($order_by);
			$query=$this->db->get(self::TABLE);
			if($query){
				return $query->result_array();
			}else{
				log_message("error", 'list_cloud query error'.mysql_error());
				return false;
			}
	}
}