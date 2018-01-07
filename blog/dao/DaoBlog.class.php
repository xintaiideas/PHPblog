<?php
require_once 'DaoBase.class.php';
class DaoBlog extends DaoBase {
	protected $table_name = "blog";
	

	public function insertBlog($data){
		return $this->insert($data);
	}

	public function getUserBlogListByUserId($user_id){
		$filed = array(
			'id',
			'title',
			'blog_type',
			'show',
			'blog',
			'user_id',
			'create_time',
			);
		$where = array('user_id = ' => $user_id,
					   'is_deleted = ' => 0,
				);
		$endWith = " order by create_time desc";
		return $this->select($filed,$where,$endWith);
	}

	public function getBlogByID($id){
		$filed = array(
			'id',
			'title',
			'blog_type',
			'show',
			'blog',
			'user_id',
			'create_time',
			);
		$where = array('id = ' => $id,
					   'is_deleted = ' => 0,
				);
		return $this->select($filed,$where,$endWith);
	}

	public function updateBlog($data,$where){
		return $this->update($data,$where);
	}

	public function getBlogList(){
		$filed = array(
			'id',
			'title',
			'blog_type',
			'show',
			'blog',
			'user_id',
			'create_time',
			);
		$where = array('is_deleted = ' => 0);
		$endWith = " order by create_time desc";
		return $this->select($filed,$where,$endWith);
	}

	//delete blog
	public function deleteBlog($where){
		return $this->delete($where);
	}
}