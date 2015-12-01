<?php 
require_once('fns.php');
//投票页面
do_html_header('vote');
do_html_URL('index.php','返回主界面');
display_vote_form();
do_html_footer();


 ?>