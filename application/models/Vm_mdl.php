<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Vm_mdl extends CI_Model {
	const TABLE='vm';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
		//$this->_load_cloud();
		log_message('info', 'Vm_mdl class initialized');
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
	/**
	 * 
	 * @func: 列出虚拟机
	 * @date: 2015-4-24
	 * @author: gaoxu
	 * @param $where 条件数组
	 * @param $limit 限制条数
	 * @param $offset 偏移量
	 * @param $order_by 排序条件
	 * @return: Ambigous <string, boolean, NULL>
	 */
	public function list_vm($where=array(),$limit='',$offset='',$order_by_title='col_id',$order_by_type='desc'){
		$mess=array();
		if(!empty($where)){
			foreach ($where as  $key=>$value) {
				$this->db->where($key,$value);
			}
		}
			if(!empty($limit)&&!empty($offset)){
				$this->db->limit(intval($limit),intval($offset));
			}
			if(!empty($order_by_title)&&!empty($order_by_type)){
				$this->db->order_by($order_by_title,$order_by_type);
			}
			$query=$this->db->get(self::TABLE);
			if($query){
				$mess['return']=$query->result_array();
				$mess['type']='info';
				$mess['info']='vm_list is success';
			}else{
				$mess['return']=false;
				$mess['type']='error';
				$mess['info']='vm_list query is error'.mysql_error();
			}
			log_message($mess['type'], $mess['info']);
		return $mess['return'];
	}
	/**
	 * 
	 * @func: 创建虚拟机信息插入数据库
	 * @date: 2015-4-24
	 * @author: gaoxu
	 * @param $data
	 * @return: Ambigous <string, boolean, NULL>
	 */
	public function vm_create($data=array()) {
		$mess=array();
		if(!empty($data)&&is_array($data)){
			$vm_query = $this->db->insert ( self::TABLE,$data);
			if($vm_query){
				$mess['info']='vm_create  success';
				$mess['type']='info';
				$mess['return']=$this->db->insert_id();
			}else{
				$mess['info']='vm_create  query is error'.mysql_error();
				$mess['type']='error';
				$mess['return']=false;
			}
			
		}else{
			$mess['info']='vm_create  $data is not array or null';
			$mess['type']='info';
			$mess['return']=false;
		}
		log_message($mess['type'], $mess['info']);
		return $mess['return'];	
	}
	/**
	 * 
	 * @func: 更新虚拟机信息
	 * @date: 2015-4-24
	 * @author: gaoxu
	 * @param $col_id //vmid
	 * @param $data //更新的数据
	 * @return: Ambigous <string, boolean, NULL>
	 */
	public function vm_update($col_id='',$data=array()){
		$mess=array();
		if(!empty($col_id)&&!empty($data)&&is_numeric($col_id)&&is_array($data)){
			$query=$this->db->update(self::TABLE, $data,array('col_id'=>$col_id));
			if($query){
				$mess['info']='vm_update success';
				$mess['type']='info';
				$mess['return']=$this->db->affected_rows();
			}else{
				$mess['info']='vm_update query is error'.mysql_error();
				$mess['type']='error';
				$mess['return']=false;
			}
		}else{
			$mess['info']='vm_update $col_id or $data is null';
			$mess['type']='info';
			$mess['return']=false;
		}
		log_message($mess['type'], $mess['info']);
		return $mess['return'];
	}
	/**
	 * 获取单个虚拟机的信息
	 * @param int $vm_id
	 * @return Ambigous <string, boolean, NULL>
	 */
	public function get_vm_by_id($vm_id) {
		$mess=array();
		if(!empty($vm_id)&&is_numeric($vm_id)){
			$query=$this->db->get_where(self::TABLE,array('col_id'=>$vm_id));
			if($query){
				$mess['info']='get_vm_by_id   is success';
				$mess['type']='info';
				$mess['return']=$query->result_array();
			}else{
				$mess['info']='get_vm_by_id query is error'.mysql_error();
				$mess['type']='error';
				$mess['return']=false;
			}
		}else{
			$mess['info']='get_vm_by_id $vm_id  is null';
			$mess['type']='info';
			$mess['return']=false;
		}
		log_message($mess['type'], $mess['info']);
		return $mess['return'];
	}
	/**
	 * 获取vm的数量
	 * @param array $where 条件数组
	 * @return Ambigous <string, boolean, unknown>
	 */
	public function get_vm_num($where=array()){
	    $mess=array();
	    if(is_array($where)&&!empty($where)){
	        foreach ($where as  $key=>$value) {
	            $this->db->where($key,$value);
	        }
	        }
	        $query=$this->db->get(self::TABLE);
	        if($query){
	            $num=$query->num_rows();
	            $mess['info']='get_vm_num is success';
	            $mess['type']='info';
	            $mess['return']=$num;
	        }else{
	            $mess['info']='get_vm_num query is error'.mysql_error();
	            $mess['type']='error';
	            $mess['return']=false;
	        }
	    log_message($mess['type'], $mess['info']);
	       return $mess['return'];
	}
	public function get_vm_url($vm_id){
	    if(!is_numeric($vm_id)){
	       return false;    
	    }
	    $mess=array();
	    $this->db->select('vm.col_connection_id as id,cg.col_ip,cg.col_port,cg.col_url');
	    $this->db->from(array('vm vm','cloud_gateway cg',));
	    $this->db->where('vm.col_id',$vm_id);
	    $this->db->where('vm.col_gateway_id','cg.col_id',false);
	    $query=$this->db->get();
	    if($query){
	        $res=$query->result_array();
	        //return $res;
	       if(empty($res)||!$res){
	            $mess['info']='get_vm_url vm is not url';
	            $mess['type']='info';
	            $mess['return']=false;
	       }else{
    	       $url=$res[0]['col_ip'].':'.$res[0]['col_port'].'/'.$res['0']['col_url'].'/'.$res[0]['id'];
    	       $mess['info']='get_vm_url is success';
    	       $mess['type']='info';
    	       $mess['return']=$url;
	        }
	    }else{
	        $mess['info']='get_vm_url is error'.mysql_error();
	        $mess['type']='error';
	        $mess['return']=false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
}

