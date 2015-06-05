<?php

class Cloud_mdl extends CI_Model
{

    /**
     * 构造函数
     */
    private $_Adog_url;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('job_mdl');
        $this->load->model('vm_mdl');
        $this->_Adog_url = $this->config->item('adog_url');
    }

    /**
     *
     *
     *
     * @func:加载cloudstackAPI
     * @date: 2015-4-24
     *
     * @author : gaoxu
     * @param int $zoneid
     *            //数据中心id
     * @return : Ambigous <boolean, string>
     */
    private function _load_cloud($zoneid = 1, $cloud_id = 1, $type = false)
    {
        $mess = array();
        if (! is_numeric($zoneid)) {
            $mess['return'] = false;
            $mess['info'] = '_load_cloud $zoneid is not num';
            $mess['type'] = 'info';
        } else {
            if ($type) {
                $sql = 'select c.col_apikey,c.col_seckey,c.col_url from cloud c where col_id=' . $cloud_id;
            } else {
                $sql = 'select c.col_apikey,c.col_seckey,c.col_url from cloud c,cloud_zone cz,cloud_region cr where cz.col_id=' . $zoneid . ' and cz.col_region_id = cr.col_id and cr.col_cloud_id = c.col_id';
            }
            $query = $this->db->query($sql);
            if ($query) {
                $res = $query->result_array();
                $data = array(
                    'baseUrl' => $res['0']['col_url'],
                    'apiKey' => $res['0']['col_apikey'],
                    'secretKey' => $res['0']['col_seckey']
                );
                $this->load->library('cs', $data);
                $mess['return'] = true;
                $mess['type'] = 'info';
                $mess['info'] = '_load_cloud is success';
            } else {
                $mess['return'] = false;
                $mess['type'] = 'error';
                $mess['info'] = '_load_cloud query is error' . mysql_error();
            }
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }

    /**
     *
     *
     *
     * @func: 函数功能描述
     * @date: 2015-4-24
     *
     * @author : gaoxu
     * @param
     *            $template_id//模板id
     * @param
     *            $user_id//创建用户id
     * @return : return_type
     */
    public function vm_create($template_id = '', $user_id = '')
    {
        $mess = array();
        $res = $this->get_cloud_zone_id($template_id);
        if (! empty($res)) {
            $this->_load_cloud($res['0']['zone_id']);
            $cloud_res = $this->cs->object_array(json_decode($this->cs->deployVirtualMachine($res['0']['col_offering_id'], $res['0']['col_template_id'], $res['0']['col_zone_id'])));
            if ($cloud_res) {
                $cloud=$this->check_return($cloud_res);
                if ($cloud['id']) {
                    $arr = array(
                        'col_user_id' => $user_id,
                        'col_template_id' => $template_id,
                        'col_begin' => date('Y-m-d H:m:s'),
                        'col_status_code' => 'Starting',
                        'col_vm_id' => $cloud['id'],
                       'col_zone_id'=>$res[0]['zone_id'],
                       'col_offering_id'=>$res[0]['offering_id']
                    );
                    $vm_res = $this->vm_mdl->vm_create($arr);
                    $job_arr = array(
                        'col_job_id' => $cloud['jobid'],
                        'col_cloud_id' => $res['0']['cloud_id'],
                        'col_res_type' => $this->vm_mdl->showTable(),
                        'col_res_id' => $vm_res
                    );
                    $job_res = $this->job_mdl->job_create($job_arr);
                    $data = array(
                        "resourceType" => "vm",
                        "resourceId" => $cloud['id'],
                        "action" => "create",
                        "jobId" => $cloud['jobid']
                    );
                    $this->post_adog($data, 'create');
                    $mess['info'] = 'vm_create is success';
                    $mess['type'] = 'info';
                    $mess['return'] = $job_res;
                } else {
                    $mess['info'] = 'vm_create $cloud_res is error';
                    $mess['type'] = 'info';
                    $mess['return'] = false;
                }
            } else {
                $mess['info'] = 'vm_create cloudstack is error';
                $mess['type'] = 'error';
                $mess['return'] = false;
            }
        } else {
            $mess['info'] = 'vm_create $res is null ';
            $mess['type'] = 'info';
            $mess['return'] = false;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }

    /**
     *
     * @func: job查询
     * @date: 2015-4-25
     * 
     * @author : gaoxu
     * @param
     *            int
     * @return : Ambigous <string, boolean, unknown>
     */
    public function select_job($job_id)
    {
        $mess = array();
        if (! empty($job_id) && is_numeric($job_id)) {
            $res = $this->job_mdl->get_job_by_id($job_id);
            if ($this->_load_cloud($res['col_cloud_id'])) {
                $job_res = $this->cs->object_array(json_decode($this->cs->queryAsyncJobResult($res['col_job_id'])));
                $mess['return'] = $job_res;
                $mess['type'] = 'info';
                $mess['info'] = 'select_job  $job_id is success';
            } else {
                $mess['return'] = false;
                $mess['type'] = 'error';
                $mess['info'] = 'select_job _load_cloud is error';
            }
        } else {
            $mess['return'] = false;
            $mess['type'] = 'info';
            $mess['info'] = 'select_job  $job_id is null or is not number';
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }

    /**
     *
     * @func: vm的操作，重启，开机，关机，销毁
     * @date: 2015-4-25
     *
     * @author : gaoxu
     * @param
     *            $vm_id
     * @param $type //操作类型            
     * @return : Ambigous <string, boolean, unknown>
     */
    public function vm_operate($vm_id = '', $type = '')
    {
        $action = array(
            'reboot' => 'Stopping',
            'start' => 'Starting',
            'poweroff' => 'Stopping',
            'delete' => 'Expunging'
        );
        $status_code = $action[$type];
        $mess = array();
        $res = $this->vm_mdl->get_vm_by_id($vm_id);
        if ($res && ! empty($res)) {
            $vmId = $res['0']['col_vm_id'];
            $zoneId = $res['0']['col_zone_id'];
            $sql = 'select c.col_id from cloud c,cloud_zone cz,cloud_region cr where cz.col_id=' . $zoneId . ' and cz.col_region_id=cr.col_id and cr.col_cloud_id=c.col_id';
            $query = $this->db->query($sql);
            $res = $query->result_array();
            $cloud_id = $res[0]['col_id'];
            if ($this->_load_cloud($zoneId)) {
                $vm_res = $this->choose_fun($type, $vmId);
                $vm_result=$this->check_return($vm_res);
                if ($vm_result['jobid']) {
                    $job_arr = array(
                        'col_job_id' => $vm_result['jobid'],
                        'col_cloud_id' => $cloud_id,
                        'col_res_type' => $this->vm_mdl->showTable(),
                        'col_res_id' => $vmId
                    );
                    $data = array(
                        "resourceType" => "vm",
                        "resourceId" => $vmId,
                        "action" => "$type",
                        "jobId" => $vm_result['jobid']
                    );
                    $this->post_adog($data, $type);
                    $this->vm_mdl->vm_update($vm_id, array(
                        'col_status_code' => $status_code
                    ));
                    $job_res = $this->job_mdl->job_create($job_arr);
                    $mess['info'] = 'vm_' . $type . '  is success';
                    $mess['type'] = 'info';
                    $mess['return'] = $job_res;
                
                } else {
                    $mess['info'] = 'vm_' . $type . ' ' . $type . ' connect is error';
                    $mess['type'] = 'error';
                    $mess['return'] = false;
                }
            } else {
                $mess['info'] = 'vm_' . $type . ' _load_cloud is error ';
                $mess['type'] = 'error';
                $mess['return'] = false;
            }
        } else {
            $mess['info'] = 'vm_' . $type . '  vm not found ';
            $mess['type'] = 'error';
            $mess['return'] = false;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }

    public function set_gateway($vm_id = '')
    {
        $mess = array();
       
        if (! empty($vm_id) && is_numeric($vm_id)) {
            $this->set_vm($vm_id); // 预先配置好vm,后期更改
            $this->db->select('u.col_nickname as col_name,vm.col_outer_ip as col_ip,vm.col_outer_port as col_port,vm.col_user,vm.col_passwd,vm.col_protocal');
            $this->db->from(array(
                'user u',
                'vm vm'
            ));
            $this->db->where("vm.col_id", $vm_id);
            $this->db->where("vm.col_user_id", "u.col_id", FALSE);
            $query = $this->db->get();
            $res = $query->result_array();
            $res = $res[0];
            $this->load->library('common');
            $name = $res['col_name'] . $this->common->guid();
            $setdata = array(
                "parentIdentifier" => "ROOT",
                "name" => $name,
                "protocol" => strtolower($res['col_protocal']),
                "parameters" => array(
                    "hostname" => $res['col_ip'],
                    'port' => $res['col_port'],
                    'password' => $res['col_passwd'],
                    'username' => $res['col_user']
                )
            ); // post guacamole data
               // log_message('debug',$setdata['parameters']['password']);
            $result=$this->post_guaca($vm_id, $setdata); // post网关信息配置.
            $mess['info']='set_geteway is success'.$result;
            $mess['type']='info';
            $mess['return']=true;
        } else {
            $mess['info'] = 'set_gateway is error $vm_id is not number or $vim is null';
            $mess['type'] = 'info';
            $mess['return'] = true;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }

    /**
     * 配置虚拟机信息
     * 
     * @param string $vm_id            
     * @return unknown
     */
    public function set_vm($vm_id = '')
    {
        $this->load->model('vm_mdl');
        $data = array(
            'col_gateway_id' => 1,
            'col_user' => 'administrator',
            'col_passwd' => 'Admin@123',
            'col_protocal' => 'RDP'
        );
        $res = $this->vm_mdl->vm_update($vm_id, $data);
        return $res;
    }

    /**
     * 选择执行函数
     * @param unknown $type            
     * @param unknown $vmId//虚拟机的类型            
     * @return multitype:
     */
    public function choose_fun($type, $vmId)
    {
        $mess = array();
        $action = array(
            'reboot' => 'Stopping',
            'start' => 'Starting',
            'poweroff' => 'Stopping',
            'delete' => 'Expunging'
        );
        if (array_key_exists($type, $action)) {
            $vm_res = array();
            switch ($type) {
                case 'reboot':
                    $vm_res = $this->cs->object_array(json_decode($this->cs->rebootVirtualMachine($vmId)));
                    break;
                case 'start':
                    $vm_res = $this->cs->object_array(json_decode($this->cs->startVirtualMachine($vmId)));
                    break;
                case 'poweroff':
                    $vm_res = $this->cs->object_array(json_decode($this->cs->stopVirtualMachine($vmId)));
                    break;
                case 'delete':
                    $vm_res = $this->cs->object_array(json_decode($this->cs->destroyVirtualMachine($vmId)));
                    break;
                default:
                    $vm_res = array();
                    break;
            }
            $mess['return'] = $vm_res;
            $mess['info'] = 'vm_operate choose_type is success';
            $mess['type'] = 'info';
        } else {
            $mess['info'] = 'vm_operate $type  not exists';
            $mess['type'] = 'error';
            $mess['return'] = false;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }
    /**
     * 创建模板
     * @param unknown $vm_id
     * @param unknown $user_id
     * @param unknown $script_id
     */
     public function template_create($vm_id,$user_id,$script_id){
         $mess = array();
         $vm_res = $this->vm_mdl->get_vm_by_id($vm_id);
         if(empty($vm_res)){
             $mess['type']='info';
             $mess['info']='template_create $vm_id is null';
             $mess['return']=false;
         }else{
             $this->_load_cloud($vm_res[0]['col_zone_id']);
             $cloud_res=$this->cs->object_array(json_decode($this->cs->listVolumes($vm_res[0]['col_vm_id'])));
             if(empty($cloud_res)){
                 
             }else{
                 $ostypeid=$this->config->item('ostypeid');
                 $name=uniqid();
                 log_message('debug', 'template_name'.$name);
                 $displaytext=$this->common->guid();log_message('debug', 'template_display'.$displaytext);
                 $ostype_id=$this->config->item('ostype_id');
                 $volumeid=$this->arr_foreach($cloud_res, 'id');
                 $template_res=$this->cs->object_array(json_decode($this->cs->createTemplate($displaytext, $name, $ostypeid,$volumeid)));
                 $res=$this->check_return($template_res);
                 if($res['id']){
                     $arr = array(
                         'col_template_id'=>$res['id'],
                         'col_zone_id'=>$vm_res['0']['col_zone_id'],
                         'col_ostype_id'=>$ostype_id,
                         'col_user_id'=>$user_id,
                         'col_type'=>'USER',
                         'col_status_code'=>'Starting'
                     );
                    $this->load->model('template_mdl');
                    $tem_res=$this->template_mdl->create_template($arr);
                     $job_arr = array(
                         'col_job_id' => $res['jobid'],
                         'col_res_type' => $this->template_mdl->showTable(),
                         'col_res_id' => $tem_res
                     );
                     $job_res = $this->job_mdl->job_create($job_arr);
                     $data = array(
                         "resourceType" => "template",
                         "resourceId" => $res['id'],
                         "action" => "create",
                         "jobId" => $res['jobid']
                     );
                     $tem_scr=array('col_template'=>$tem_res,'col_script_id'=>$script_id);
                     $this->load->model('script_template_mdl');
                     $this->script_template_mdl->create_scr_tem($tem_scr);//填写map表
                     $this->post_adog($data, 'create');
                     $mess['type']='info';
                     $mess['info']='create_template is success';
                     $mess['return'] =$job_res;
                 }elseif($res['errorcode']){
                    $mess['info']='create_template cloudstack is error '.$res['errorcode'];
                    $mess['type']='error';
                    $mess['return']=false;
                 }else{
                     $mess['info']='create_template cloudstack is error ';
                     $mess['type']='error';
                     $mess['return']=false;
                 }
             }
         }
         log_message($mess['type'], $mess['info']);
         return $mess['return'];
     }

    /**
     * 发送数据给adog,开始轮询
     * 
     * @param unknown $data//发送的数据,数组            
     * @param unknown $type//操作类型            
     */
    public function post_adog($data, $type)
    {
        $this->load->library('common');
        $url = $this->_Adog_url;
        $adog = $this->common->curl_client($this->_Adog_url, $data, 'POST'); // 请求adog刷新状态
        if ($this->common->is_not_json($adog)) {
            log_message('info', 'vm_operate ' . $type . ' post adog is error');
        } else {
            $status = $this->common->object_array($adog);
            log_message('info', 'vm_operate ' . $type . ' post adog is' .(string)$status);
        }
    }
    /**
     * 根据template_id查出创建vm所需的信息
     * @param unknown $template_id
     * @return Ambigous <boolean, NULL>
     */
    public function get_cloud_zone_id($template_id)
    {
        $mess = array();
        $this->db->select('ct.col_template_id ,cz.col_zone_id,co.col_offering_id,co.col_id as offering_id,cz.col_id as zone_id,c.col_id as cloud_id');
        $this->db->from(array(
            'cloud_template ct',
            'cloud_zone cz',
            'cloud_region cr',
            'cloud c',
            'template_offering_map tom',
            'cloud_offering co'
        ));
        $this->db->where('ct.col_id', $template_id);
        $this->db->where('ct.col_type', 'USER');
        $this->db->where('ct.col_zone_id', 'cz.col_id', false);
        $this->db->where('cz.col_region_id', 'cr.col_id', false);
        $this->db->where('cr.col_cloud_id', 'c.col_id', false);
        $this->db->where('ct.col_id', 'tom.col_template_id', false);
        $this->db->where('tom.col_offering_id', 'co.col_id', false);
        $query = $this->db->get();
        if ($query) {
            log_message('debug', (string)$this->db->last_query());
            $mess['return'] = $query->result_array();
        } else {
            $mess['return'] = false;
        }
        return $mess['return'];
    }

    /**
     * 发送数据到网关
     * 
     * @param int $vm_id            
     * @param array $data            
     * @return boolean
     */
    public function post_guaca($vm_id, $data)
    {
        $url = $this->config->item('guaca_url');
        $this->load->library('common');
        $guaca_res = $this->common->curl_client($url, $data, 'POST');
        if (is_numeric($guaca_res)) {
            $this->vm_mdl->vm_update($vm_id, array(
                'col_connection_id' => $guaca_res
            ));
            $mess['info'] = 'set_gateway is success';
            $mess['type'] = 'info';
            $mess['return'] = true;
        } else {
            $mess['info'] = 'set_gateway is error' .$guaca_res;
            $mess['type'] = 'info';
            $mess['return'] = FALSE;
        }
        log_message($mess['type'], $mess['info']);
        return $mess['return'];
    }

    /**
     * 判断返回值并进行下一步
     * 
     * @param unknown $cloud_res            
     * @return array
     */
    public function check_return($cloud_res)
    {
        $mess = array(); // 日志信息
        $res = array(); // 返回数组
        $res['jobid'] = $this->arr_foreach($cloud_res, 'jobid');
        $res['id'] = $this->arr_foreach($cloud_res, 'id');
        $res['errorcode'] = $this->arr_foreach($cloud_res, 'errorcode');
        if ($res['id']) {
            $mess['info']='cheak_return id is'.$res['id'];
            $mess['type']='info';
        } elseif ($res['errorcode']) {
            $mess['error']='cheak_return cloudstack is error errorcode='.$mess['errorcode'];
        }
        return $res;
    }

    /**
     * 多维数组查找键值=$search的value
     * 
     * @param array $arr            
     * @param
     *            $search
     * @return boolean|Ambigous <boolean, unknown>
     */
    public function arr_foreach($arr, $search)
    {
        if (! is_array($arr)) {
            return false;
        }
        foreach ($arr as $key => $value) {
            if ($search === $key) {
                $res = $value;
                return $res;
            } elseif (is_array($value)) {
                return $this->arr_foreach($value, $search);
            }
        }
    }
}

