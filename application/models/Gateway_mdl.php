<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Gateway_mdl extends CI_Model {
	const TABLE='cloud_gateway';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//set_gateway
//get_gateway_list
//get_gateway
//update_gateway
