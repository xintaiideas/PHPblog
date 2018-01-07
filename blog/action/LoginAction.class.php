<?php
/**
 * 登陆action
 * @authors black(you@example.org)
 * @date    2015-04-02 21:23:40
 */

require_once 'ActionBase.class.php';
require_once DIR . "/model/LoginModel.class.php";
class Login extends ActionBase {
	
    public function action(){
    	//页面展示
    	$model = new LoginModel();
    	$result = $model->getResult();
    	
    	$tplVar = array(    			
    			'params'=>$result['params'],
    	);
    	$this->tpl->assign($tplVar);
    	$this->tpl->display('login.tpl');
    }
}