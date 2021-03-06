<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-03 20:56:59
 */
require_once 'ModelBase.class.php';
require_once DIR . "/dao/DaoBlog.class.php";
require_once DIR . "/dao/DaoComment.class.php";
require_once DIR . "/dao/DaoUser.class.php";
class BlogInfoModel extends ModelBase {
    public $blog_type = array(
        1=>"历史迷雾",
        2=>'个人心路',
        3=>'技术控',
        4=>'学习心得'
    );
    //执行逻辑
    public  function preform(){
        $DaoBlog = new DaoBlog();
        $ret = $DaoBlog->getBlogByID($this->params['safe']['id']);
        $blogInfo = $ret['0'];
        $blogInfo = $this->formartBlog($blogInfo);
        if(!empty($blogInfo)){
            $this->result['data']['blogInfo'] = $blogInfo;
            $this->result['data']['is_login'] = !empty($this->user_info)? 1 : 0;
            $this->result['data']['self'] = $blogInfo['user_id'] == $this->user_info['user_id'] ? 1 : 0;
        }else{
             throw new Exception("blogInfo error", 1);
        }

        $DaoComment = new DaoComment();
        $comment = $DaoComment->getCommentByBlogID($blogInfo['id']);
        $comment = $this->formartComment($comment);
        
        $this->result['data']['comment'] = $comment;

    }

    //检测参数
    public function checkparams(){
        if(empty($this->params['safe']['id'])){
            throw new Exception("error_id", 1);
        }
     }

    private function formartBlog($blogInfo){
        if(empty($blogInfo)) return false;
        $blogInfo['blog_type'] = $this->blog_type[$blogInfo['blog_type']];
        $blogInfo['create_time'] = date('Y-m-d H:i:s' ,$blogInfo['create_time']);
        return $blogInfo;
    }

    private function formartComment($comment){
        if(empty($comment)) return false;
        $DaoUser = new DaoUser();
        foreach ($comment as $key => $value) {
            $comment[$key]['create_time'] = date("Y-m-d H:i:s",$value['create_time']);
            
            $user_info = $DaoUser->getUserInfoByUserId($value['user_id']);
            $comment[$key]['user_info'] = $user_info[0];
        }
        return $comment;
    }
}