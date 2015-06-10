<?php
class Sql{
    private $_CI;
    public function __construct(){
        $this->_CI=&get_instance();
        $this->_CI->load->database();
    }
   /**
    * 模糊查询
    * @param string $table 表名称
    * @param string $key 字段名称
    * @param string $value 查找的内容
    * @return boolean
    */
    public function fuzzy_query($table='',$key='',$value=''){
        $mess=array();
         if($this->_exist_table($table)){
             $this->db->from($table);
             $this->db->where($key,'%'.$value.'%',false);
             $query=$this->db->get();
             if($query){
                 $res=$query->result_array();
                 $mess['return']=$res;
                 $mess['info']='check '.$table.' '.$key.'='.$value.' is success';
                 $mess['type']='info';
             }else{
                 $res=$query->result_array();
                 $mess['return']=$res;
                 $mess['info']='check '.$table.' '.$key.'='.$value.' is error '.mysql_error();
                 $mess['type']='error';
             }
         }else{
            $mess['return']=false;
            $mess['info']=$table.' is not exist';
            $mess['type']='error';
         }
         log_message($mess['type'], $mess['info']);
         return $mess['return'];
    }
    /**
     * 检查是否存在表
     * @param string $table 表名称
     */
    private function _exist_table($table=''){
        return $this->_CI->db->table_exists($table);
    }
}