<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Game_script_mdl extends CI_Model {
	const TABLE='game_script';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
		log_message('info', 'Game_script_mdl class initialized');
	}
	/**
	 * 
	 * @func: 添加一个脚本
	 * @date: 2015-4-22
	 * @author: gaoxu
	 * @param $data array
	 * @return: boolean
	 */
	public function  create_script($data=array()){
	    $mess=array();
		if(empty($data)){
			$mess['info']='create_script $data is null';
			$mess['type']='info';
			$mess['return']=false;	
		}else{
			//如果用户不存在 return false;
			
				$res=$this->db->insert(self::TABLE,$data);
				if($res){
				    $mess['info']='create_script $data is null';
			        $mess['type']='info';
			        $mess['return']=$this->db->insert_id();	
					
					
				}else{
					$mess['info']='create_script  is error'.mysql_error();
			         $mess['type']='info';
			         $mess['return']=false;	
				}
		}
		log_message($mess['type'], $mess['info']);
		return $mess['return'];
	}
	/**
	 * 根据条件查找出来脚本
	 * @param unknown $where
	 * @param number $limit
	 * @param number $offset
	 * @param string $order_by
	 * @return Ambigous <string, boolean, NULL>
	 */
	public function  list_script($where=array(),$limit=100,$offset=0,$order_by='col_id'){
	    $mess=array();
		foreach ($where as  $key=>$value) {
			$this->db->where($key,$value);
		}
		$this->db->limit(intval($limit),$offset);
		$this->db->order_by($order_by);
		$query=$this->db->get(self::TABLE);
		if($query){
			$mess['return']= $query->result_array();
			$mess['info']='list script is success';
			$mess['type']='info';
		}else{
			$mess['info']= 'list script query error'.mysql_error();
			$mess['type']='error';
			$mess['return']=false;
		}
		log_message($mess['type'], $mess['info']);
		return $mess['return'];
	}
	/**
	 * 根据id查找脚本信息
	 * @param unknown $col_id
	 * @return Ambigous <string, boolean, NULL>
	 */
	public function get_script_by_id($col_id) {
	    $mess=array();
		$query=$this->db->get_where(self::TABLE,array('col_id'=>intval($col_id)));
		if($query){
			$mess['return'] =$query->result_array();
			$mess['info']='get_script_by_id is success';
			$mess['type']='info';
		}else{
			$mess['info']='get_script_by_id'.mysql_error();
			$mess['type']='error';
			$mess['return']=false;
		}
		log_message($mess['type'], $mess['info']);
		return $mess['return'];
	}
	/**
	 * 更新脚本信息
	 * @param string $col_id
	 * @param unknown $data
	 * @return boolean
	 */
	public function update_script($col_id='',$data=array()) {
		if(empty($data)){
			log_message('info', 'updata_script  $data is null');
			return false;
		}else{
			$query=$this->db->update(self::TABLE,$data,array('col_id'=>intval($col_id)));
			if($query){
			    log_message('debug', $this->db->last_query());
				return $this->db->affected_rows();
				
			}else{
				log_message('error', 'update_script query error'.mysql_error());
				return false;
			}
		}
	}
    /**
     * 检查用户脚本是否描述完整
     * @param unknown $user_id
     * @return unknown
     */
	public function check_script($user_id){
	      $sql='select col_id from game_script where col_author_id ='.$user_id.' and col_name is null or col_desc is null or col_game_id is null limit 1';
	      $query=$this->db->query($sql);
	      $res=$query->result_array();
	      if(!empty($res)){
	          return $res['0']['col_id'];    
	      }else{
	          return false;
	      }    
	}
	public function delete_script($col_id){
	    $this->db->delete(self::TABLE,array('col_id'=>$col_id));
	    return $this->db->affected_rows();
	}
	
	
}























