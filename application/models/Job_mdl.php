<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Job_mdl extends CI_Model {
	const TABLE='cloud_job';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function job_create($data=array()) {
		$mess=array();
		if(!empty($data)&&is_array($data)){
			$query=$this->db->insert(self::TABLE,$data);
			if($query){
				$mess['type']='info';
				$mess['info']='job_create is success';
				$mess['return']=$this->db->insert_id();
			}else{
				$mess['return']=false;
				$mess['type']='error';
				$mess['info']='job_create is error '.mysql_error();
			}
		}else{
			$mess['return']=false;
			$mess['type']='info';
			$mess['info']='job_create $data is null or not array';
		}
		log_message($mess['type'], $mess['info']);
		return $mess['return'];
	}
	public function get_job_by_id($job_id) {
		if(is_numeric($job_id)){
			$query=$this->db->get_where(self::TABLE,array('col_id'=>$job_id));
			$res=$query->result_array();
			return $res[0];
		}
	}
}
//create_job
//remove_job
//update_job
//get_job_list
//get_job
