<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-02 22:36:56
 */

require_once 'ActionBase.class.php';
require_once DIR . "/model/SubmitLoginModel.class.php";
require_once DIR . "/lib/User.class.php";
class SubmitLogin extends ActionBase {
	
    public function action(){
    	//页面展示
    	$model = new SubmitLoginModel();
    	$result = $model->getResult();
       
    	$result['params']['safe']['action'] = 'login';
    	if($result['code'] == 1){
    		$tplVar = array(
    			$result['error_msg'] => 1,
    			'params'=>$result['params'],
    			);
    		
    		$this->tpl->assign($tplVar);
    		$this->tpl->display('login.tpl');
    	}else{
            //登录状态的维持
            $userInfo['user_id'] = $result['data']['user_id'];
            $userInfo['nick_name'] = $result['data']['nick_name'];
            User::_setUserInfo($userInfo);
            header('Location: http://localhost/blog/');
        }
    }
}