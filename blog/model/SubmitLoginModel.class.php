<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-02 22:40:31
 */
require_once 'ModelBase.class.php';
require_once DIR . "/dao/DaoUser.class.php";
class SubmitLoginModel extends ModelBase {
    
    //执行逻辑
    public  function preform(){
    	$DaoUser = new DaoUser();
    	$ret = $DaoUser->getUserInfoByUsernameAndPassWord($this->params['safe']['user_name'],$this->params['safe']['password']);
    	if(empty($ret)){
    		throw new Exception('error_login',1);
    	}
        $this->result['data'] = $ret[0];
    }


	//检测参数
    public function checkparams(){
    	if(empty($this->params['safe']['user_name'])){
    		throw new Exception("error_name", 1);
    	}

    }
}