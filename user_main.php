<?php 
require_once('fns.php');
check_is_on();
do_html_header('Home');
do_html_heading('Success, welcome '.$_SESSION['username'].'<br>');
do_html_URL('add_topic.php','添加主题');
do_html_URL('vote.php','投票');
do_html_URL('show_result.php','查看投票结果');
display_logout();
do_html_footer();

 ?>