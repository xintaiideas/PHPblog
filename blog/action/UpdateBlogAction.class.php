<?php
require_once 'ActionBase.class.php';
require_once DIR . "/model/UpdateBlogModel.class.php";

class UpdateBlog extends ActionBase {
	public $need_login = 1;
    public function action(){
        //页面展示
    	$UpdateBlogModel = new UpdateBlogModel();
    	$result = $UpdateBlogModel->getResult($this->user_info);
    	$result['params']['safe']['action'] = 'myblog';
    	$this->tpl->assign($result);
        $this->tpl->display('update.tpl');
    }
}