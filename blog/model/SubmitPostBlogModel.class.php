<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-03 20:56:59
 */
require_once 'ModelBase.class.php';
require_once DIR . "/dao/DaoBlog.class.php";
class SubmitLoginModel extends ModelBase {

    //执行逻辑
    public  function preform(){
    	$insert = array();
        $insert['title'] = $this->params['safe']['title'];
        $insert['blog'] = $this->params['safe']['editorValue'];
        $insert['blog_type'] = $this->params['safe']['blog_type'];
        $insert['show'] = $this->params['safe']['show'];
        $insert['user_id'] = $this->user_info['user_id'];
        $insert['is_deleted'] = 0;
        $insert['create_time'] = time();
        $DaoBlog = new DaoBlog();
        $DaoBlog->insertBlog($insert);
        $this->result['code'] = $ret == true ? 0 : -1;

    }


	//检测参数
    public function checkparams(){
        if(empty($this->params['safe']['title'])){
            throw new Exception("error_name", 1);
        }
        $this->params['safe']['show'] = !empty($this->params['safe']['show']) ? $this->params['safe']['show'] : 0;
     }
}