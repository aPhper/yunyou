<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Zone_mdl extends CI_Model {
	const TABLE='cloud_zone';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//set_zone
//get_zone_list
//get_zone
