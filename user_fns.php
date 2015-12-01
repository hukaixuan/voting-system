<?php 
/**
**用户操作方法
**/
require_once('db_fns.php');
//用户注册方法
function register($username, $email, $password){
	$conn = db_connect();    //得到数据库连接对象
	//验证用户名是否已经存在，之后可以把他做到前台！！！！
	$result = $conn->query("select * from user where name='".$username."'");
	if (!$result) {
		throw new Exception('发生错误，不能执行sql语句');
	}
	if ($result->num_rows>0) {
		throw new Exception('用户名已存在，请返回重新选择');
	}

	//没有同名用户，则存入数据库
	//sha1(),计算字符串的散列值，用于加密
	$result = $conn->query("insert into user(name,password,email)  
		 values('".$username."',sha1('".$password."'),'".$email."')");
	if (!$result) {
		throw new Exception('注册失败，请重试');
	}

	return true;
}

//用户登录
//验证用户名、密码是否正确，验证成功返回true
function login($username,$password){
	$conn = db_connect();

	//验证用户是否存在
	$result = $conn->query("select * from user where name='".$username."' 
		  and password = sha1('".$password."')");
	if (!$result) {
	 	throw new Exception('登录失败');
	 }

	if ($result->num_rows>0) {
		return true;
	} else {
		throw new Exception("登录失败");
	}
}

//用户是否已经登录
function user_is_on(){
	session_start();
	if (isset($_SESSION['username'])) {
		return true;        //在线返回true
	} else {
		return false;
	}
}
//检查用户是否已经登录
function check_is_on(){
	if (user_is_on()) {
		return true;
	} else {
		header("Location: index.php" );
	}
	
}

//登出操作
function logout(){
	echo "logout";
	session_start();
	unset($_SESSION['username']);
	session_destroy();
	header('Location: index.php');
}

//根据用户名得到当前用户的id
function get_user_id($username){
	$conn = db_connect();
	$sql = "select id from user where name='".$username."'";
	$result = $conn->query($sql);
	if ( !$result ) {
		throw new Exception("取用户ID失败");
	}else{
		$row = $result->fetch_assoc();
		$id = $row['id'];
		return $id;
	}
}


 ?>









