<?php

//公共函数定义

function login(){
	
	header('Content-Type:text/html; charset=utf-8');//防止出现乱码
	
	if(!IS_POST)
		exit('请求错误');
		
	$userTable = M('Customer');
	
	$username = I('username');
	$passwd = I('password', '', 'md5');
	
	$user = $userTable->where(array('userid' => $username))->find();
	if(!$user || $user['passwd'] != $passwd) {
		echo '用户名或密码错误';
		exit;
	}
	
}

