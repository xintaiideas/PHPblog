<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-03 20:28:16
 */

require_once 'ActionBase.class.php';
class Registered extends ActionBase {
	
    public function action(){

    	//页面展示
    	$result['params']['safe']['action'] = 'login';

    	$tplVar = array(    			
    		'params'=>$result['params'],
    	);
    	$this->tpl->assign($tplVar);
    	$this->tpl->display('registered.tpl');

    }
}