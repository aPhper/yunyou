<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class User_mdl extends CI_Model {
	const TABLE='user';
	/**
	 * 用户单一标识
	 * @access private
	 * @var array
	 */
	private $_unique_key=array('col_nickname','col_mail','col_call','col_qq','col_winxin','col_card','col_alipay','col_banknum');
	/**
	 * 
	 * @func: 构造函数
	 * @date: 2015-4-20
	 * @author: gaoxu
	 */
	
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function create_user($data=array()){
		if (empty($data)) {
			return false;
		}
		$query=$this->db->insert(self::TABLE,$data);
		return $this->db->insert_id();
	}
	/**
	 * 
	 * @func: 函数功能描述
	 * @date: 2015-4-20
	 * @author: gaoxu
	 * @param $uid 用户唯一id
	 * @param $where 查找条件
	 * @param $limit 查找条数
	 * @return: boolean
	 */
	public  function get_user_list($where=array(),$limit='100',$offset) {
		$this->db->select('*');
		$this->db->from(self::TABLE);
		if(is_array($where)){
			foreach ($where as $key=> $value) {
				$this->db->where($key,$value);
			}
		$this->db->limit(intval($limit),$offset);
		$query=$this->db->get();
		return $query->result_array();
		}else{
			return false;
		}		
	}
	/**
	 * 
	 * @func: 更新用户信息
	 * @date: 2015-4-20
	 * @author: gaoxu
	 * @param int $uid 用户唯一id
	 * @param array $data 用户新信息
	 * @return: boolean
	 */
	public function update_user($uid,$data) {
		if(key_exists('col_passwd',$data)){
			$data['col_passwd']=sha1($data['col_passwd']);
		}
		$this->db->where('col_id', intval($uid));
		$this->db->update(self::TABLE, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
	 * 
	 * @func: 删除用户
	 * @date: 2015-4-20
	 * @author: gaoxu
	 * @param int uid
	 * @return: boolean
	 */
	public function remove_user($uid) {
		$this->db->delete(self::TBL_USERS, array('col_id' => intval($uid))); 
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	/**
	 * 
	 * @func: 根据用户id获取用户信息
	 * @date: 2015-4-20
	 * @author: gaoxu
	 * @param int $uid
	 * @return: array $data:
	 */
	public function get_user_by_id($uid) {
		$data = array();
		$this->db->select('*')->from(self::TABLE)->where('col_id', $uid)->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$data = $query->row_array();
		}
		$query->free_result();
		return $data;
	}
	/**
	 * 
	 * @func: 检查用户是否已存在
	 * @date: 2015-4-20
	 * @author: gaoxu
	 * @param string $key 字段名 
	 * @param string $value 字段值
	 * @param int $exclude_uid 排除的uid
	 * @return: boolean true 存在， false 不存在
	 */
	public function check_exist($key = 'col_nickname',$value = '', $exclude_uid = 0)
	{
		if(in_array($key, $this->_unique_key) && !empty($value))
		{
			$this->db->select('col_id')->from(self::TABLE)->where($key, $value);
				
			if(!empty($exclude_uid) && is_numeric($exclude_uid))
			{
				$this->db->where('col_id <>', $exclude_uid);
			}
			$query = $this->db->get();
			$num = $query->num_rows();
			$query->free_result();
			return ($num > 0) ? TRUE : FALSE;
		}
		return FALSE;
	}
	/**
	 * 
	 * @func: 用户密码是否正确
	 * @date: 2015-4-20
	 * @author: gaoxu
	 * @param string $username
	 * @param string $password
	 * @return: boolean
	 */
	public function validate_user($username, $password){
		$data = FALSE;
		$password=sha1($password);
		$this->db->where('col_nickname',$username);
		$this->db->where('col_passwd',$password);
		$this->db->limit(1);
		$query=$this->db->get(self::TABLE);
		if($query->num_rows()==1){
			$data=$query->result_array();
		}
		$query->free_result();
		return $data['0'];
	}
	public function resetpasswd($user_id,$oldpasswd,$newpasswd){
	    if(!empty($user_id)&&!empty($oldpasswd)&&!empty($newpasswd)&&is_numeric($user_id)){
	        $data = FALSE;
	        $oldpasswd=sha1($oldpasswd);
	        $this->db->where('col_id',$user_id);
	        $this->db->where('col_passwd',$oldpasswd);
	        $this->db->limit(1);
	        $query=$this->db->get(self::TABLE);
	        if($query->num_rows()==1){
	            $data=$this->update_user($user_id,array('col_passwd'=>$newpasswd));
	        } 
	        return $data;    
	    }
	}
	public function get_user_num($where=array()){
	    $this->db->select('*');
	    $this->db->from(self::TABLE);
	    if(is_array($where)){
	        foreach ($where as $key=> $value) {
	            $this->db->where($key,$value);
	        }
	        $query=$this->db->get();
	        if($query){
	            return $this->db->last_query();
	        }else{
	            return false;
	        }
	        
	   }else{
	       return false;
	   }
	}
}
