<?php
/**
 * Auth.class.php文件
 * ==============================================
 * 用户验证，权限，
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @param unknowtype
 * @return return_type
 * @author: gaoxu
 * @date: 2015-4-20
 * @version: v1.0.0
 * @email gao_xu@126.com
 */

class Auth{
	/**
	 * 用户
	 *
	 * @access private
	 * @var array
	 */
	private $_user = array();
	
	/**
	 * 是否已经登录
	 *
	 * @access private
	 * @var boolean
	*/
	private $_hasLogin = NULL;
	
	/**
	 * 用户组
	 *
	 * @access public
	 * @var array
	 */
	public $groups = array(	'user','author','cm','tech','admin');
	
	/**
	 * CI句柄
	 *
	 * @access private
	 * @var object
	*/
	private $_CI;
	/**
	 * 构造函数
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		/** 获取CI句柄 */
		$this->_CI = & get_instance();
		$this->_CI->load->model('user_mdl');
		$this->_CI->load->library('session');
		$this->_user = $this->_CI->session->userdata('user_info');
	}
	/**
	 * 判断用户是否已经登录
	 *
	 * @access public
	 * @return void
	 */
	public function hasLogin()
	{
		/** 检查session，并与数据库里的数据相匹配 */
		if (NULL === $this->_hasLogin)
		{
			if(!empty($this->_user) && NULL !== $this->_user['col_id'])
			{
				$user = $this->_CI->user_mdl->get_user_by_id($this->_user['col_id']);
	
				if($user && $user['col_passwd'] == $this->_user['col_passwd'])
				{
				    $this->_hasLogin = TRUE;
				}else{
				    $this->_hasLogin = FALSE;
				}
			}
		}
		return $this->_hasLogin;
	}
 /**
     * 判断用户权限
     *
     * @access 	public
     * @param 	string 	$group 	用户组
     * @return 	boolean
     */
	public function exceed($group)
	{
		/** 权限验证通过 */
	    $return='';
        if(in_array($group, $this->groups) && $this->_user['col_role']==$group) 
		{
            $return =TRUE;
        }else{
        	$return =false;
        }
        return $return;	
	}
	/**
	 * 处理用户登出
	 *
	 * @access public
	 * @return void
	 */
	public function process_logout()
	{
	    log_message('info', 'user '.$this->_user["col_id"].' loginout at '.date('Y-m-d H:m:s'));
		$this->_CI->session->sess_destroy();
		redirect('login');
	}
	/**
	 * 处理用户登录
	 *
	 * @access public
	 * @param  array $user 用户信息
	 * @return boolean
	 */
	public function process_login($user)
	{
	    $return=FALSE;
		$this->_CI->load->model('login_log_mdl');
		$this->_user=$user;
		$log=array('col_user_id'=>$user['col_id'],'col_ip'=>$_SERVER['REMOTE_ADDR'],'col_agent'=>$this->_CI->input->user_agent());
		if($this->_CI->login_log_mdl->create_log($log))
		{
			/** 设置session */
			$this->_set_session();
			log_message('info', 'user '.$user["col_id"].' login at '.date('Y-m-d H:m:s'));
			$this->_hasLogin = TRUE;
			$return=TRUE;
		}
		return $return;
	}
	/**
	 * 设置session
	 *
	 * @access private
	 * @return void
	 */
	private function _set_session()
	{
		$session_data = array('user_info' => ($this->_user));
		$this->_CI->session->set_userdata($session_data);
	}
}