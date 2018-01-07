<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-04-06 18:17:15
 */
session_start(); 
class User{
	public static function _setUserInfo($userInfo){
		$_SESSION['user_id'] = $userInfo['user_id'];
		$_SESSION['nick_name'] = $userInfo['nick_name'];
	}
	public static function _getUserInfo(){
		if(empty($_SESSION)) return false;
		$userInfo['user_id'] = $_SESSION['user_id'];
		$userInfo['nick_name'] = $_SESSION['nick_name'];
		return $userInfo;
	}
}
 