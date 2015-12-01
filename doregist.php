<?php 
require_once('fns.php');
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];

session_start();

try {
	//验证所填项目是否为空，；以后做到前台！！！！
	if (  !filled_out($username)||!filled_out($email)  ) {
		throw new Exception('有表单项未填，请返回重试');
	}	
	//验证两次所填密码是否一致
	if ( $password != $password2 ) {
		throw new Exception('密码不一致');
	}
	//判断密码长度是否合理
	if ( (strlen($password)<6)||(strlen($password)>16 ) ) {
		throw new Exception('密码必须在6-16个字符之间');
	}
	//验证邮箱
	if ( !valid_email($email)) {
		throw new Exception("邮箱不合法");
	}
	
	//尝试 注册
	register($username,$email,$password);
	$_SESSION['valid_user'] = $username;
	//登录成功显示页面
	do_html_header('Registration successful');
	echo "注册成功，";
	do_html_URL('index.php','立即登录');
	do_html_footer();

} catch (Exception $e) {
	do_html_header('Problem');
	echo $e->getMessage();
	do_html_footer();
	exit;
}

 ?>