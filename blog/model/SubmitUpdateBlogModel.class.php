<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-03 20:56:59
 */
require_once 'ModelBase.class.php';
require_once DIR . "/dao/DaoBlog.class.php";
class SubmitUpdateBlogModel extends ModelBase {
    public $blog_type = array(
        1=>"历史迷雾",
        2=>'个人心路',
        3=>'技术控',
        4=>'学习心得'
    );
    //执行逻辑
    public  function preform(){
        $blogData = $this->params['safe'];
        $blogData['blog'] = $blogData['editorValue'];

        unset($blogData['action']);
        unset($blogData['editorValue']);
        unset($blogData['id']);
        
        $DaoBlog = new DaoBlog();
        $ret = $DaoBlog->updateBlog($blogData,array('id = '=> $this->params['safe']['id']));
        
        $this->result['code'] = $ret == true ? 0 : -1;
    }

    //检测参数
    public function checkparams(){

        if(empty($this->params['safe']['id'])){
            throw new Exception("error_id", 1);
        }
     }

}