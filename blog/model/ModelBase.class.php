<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-03-21 17:19:33
 */

abstract class ModelBase {
	public $params;
	public $result;
    public $user_info;
    //检测参数
    public abstract function checkparams();
    //执行逻辑
    public abstract function preform();

    //执行器
    public function getResult($user_info = false){
        $this->user_info = $user_info;
        $this->getParams();
        $this->result = array(
            'code'=> 0,
            'error_msg' => '',
            'data' => '',
            'params' => $this->params,
            );
        
        try{
            $this->checkparams();
            $this->preform();
        }catch(Exception $e){
            $this->result['code'] = $e->getCode();
            $this->result['error_msg'] = $e->getMessage();
        }

        return $this->result;
    }

    public function getParams(){
    	$params = $_REQUEST;//get & post
        $arr = array();
        foreach ($params as $key => $value) {
            $arr['unsafe'][$key] = $value;//不安全
            $arr['safe'][$key] = addslashes($value);//安全
        }
        $this->params = $arr;
    }
}