<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Notice_mdl extends CI_Model {
	const TABLE='notice';
	public function __construct(){
		parent::__construct ();
		$this->load->database ();
	}
	public function list_notice($param) {
	    ;
	}
    public function get_notice_by_id(){
        
    }
}
