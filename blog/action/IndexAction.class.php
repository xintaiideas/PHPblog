<?php
/**
 * 
 * @authors Black
 * @date    2015-03-21 16:18:28
 */

require_once 'ActionBase.class.php';
require_once DIR . "/model/IndexModel.class.php";

class index extends ActionBase {
	
    public function action(){
    	//页面展示
    	$IndexModel = new IndexModel();
    	$result = $IndexModel->getResult();

        $this->tpl->assign($result);
    	$this->tpl->display('index.tpl');
    }
}