<?php
class Login extends CI_Controller{
    /**
     * 输出到view数据
     * @var array
     */
    private $_data='';
    /**
     * 用户基本信息
     * @var unknown
     */
    private $_userinfo='';
    /**
     * 默认访问index方法
     */
    public function __construct(){
        
    }
    public function index(){
        $this->load->view('login');
       
        $arr=array();
        
    }
    
}