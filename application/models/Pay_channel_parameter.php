<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Pay_channel_paramet_mdl extends CI_Model {
	const TABLE='cloud_gateway';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}