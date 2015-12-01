<?php 
require_once('db_fns.php');
//添加问题
function add_topic($de,$mult){
	$conn = db_connect();
	$sql = "insert into topic(de,mult) values('".$de."',".$mult.")";
	$result = $conn->query($sql);
	if (!$result) {
		throw new Exception("添加问题失败！");
	}
	return $conn->insert_id;  //返回插入行的id
}

//添加选项
function add_opt($ABC,$de,$topic_id){
	$conn = db_connect();
	// if ($topic_id==0) {
	// 	$result= $conn->query("select max(id) from topic");
	// 	while ($row=$result->fetch_assoc()) {
	// 		$topic_id = $row['max(id)'];
	// 	}
	// }
	$sql = "insert into opt(topic_id,ABC,de) values(".$topic_id.",'".$ABC."','".$de."')";
	if (!$conn->query($sql)) {
		throw new Exception("添加选项失败".'<br>'.$conn->error);
		exit;
	}
	return $conn->insert_id;   //返回插入行的id
}

//向user_topic表中添加项
function add_user_topic($user_id,$topic_id){
	$conn = db_connect();
	$flag = 2;
	$sql = "insert into user_topic values(".$user_id.",".$topic_id.",".$flag.")";
	if (!$conn->query($sql)) {
		echo $conn->error;
		throw new Exception("向user_topic表中添加项失败");
	}
	return $conn->insert_id;
}

// //向user_opt表中添加项
// function add_user_opt($user_id,$opt_id,$flag){
// 	$conn = db_connect();
// 	$flag = 2;
// 	$sql = "insert into user_opt(user_id,opt_id,flag) values(".$user_id.",".$opt_id.",".$flag.")";
// 	if (!$conn->query($sql)) {
// 		throw new Exception("向user_opt表中添加项失败");
// 	}
// 	return $conn->insert_id;
// }

//在user_topic表中添加投票内容
function vote($user_id,$topic_id){
	$conn = db_connect();
	$flag = 1;
	echo "$user_id"." $topic_id"." $flag"."<br>";
	$sql = "insert into user_topic values(".$user_id.",".$topic_id.",".$flag.")";
	if (!$conn->query($sql)) {
		echo $conn->error;
		throw new Exception("向user_topic表中添加投票信息失败");
	}
	return $conn->insert_id;
}

//opt表中增加选票
function add_vote($topic_id,$ABC){
	$conn = db_connect();
	$sql = "update opt set num=num+1 where topic_id=".$topic_id." and ABC='".$ABC."'";
	if (!$conn->query($sql)) {
		echo $conn->error;
		throw new Exception("增加投票信息失败");
	}
	return true;

}

//验证用户是否已经投票,投过了返回true
function is_user_voted($user_id,$topic_id){
	$conn = db_connect();
	$sql = "select flag from user_topic where user_id=".$user_id." and topic_id=".$topic_id." and flag=1";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$flag = $row['flag'];
	echo gettype($flag);
	if ($flag) {     
		return true;
	}else{       //没投过票或发起投票但自己并未投票的情况
		return false;
	}
}




 ?>









