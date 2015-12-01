<?php 
require_once('fns.php');
//登录主页面
if (!user_is_on()) {
	do_html_header('login');
	display_login_form();
	do_html_footer();
} else {
	do_html_header('have login');
	do_html_heading('当前用户已在线');
	header('Location:user_main.php');
	do_html_footer();
}


 ?>