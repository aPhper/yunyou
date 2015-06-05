<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Vm_software_mdl extends CI_Model {
	const TABLE='vm_software';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}