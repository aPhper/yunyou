<?php
/**
 * common.php文件
 * ==============================================
 * 常用方法
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: gaoxu
 * @date: 2015-4-23
 * @version: v1.0.0
 * @email gao_xu@126.com
 */
class Common{
	/**
	 * CI句柄
	 *
	 * @access private
	 * @var object
	 */
	private $_CI;
	function __construct(){
		/** 获取CI句柄 */
		$this->_CI = & get_instance();
	}
    /**
     * 页面跳转
     * @param string $url
     * @param string $info
     */
	public function jump($url='',$info=''){
		$data['url']=$url;
		$data['message']=$info;
		$this->_CI->load->view('jump',$data);
	}
	/**
	 * curl post/put/get/delete
	 * @param string $url
	 * @param array $data
	 * @param string $type
	 * @return mixed
	 */
	public function curl_client($url='',$data=array(),$type='POST'){
	    $data_string = json_encode($data);
	    log_message('debug', 'post_data '.$data_string);
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	    curl_setopt($ch, CURLOPT_TIMEOUT, '3');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'Content-Type: application/json',
	    'Content-Length: ' . strlen($data_string))
	    );
	     $result = curl_exec($ch);
	     if($result){
	         log_message('error',$result );
	         return $result;
	     }else{
	        $error=curl_error($ch);
	         log_message('error',$error );
	         return $error;
	     }
	     curl_close($ch);
	    
	}
	/**
	 * 传入的数据转化为数组
	 * @param object&array $array
	 * @return array
	 */
	public function object_array($array) {
	    if (is_object ( $array )) {
	        $array = ( array ) $array;
	    }
	    if (is_array ( $array )) {
	        foreach ( $array as $key => $value ) {
	            $array [$key] = $this->object_array ( $value );
	        }
	    }
	    return $array;
	}
	/**
	 * 生成一个uuid
	 * @return string
	 */
    public function guid()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); // optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid =substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12) ;
            return $uuid;
        } 
	}
	/**
	 * 判断是否不是一个json数据
	 * @param unknown $str
	 * @return boolean
	 */
	public function is_not_json($str){
         return is_null(json_decode($str));
    }
    public function page_config($total,$limit,$url){
        $this->_CI->load->library('pagination');
        $config['base_url'] = $url;	
        $config['total_rows'] = $total;
        $config['per_page'] =$limit;
        $config['num_links'] = 5;
        $config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['first_tag_open']='<li class="paginItem">';
        $config['first_tag_close']='</li>';
        $config['last_tag_open'] = '<li class="paginItem">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="paginItem">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="paginItem">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginItem current"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginItem">';
        $config['num_tag_close'] = '</li>';
        $config['anchor_class'] = "paginItem";
        
        $this->_CI->pagination->initialize($config);
        $link=$this->_CI->pagination->create_links();
        return $link;
    }
    /**
     * 上传文件
     * @param string $file_name
     * @param string $url
     * @param string $username
     * @param string $passwd
     * @return Ambigous <string, boolean>
     */
    public function ftp($file_name = '', $url = '', $username = '', $passwd = '',$file_path='')
    {   
        $mess=array();
        $file = $file_path.DIRECTORY_SEPARATOR.$file_name;
        $remote_file = $file_name;
        if(!file_exists($file)){//文件是否存在
            $mess['type']='error';
            $mess['info']="$file  file not exists";
            $mess['return']=false;
        }else{
        $ftp_server = $url;
        $ftp_user_name = $username;
        $ftp_user_pass = $passwd;
        // set up basic connection
        $conn_id = ftp_connect($ftp_server);//连接ftp服务器
        if ($conn_id === FALSE) {
            $mess['type']='error';
            $mess['info']="There connect is error while uploading  $file to $url ";
            $mess['return']=false;
        } else {
            $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);//登录ftp服务器
            if($login_result){
                if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {//上传是否成功
                    $mess['type']='info';
                    $mess['info']="uploadd $file success to $url";
                    $mess['return']=true;
                    }else{
                    $mess['type']='error';
                    $mess['info']="There was a problem while uploading  $file to $url";
                    $mess['return']=false;
            }
            }else{
                $mess['type']='error';
                $mess['info']="There  login is error while uploading  $file to $url";
                $mess['return']=false;
            } 
        } ftp_close($conn_id);
        }
       
        log_message($mess['type'],$mess['info']);
        return $mess['return'];
    }
}