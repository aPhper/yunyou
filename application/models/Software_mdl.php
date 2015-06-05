<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Software_mdl extends CI_Model {
	const TABLE='software';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}