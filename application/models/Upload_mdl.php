<?php
class Upload extends CI_Model{
    private $_upload_path;
    private $_upload_config;
    public function __construct(){
        parent::__construct();
        $this->_upload_path=$this->config->item('script_path');
    }
    public function upload_config(){
        $config=$this->config->item('script_config');
        $this->load->library('upload',$config);
    }
}