<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Op_log_mdl extends CI_Model {
	const TABLE='op_log';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	/**
	 * 创建操作日志
	 * @param unknown $data
	 * @return Ambigous <string, boolean, NULL>
	 */
	public function create_op_log($data=array()){
	    $mess=array();
	    if(empty($data)){
	        $mess['type']='info';
	        $mess['info']='create op_log $data is null';
	        $mess['return']=false;
	    }else{
	        $query=$this->db->insert(self::TABLE,$data);
	        if($query){
	            $mess['return']=$this->db->insert_id();
	            $mess['type']='info';
	            $mess['info']='create op_log is success';
	        }else{
	            $mess['return']=false;
	            $mess['type']='error';
	            $mess['info']='create op_log is error '.mysql_error();
	        }
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
}