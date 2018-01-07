<?php
require_once 'DaoBase.class.php';
class DaoUser extends DaoBase {
	protected $table_name = "user";

	public function getUserInfoByUsernameAndPassWord($user_name,$password){
		$filed = array('user_id','nick_name');
		$where = array('user_name = ' => $user_name,
					   'password = ' => md5($password)
				);
		return $this->select($filed,$where);
	}

	public function getUserInfoByUserId($user_id){
		$filed = array('user_id','nick_name');
		$where = array('user_id = ' => $user_id,
					'is_deleted = ' => 0,
				);
		return $this->select($filed,$where);
	}
	public function addUser($data){
		return $this->insert($data);
	}

	public function getUser(){
		$filed = array('user_id','nick_name','tips');
		$where = array('is_deleted = ' => 0);
		$endWith = " order by create_time desc limit 5";
		return $this->select($filed,$where,$endWith);
	}
}