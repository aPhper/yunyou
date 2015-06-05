<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Volume_snapshot_mdl extends CI_Model {
	const TABLE='cloud_snapshot';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function showTable(){
	    return self::TABLE;
	}
	/**
	 *
	 * @func: 列出卷的快照
	 * @date: 2015-4-24
	 * @author: gaoxu
	 * @param $where 条件数组
	 * @param $limit 限制条数
	 * @param $offset 偏移量
	 * @param $order_by 排序条件
	 * @return: Ambigous <string, boolean, NULL>
	 */
	public function list_volume_snapshot($where=array(),$limit='',$offset='',$order_by_title='col_id',$order_by_type='desc'){
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
	        $mess['info']='volume_snapshot_list is success';
	    }else{
	        $mess['return']=false;
	        $mess['type']='error';
	        $mess['info']='volume_snapshot_list query is error'.mysql_error();
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	/**
	 *
	 * @func: 创建卷快照信息插入数据库
	 * @date: 2015-4-24
	 * @author: gaoxu
	 * @param $data
	 * @return: Ambigous <string, boolean, NULL>
	 */
	public function volume_snapshot_create($data=array()) {
	    $mess=array();
	    if(!empty($data)&&is_array($data)){
	        $volume_snapshot_query = $this->db->insert ( self::TABLE,$data);
	        if($volume_snapshot_query){
	            $mess['info']='volume_snapshot_create  success';
	            $mess['type']='info';
	            $mess['return']=$this->db->insert_id();
	        }else{
	            $mess['info']='volume_snapshot_create  query is error'.mysql_error();
	            $mess['type']='error';
	            $mess['return']=false;
	        }
	        	
	    }else{
	        $mess['info']='volume_snapshot_create  $data is not array or null';
	        $mess['type']='info';
	        $mess['return']=false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	/**
	 *
	 * @func: 更新卷快照信息
	 * @date: 2015-4-24
	 * @author: gaoxu
	 * @param $col_id //volume_snapshotid
	 * @param $data //更新的数据
	 * @return: Ambigous <string, boolean, NULL>
	 */
	public function volume_snapshot_update($col_id='',$data=array()){
	    $mess=array();
	    if(!empty($col_id)&&!empty($data)&&is_numeric($col_id)&&is_array($data)){
	        $query=$this->db->update(self::TABLE, $data,array('col_id'=>$col_id));
	        if($query){
	            $mess['info']='volume_snapshot_update success';
	            $mess['type']='info';
	            $mess['return']=$this->db->affected_rows();
	        }else{
	            $mess['info']='volume_snapshot_update query is error'.mysql_error();
	            $mess['type']='error';
	            $mess['return']=false;
	        }
	    }else{
	        $mess['info']='volume_snapshot_update $col_id or $data is null';
	        $mess['type']='info';
	        $mess['return']=false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
	public function get_volume_snapshot_by_id($volume_snapshot_id) {
	    $mess=array();
	    if(!empty($volume_snapshot_id)&&is_numeric($volume_snapshot_id)){
	        $query=$this->db->get_where(self::TABLE,array('col_id'=>$volume_snapshot_id));
	        if($query){
	            $mess['info']='get_volume_snapshot_by_id   is success';
	            $mess['type']='info';
	            $mess['return']=$query->result_array();
	        }else{
	            $mess['info']='get_volume_snapshot_by_id query is error'.mysql_error();
	            $mess['type']='error';
	            $mess['return']=false;
	        }
	    }else{
	        $mess['info']='get_volume_snapshot_by_id $volume_snapshot_id  is null';
	        $mess['type']='info';
	        $mess['return']=false;
	    }
	    log_message($mess['type'], $mess['info']);
	    return $mess['return'];
	}
}
