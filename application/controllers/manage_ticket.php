<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Manage_ticket extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library(array('session','form_validation','common','auth'));
        $this->load->helper(array('form','url')); 
        if(!$this->auth->hasLogin()){
            redirect(base_url('login'));
        }
    }
    public function list_ticket(){
        
    }
    public function view_ticket(){
        
    }
}