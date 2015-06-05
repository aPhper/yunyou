<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_coupon_mdl extends CI_Model {
	const TABLE='user_coupon';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//create_user_coupon
//get_coupon
//remove_coupon
//get_coupon_list
