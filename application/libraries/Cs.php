<?php
/**
 * cs.php文件
 * ==============================================
 * cloudstack API 调用
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: gaoxu
 * @date: 2015-4-22
 * @version: v1.0.0
 * @email gao_xu@126.com
 */
class Cs{
	/**
	 * cloudstack API 地址
	 * @access public $baseUrl
	 * @var string
	 */
	public $baseUrl='';
	/**
	 * APIkey
	 * @access public $apiKey
	 * @var string
	 */
	public $apiKey='';
	/**
	 * secretKey
	 * @access public $secretKey
	 * @var string
	 */
	public $secretKey='';
	/**
	 * 
	 * @func: 构造函数
	 * @date: 2015-4-22
	 * @author: gaoxu
	 * @param array $data
	 * @return: return_type
	 */
	private $_CI;
	public function __construct($data){
		$this->baseUrl = $data['baseUrl'];
		$this->apiKey = $data['apiKey'];
		$this->secretKey = $data['secretKey'];
		$this->_CI = & get_instance();
	}
	/**
	 * @notes :获取url签名
	 * @param array $data
	 * @return string
	 */
	public function getSignatureUrl($data) {
		ksort ( $data );
		$str1 = '';
		$str = '';
		if (is_array ( $data )) {
			foreach ( $data as $key => $value ) {
				if ($value != '') {
					$str1 .= $key . "=" . $value . "&";
					$str .= strtolower ( $key . "=" . $value . "&" );
				}
			}
			$str1 = substr ( $str1, 0, (strlen ( $str1 ) - 1) );
			$str = substr ( $str, 0, (strlen ( $str ) - 1) );
		}
		$secretkey = $this->secretKey;
		$hash = urlencode ( base64_encode ( hash_hmac ( "SHA1", $str, $secretkey, TRUE ) ) );
		return $url = $this->baseUrl . $str1 . "&signature=" . $hash;
	}
	/**
	 * @notes :利用curl的get方法获取返回值
	 *
	 * @param string $url
	 * @param string $cookie
	 * @return object&array
	 */
	public function curlGet($url, $cookie = '') {
		$ch = curl_init ();
		$timeout = 3;
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_COOKIEJAR, $cookie );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		$file_contents = curl_exec ( $ch );
		$error=curl_error($ch);
		curl_close ( $ch );
		if(!$file_contents){
		    log_message('error',$url.$error);
		}
		log_message('info', $file_contents);
		return $file_contents;
	}
	/**
	 * 传入的数据转化为数组
	 *
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
	 * 
	 * @func: unset数组值为空的项
	 * @date: 2015-4-22
	 * @author: gaoxu
	 * @param unknowtype
	 * @return: unknown|boolean
	 */
	public function check_array($data=array()){
		if(!empty($data)){
			foreach ($data as $key=>$value){
				if(empty($value)){
					unset($data[$key]);
				}
			}
			return $data;
		}else{
			return false;
		}
	}
	/**
	 * Virtual Machine
	 */
	/**
	 * Creates and automatically starts a virtual machine based on a service offering, disk offering, and template
	 *
	 * @param string $serviceofferingid
	 * @param string $templateid
	 * @param string $zoneid
	 * @return object return
	 */
	public function deployVirtualMachine($serviceofferingid, $templateid, $zoneid) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "deployVirtualMachine",
				"response" => "json",
				"templateid" => $templateid,
				"zoneid" => $zoneid,
				"serviceofferingid" => $serviceofferingid
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * List the virtual machines owned by the account
	 *
	 * @return object&array
	 */
	public function listVirtualMachines() {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "listVirtualMachines",
				"response" => "json"
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Destroys a virtual machine.
	 * Once destroyed, only the administrator can recover it.
	 *
	 * @param string $id
	 * @return object&array
	 */
	public function destroyVirtualMachine($id) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "destroyVirtualMachine",
				"response" => "json",
				"id" => $id
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Reboots a virtual machine
	 *
	 * @param string $id
	 * @return object&array
	 */
	public function rebootVirtualMachine($id) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "rebootVirtualMachine",
				"response" => "json",
				"id" => $id
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Starts a virtual machine.
	 *
	 * @param string $id
	 * @return object&array
	 */
	public function startVirtualMachine($id) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "startVirtualMachine",
				"response" => "json",
				"id" => $id
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Stop a virtual machine.
	 *
	 * @param string $id
	 * @return object&array
	 */
	public function stopVirtualMachine($id) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "stopVirtualMachine",
				"response" => "json",
				"id" => $id
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Returns an encrypted password for the VM
	 *
	 * @param string $id
	 * @return object&array
	 */
	public function getVMPassword($id) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "getVMPassword",
				"response" => "json",
				"id" => $id
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Snapshot
	 */
	/**
	 * Creates snapshot for a vm.
	 *
	 * @param string $virtualmachineid
	 */
	public function createVMSnapshot($virtualmachineid) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "createVMSnapshot",
				"response" => "json",
				"virtualmachineid" => $virtualmachineid
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Deletes a vmsnapshot.
	 *
	 * @param string $vmsnapshotid
	 */
	public function deleteVMSnapshot($vmsnapshotid) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "deleteVMSnapshot",
				"response" => "json",
				"vmsnapshotid" => $vmsnapshotid
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Creates an instant snapshot of a volume.
	 * @param unknown $volumeid
	 * @return Ambigous <object&array, mixed>
	 */
	public function createSnapshot($volumeid){
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "createSnapshot",
				"response" => "json",
				"volumeid" => $volumeid
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	public function listSnapshots(){
		$data = array (
				"apiKey" =>  $this->apiKey,
				"command" => "listSnapshots",
				"response" => "json"
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Zone
	 */
	/**
	 * Lists zones
	 *
	 * @return object&array
	 */
	public function listZones() {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "listZones",
				"response" => "json"
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	
	/*
	 * templates
	*/
	
	/**
	 * List all public, private, and privileged templates.
	 *
	 * @param string $templatefilter
	 * @return Ambigous <object&array, mixed>
	 */
	public function listTemplates($templatefilter) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "listTemplates",
				"response" => "json",
				"templatefilter" => $templatefilter
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Creates a template of a virtual machine.
	 * The virtual machine must be in a STOPPED state.
	 * A template created from this command is automatically designated as a private template
	 * visible to the account that created it.
	 *
	 * @param spring $displaytext
	 * @param spring $name
	 * @param spring $ostypeid
	 * @param string $volumeid
	 * @return Ambigous <object&array, mixed>
	 */
	public function createTemplate($displaytext, $name, $ostypeid,$volumeid='') {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "createTemplate",
				"response" => "json",
				"displaytext" => $displaytext,
				"name" => $name,
				"ostypeid" => $ostypeid,
		        "passwordenabled"=>'true',
		         "ispublic"=>'true',
		        "volumeid"=>$volumeid
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Deletes a template from the system.
	 * All virtual machines using the deleted template will not be affected.
	 *
	 * @param unknown $id
	 *        	the ID of the template
	 * @return Ambigous <object&array, mixed>
	 */
	public function deleteTemplate($id) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "deleteTemplate",
				"response" => "json",
				"id" => $id
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	
	/*
	 * Service Offering
	*/
	
	/**
	 * Lists all available service offerings
	 *
	 * @return Ambigous <object&array, mixed>
	 */
	public function listServiceOfferings() {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "listServiceOfferings",
				"response" => "json"
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Creates a service offering.
	 *
	 * @param unknown $displaytext
	 * @param unknown $name
	 * @return Ambigous <object&array, mixed>
	 */
	public function createServiceOffering($displaytext, $name) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "createServiceOffering",
				"response" => "json",
				"name" => $name,
				"displaytext" => $displaytext
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Deletes a service offering.
	 *
	 * @param unknown $id	the ID of the service offering
	 */
	public function deleteServiceOffering($id) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "deleteServiceOffering",
				"response" => "json",
				"id" => $id
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/*
	 * Guest OS
	*/
	/**
	 * Lists all supported OS types for this cloud.
	 */
	public  function listOsTypes(){
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "listOsTypes",
				"response" => "json"
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Add a new guest OS type
	 * @param unknown $oscategoryid	//ID of Guest OS category
	 * @param unknown $osdisplayname	//Unique display name for Guest OS
	 */
	public function addGuestOs($oscategoryid,$osdisplayname) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "addGuestOs",
				"response" => "json",
				"oscategoryid" => $oscategoryid,
				"osdisplayname"=>$osdisplayname
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/*
	 * Async job
	*/
	/**
	 * Retrieves the current status of asynchronous job
	 * @param string $jobid
	 * @return Ambigous <object&array, mixed>
	 */
	public function queryAsyncJobResult($jobid) {
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "queryAsyncJobResult",
				"response" => "json",
				"jobid"=>$jobid
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Volume
	 */
	/**
	 * Lists all volumes.
	 * @return Ambigous <object&array, mixed>
	 */
	public function listVolumes($virtualmachineid){
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "listVolumes",
				"response" => "json",
		          "keyword"=>'ROOT',
		        "virtualmachineid"=>$virtualmachineid
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	/**
	 * Disk Offering
	 * listDiskOfferings
	 */
	public function listDiskOfferings(){
		$data = array (
				"apiKey" => $this->apiKey,
				"command" => "listDiskOfferings",
				"response" => "json"
		);
		$url = $this->getSignatureUrl ( $data );
		return $this->curlGet ( $url );
	}
	}