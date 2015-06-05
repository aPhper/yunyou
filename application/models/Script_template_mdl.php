<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Script_template_mdl extends CI_Model {
	const TABLE='script_template';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function create_scr_tem($data){
	    $mess=array();
	    if(empty($data)){
	        $mess['info']='create_scr_tem $data is null';
	        $mess['type']='info';
	        $mess['return']=false;
	    }else{
	        //如果用户不存在 return false;
	        	
	        $res=$this->db->insert(self::TABLE,$data);
	        if($res){
	            $mess['info']='create_scr_tem is success';
	            $mess['type']='info';
	            $mess['return']=$this->db->insert_id();
	        }else{
	            $mess['info']='create_scr_tem  is error'.mysql_error();
	            $mess['type']='info';
	            $mess['return']=false;
	        }
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	public function list_template_script($where=array(),$limit=100,$offset=0,$order_by='ct.col_id',$order_by_type='desc'){
	    $mess=array();
	    if(is_array($where)&&is_numeric($limit)&&is_numeric($offset)){
	        $this->db->select('gs.col_name as script_name,ct.col_status_code as status,ct.col_timestamp as time');
	        $this->db->from(array('cloud_template ct','game_script gs','script_template st'));
	        $this->db->where('ct.col_id','st.col_template',FALSE);
	        $this->db->where('gs.col_id','st.col_script_id',FALSE);
	        $this->db->where('st.col_default','1');
	        if(!empty($where)){
	            foreach ($where as $key=>$value){
	                $this->db->where($key,$value);
	            }
	        }
	        $this->db->limit($limit,$offset);
	        $this->db->order_by($order_by,$order_by_type);
	        $query=$this->db->get();
	        log_message('debug', $this->db->last_query());
	        $mess['return']=$query->result_array();
	        $mess['info']='list_template_script is success';
	        $mess['type']='info';
	    }else{
	        $mess['info']='list_template_script  is not allow';
	        $mess['type']='info';
	        $mess['return']=false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
}