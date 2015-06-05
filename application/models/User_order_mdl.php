<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_order_mdl extends CI_Model {
	const TABLE='user_order';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//create_user_order
//get_user_order
//get_user_order_lsit
//update_user_order