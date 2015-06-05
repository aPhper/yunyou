<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Ostype_mdl extends CI_Model {
	const TABLE='cloud_ostype';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//set_ostype
//get_ostype_list
//get_ostype