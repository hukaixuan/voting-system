<?php 
session_start();
require_once('fns.php');
//添加投票问题业务逻辑
$de = $_POST['de'];
$mult = $_POST['mult'];
$opt = array();
$opt['A'] = $_POST['A'];
$opt['B'] = $_POST['B'];
$opt['C'] = $_POST['C'];
$opt['D'] = $_POST['D'];
$username = $_SESSION['username'];

try {
	$topic_id = add_topic($de,$mult);
	$user_id = get_user_id($username);
	//将添加问题的用户的用户id 和 问题的id添加到数据库
	add_user_topic($user_id,$topic_id);
	foreach ($opt as $key => $value) {
		if ( trim($value)!=''){       		//如果选项不为空串，才存入数据库
			$opt_id = add_opt($key,$value,$topic_id);
			//add_user_opt($user_id,$opt_id);
		}
	}
	
} catch (Exception $e) {
	do_html_header('problem');
	echo $e->getMessage();
	do_html_footer();
	exit;  //不再继续执行下面的语句
}
do_html_header('添加投票成功');
echo "添加投票成功";
do_html_URL('user_main.php','返回主界面');
do_html_footer();

 ?>