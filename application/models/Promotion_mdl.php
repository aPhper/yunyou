<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Promotion_mdl extends CI_Model {
	const TABLE='promotion';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}
//set_promotion
//update_promotion
//get_promotion
//get_promotion_list
//remove_promotion
