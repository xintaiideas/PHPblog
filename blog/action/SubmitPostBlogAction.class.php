<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-02 22:36:56
 */

require_once 'ActionBase.class.php';
require_once DIR . "/model/SubmitPostBlogModel.class.php";

class SubmitPostBlog extends ActionBase {
	
    public function action(){
    	//页面展示
    	$model = new SubmitLoginModel();
    	$result = $model->getResult($this->user_info);
       
    	$result['params']['safe']['action'] = 'myblog';
        $this->tpl->assign($result);
        if($this->result['code'] == 0){
            header('Location: http://localhost/blog/?action=myblog');
        }
        // $this->tpl->display('post.tpl');
    }
}