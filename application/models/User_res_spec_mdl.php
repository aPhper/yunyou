<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_res_spec_mdl extends CI_Model {
	const TABLE='user_res_spec';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}