<?php 
require_once('fns.php');
//添加问题及选项
check_is_on();
do_html_header('add_topic');
display_add_form();
do_html_URL('index.php','返回主界面');
do_html_footer();

 ?>