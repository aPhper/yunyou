<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Region_mdl extends CI_Model {
	const TABLE='cloud_region';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//set_region
//get_region_list
//get_region
