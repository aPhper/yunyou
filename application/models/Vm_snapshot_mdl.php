<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Vm_snapshot_mdl extends CI_Model {
	const TABLE='cloud_vmsnapshot';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	/**
	 *
	 * @func: 访问TABLE
	 * @date: 2015-4-24
	 * @author: gaoxu
	 * @return: string
	 */
	public function showTable(){
		return self::TABLE;
	}
	public function create_vm_snapshot($data){
		$mess=array();
		if (!empty($data)) {
			$query=$this->db->insert(self::TABLE,$data);
			if($query){
				$mess['type']='info';
				$mess['message']='create_vm_snapshot success';
				$mess['return']=$this->db->insert_id();
			}else{
				$mess['type']='error';
				$mess['message']='create_vm_snapshot $query is error'.mysql_error();
				$mess['return']=false;
			}
		}else{
			$mess['type']='info';
			$mess['message']='create_vm_snapshot $data is null';
			$mess['return']=false;
		}
		log_message($mess['type'],$mess['message']);
		return $mess['return'];
	}
	public function get_vm_snapshot_by_id($col_id){
		$mess=array();
		if(!empty($col_id)&&is_numeric($col_id)){
			$query=$this->db->get_where(self::TABLE,array('col_id'=>$col_id));
			if($query){
				$mess['type']='info';
				$mess['message']='get_vm_snapshot_by_id success';
				$mess['return']=$query->result_array();
			}else{
				$mess['type']='info';
				$mess['message']='get_vm_snapshot_by_id query is error'.mysql_error();
				$mess['return']=false;
			}
		}else{
			$mess['type']='info';
			$mess['message']='get_vm_snapshot_by_id $col_id is null';
			$mess['return']=false;
		}
		log_message($mess['type'],$mess['message']);
		return $mess['return'];
	}
}
//create_vm_snapshot
//get_vm_snapshot_list
//get_vm_snapshot
//remove_vm_snapshot
//update_vm_snapshot