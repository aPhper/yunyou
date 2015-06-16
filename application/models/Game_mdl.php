<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct game access allowed' );
class Game_mdl extends CI_Model {
	const TABLE='game';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function  create_game($data=array()){
	    if(empty($data)){
	        log_message('info','create game $data is null');
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
	public function  list_game($where=array(),$limit='100',$offset,$order_by='col_id'){
	    foreach ($where as  $key=>$value) {
	        $this->db->where($key,$value);
	    }
	    $this->db->limit(intval($limit),$offset);
	    $this->db->order_by($order_by);
	    $query=$this->db->get(self::TABLE);
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message("error", 'list game query error'.mysql_error());
	        return false;
	    }
	}
	public function get_game_by_id($col_id) {
	    $query=$this->db->get_where(self::TABLE,array('col_id'=>intval($col_id)));
	    if($query){
	        return $query->result_array();
	    }else{
	        log_message('error', 'get_game_by_id'.mysql_error());
	        return false;
	    }
	}
	public function update_game($col_id='',$data=array()) {
	    if(empty($data)){
	        log_message('info', 'updata_game  $data is null');
	        return false;
	    }else{
	        $query=$this->db->update(self::TABLE,$data,array('col_id'=>intval($col_id)));
	        if($query){
	            return $this->db->affected_rows();
	        }else{
	            log_message('error', 'update_game query error'.mysql_error());
	            return false;
	        }
	    }
	}
	public function get_game_num($where=array()){
	    $this->db->select('*');
	    $this->db->from(self::TABLE);
	    if(is_array($where)){
	        foreach ($where as $key=> $value) {
	            $this->db->where($key,$value);
	        }
	        $query=$this->db->get();
	        if($query){
	            return $query->num_rows();
	        }else{
	            return false;
	        }
	         
	    }else{
	        return false;
	    }
	}
}