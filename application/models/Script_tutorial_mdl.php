<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Script_tutorial_mdl extends CI_Model {
	const TABLE='script_tutorial';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
}