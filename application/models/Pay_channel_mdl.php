<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Pay_channel_mdl extends CI_Model {
	const TABLE='pay_channel';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}