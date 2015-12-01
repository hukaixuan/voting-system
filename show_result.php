<?php 
//显示投票结果
require_once('fns.php');
do_html_header('投票结果');
do_html_heading('投票结果');
display_vote_result();
do_html_URL('index.php','返回主界面');
do_html_footer();

 ?>