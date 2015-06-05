<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Ticket_type_mdl extends CI_Model {
	const TABLE='ticket_type';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}