<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Pay_log_mdl extends CI_Model {
	const TABLE='user_pay_log';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}