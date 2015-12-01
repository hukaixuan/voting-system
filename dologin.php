<?php 
//登录验证
require_once('fns.php');

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username&&$password) {
	try {
		login($username, $password);
		$_SESSION['username'] = $username;
	} catch (Exception $e) {
		//未能成功登录
		do_html_header('problem');
		echo '登录失败，请重试';
		do_html_URL('index.php','Login');
		do_html_footer();
		exit;
	}
}

//登录成功,跳转到user_main.php
header('Location:user_main.php');l

 ?>