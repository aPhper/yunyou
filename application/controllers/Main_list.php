<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_list extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();  
    }    

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('top');
	}
	/**
	 * 显示运维左列表
	 */
	public function left_yw()
	{
	    $this->load->view('left_yw');
	}
	/**
	 * 显示运营左列表
	 */
	public function left_yy()
	{
	    $this->load->view('left_yy');
	}
	/**
	 * 显示客服左列表
	 */
	public function left_kf()
	{
	    $this->load->view('left_kf');
	}
	/**
	 * 运维管理显示云平台列表
	 */
	public function list_cloud()
	{
	    $this->load->view('');
	}
	/**
	 * 运营管理显示用户列表
	 */
	public function list_user()
	{
	    $this->load->view('user_list');
	}
	/**
	 * 客服显示资源列表
	 */
	public function list_resource()
	{
	    $this->load->view('');
	}
	
}
