<?php 
session_start();
require_once('fns.php');
//投票业务逻辑处理
//从投票页面得到的变量
$username = $_SESSION['username'];
$user_id = get_user_id($username);
$opt = $_POST;
foreach ($opt as $key => $value) {
	// echo $key." and ".$value."<br>";
	$topic_id = $key;
	$ABC = $value;
	if (!is_user_voted($user_id,$topic_id)) {
		vote($user_id,$topic_id);     //实现在user_topic表中添加项目，记录选票信息
		add_vote($topic_id,$ABC);   //在opt表中实现选票数的增加	
	} else {
		// do_html_header('投票失败');
		echo $topic_id."号问题你已经投过票了，不能再投了"."<br>";
		// do_html_URL('user_main.php','返回主界面');
		// do_html_footer();
		// exit;
	}
	
}

do_html_header('投票完成');
echo "投票完成！"."<br>";
do_html_URL('user_main.php','返回主界面');
do_html_footer();

 ?>
















