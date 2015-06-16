<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class View_template_mdl extends CI_Model {
	
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	
	public function list_template($where=array(),$limit='100',$offset='0'){
	    $mess = array ();
	    $this->db->select('ct.col_id as template_id,gs.col_name as script_name,u.col_name as user_name,ct.col_timestamp as time,ct.status as status,ct.col_template_id');
	    $this->db->from(array('cloud_template ct','script_template st','game_script gs','user u'));
	    $this->db->where('ct.col_id','st.col_template',false);
	    $this->db->where('st.col_default','1');
	    $this->db->where('ct.col_user_id','u.col_id',false);
	    $this->db->where('st.col_script_id','gs.col_id',false);
	    if(!empty($where)){
	        foreach ($where as $key =>$value){
	            $this->db->where($key,$value);
	        }
	    }
	    $this->db->limit($limit,$offset);
	    $query=$this->db->get();
	    if($query){
	        $mess ['return'] = $query->result_array();
	        $mess ['info'] = 'lsit_template is success';
	        $mess ['type'] = 'info';
	    }else{
	        $mess ['return'] = false;
	        $mess ['info'] = 'lsit_template is error '.mysql_error();
	        $mess ['type'] = 'info';
	    }
	    log_message ( $mess ['type'], $mess ['info'] );
	    return $mess ['return'];
	}
	public function get_template_num($where){
	    $mess = array ();
	    $this->db->select('ct.col_id as template_id,gs.col_name as script_name,u.col_name as user_name,ct.col_timestamp as time,ct.status as status');
	    $this->db->from(array('cloud_template ct','script_template st','game_script gs','user u'));
	    $this->db->where('ct.col_id','st.col_template',false);
	    $this->db->where('st.col_default','1');
	    $this->db->where('ct.col_user_id','u.col_id',false);
	    $this->db->where('st.col_script_id','gs.col_id',false);
	    if(!empty($where)){
	        foreach ($where as $key =>$value){
	            $this->db->where($key,$value);
	        }
	    }
	    $query=$this->db->get();
	    if($query){
	        $mess ['return'] = $query->num_rows();
	        $mess ['info'] = 'get_template_num is success';
	        $mess ['type'] = 'info';
	    }else{
	        $mess ['return'] = false;
	        $mess ['info'] = 'get_template_nunm is error '.mysql_error();
	        $mess ['type'] = 'info';
	    }
	    log_message ( $mess ['type'], $mess ['info'] );
	    return $mess ['return'];
	}
}