<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Cloud extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('cloud_mdl');
    }
    public function add_cloud(){
        
    }
    
}