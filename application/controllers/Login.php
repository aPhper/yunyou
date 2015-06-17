<?php
/**
 * 判断访问是否合法
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * *用户登录与登出
 *
 * @param            
 *
 *
 *
 * @return return_type
 * @author gaoxu
 *         @date 2015-4-17下午3:29:24
 * @version v1.0.0
 *         
 */
class Login extends CI_Controller
{

    /**
     * 传递到对应视图的数据
     *
     * @access private
     * @var array
     */
    private $_data;

    /**
     * Referer 当前页是从哪个页面跳转过来的地址
     *
     * @access public
     * @var string
     */
    public $referrer;
    /**
     * 提示信息
     * @var array
     */
    public $information;
    /**
     * 构造函数
     * 加载form url
     * 加载form_validation
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('form_validation');
        $this->load->library('auth');
        $this->load->library('session');
        $this->load->library('common');
        $this->information=$this->config->item('user_login_tips');
        $this->_check_referrer();
    }
    /**
     * 错误消息
     * @var string
     */
//     public $error_string;

    /**
     * 检查referrer
     *
     * @access private
     * @return void
     */
    private function _check_referrer()
    {
        $ref = base64_decode($this->input->get('ref', true));
        $this->referrer = (! empty($ref)) ? $ref : base_url();
    }
    /**
     * 登录默认访问该方法
     */
    public function index()
    {
        if ($this->auth->hasLogin()) {//判断是否登录
            $left_url = $this->config->item('left_url');
            $main_url = $this->config->item('main_url');
            $user = $this->session->userdata('user_info');
            $this->_data['left_url']= $left_url[$user['col_role']];
            $this->_data['main_url']= $main_url[$user['col_role']];
            $this->load->view('main',$this->_data);
        } else {
            if ($this->form_validation->run('user_login') === FALSE) {//判断提交的内容
                $this->load->view('login');
            } else {
                $user = $this->user_mdl->validate_user($this->input->post('username', TRUE), $this->input->post('password', TRUE));
                if (! empty($user)) {
                    if($user['col_role']==$this->input->post('user_type')){
                        if ($this->auth->process_login($user)) {
                                redirect(base_url('main_list'));
                        }
                    }else{
                       $this->_data['error_string'] = $this->information['login_type_error'];
                       $this->load->view('login',$this->_data);
                    }
                }else {
                    $this->_data['error_string'] = $this->information['login_error'];
                    $this->load->view('login', $this->_data);
                }
            }
        }
    }
    /**
     * 退出登录
     */
    public function loginout()
    {
        if ($this->auth->hasLogin()) {
            $this->auth->process_logout();
        } else {
            redirect(base_url('login/index'));
        }
    }
}
