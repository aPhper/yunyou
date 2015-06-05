<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Login_log_mdl extends CI_Model {
	const TABLE = 'login_log';
	public function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	/**
	 * 
	 * @func: 生成登录日志
	 * @date: 2015-4-20
	 * @author: gaoxu
	 * @param unknowtype
	 * @return: boolean
	 */
	public function create_log($data=array()) {
		if (! empty ( $data )) {
			$query = $this->db->insert ( self::TABLE, $data );
			if ($query) {
				return $this->db->insert_id ();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}