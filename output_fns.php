<?php 
//不能在这里再require_once('db_fns.php');！！！！WHY？？？？
//显示html头
function do_html_header($title){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
<?php
}
//html尾
function do_html_footer(){
?>
</body>
</html>
<?php
}

//显示标题
function do_html_heading($heading){
?>
<h2><?php echo $heading; ?></h2>
<?php
}

//设置链接
function do_html_URL($url, $name){
?>
<br><a href="<?php echo $url; ?>"><?php echo $name; ?></a> <br>
<?php
}

//显示登陆框
function display_login_form(){
?>
<p><a href="regist.php">没有账号？</a></p>
<form action="dologin.php" method="post">
	<table>
		<tr>
			<td colspan="2">登录</td>
		</tr>
		<tr>
			<td>账号：</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>密码：</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
			<input type="submit" value="登录"></td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<a href="forget_form.php">忘记密码</a>
			</td>
		</tr>
	</table>
</form>

<?php
}


//显示注册框
function display_regist_form(){
?>
<form action="doregist.php" method="post">
	<table >
		<tr>
			<td>账号：</td>
			<td><input type="text" name="username" 
			size="20" maxlength="20"></td>
		</tr>
		<tr>
			<td>密码：</td>
			<td><input type="password" name="password"
			size="20" maxlength="20"></td>
		</tr>
		<tr>
			<td>确认密码：</td>
			<td><input type="password" name="password2"
			size="20" maxlength="20"></td>
		</tr>
		<tr>
			<td>邮箱：</td>
			<td><input type="text" name="email" 
			size="40" maxlength="40"></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="注册">
			</td>
		</tr>
	</table>
</form>
<?php
}

function display_add_form(){
?>
<form action="do_add_topic.php" method="post">
	请输入你要得到投票的问题：<br>
	<input type="text" name="de"> <br>
	<!-- 单选、多选从前台做 !!!-->
	<select name="mult">
		<option value="false" selected="true">单选</option>
		<option value="true">多选</option>
	</select> <br>
	A.<input type="text" name="A"> <br>
	B.<input type="text" name="B"> <br>
	C.<input type="text" name="C"> <br>
	D.<input type="text" name="D"> <br>
	<input type="submit" value="提交">
</form>

<?php
}

//登出
function display_logout(){
?>
	<a href="dologout.php">登出</a>
<?php
}

//显示投票页面
function display_vote_form(){
?>
<form action="dovote.php" method="post">
	<?php 
		$conn = db_connect();
		$result = $conn->query("select de from topic");
		$row_num = $result->num_rows;  //问题数目
		for ($i=0; $i < $row_num; $i++) { 
			$row = $result->fetch_assoc();
			$de = $row['de'];
			// 输出问题
			echo "<p>".($i+1).".$de</p>";
			//得到问题的id；
			$id_result = $conn->query("select id from topic where de='".$de."'");
			$id_row = $id_result->fetch_assoc();
			$id = $id_row['id'];
			//得到选项的ABC、描述、id；
			$opt_ABC_result = $conn->query("select ABC from opt where topic_id='".$id."'");
			$opt_de_result = $conn->query("select de from opt where topic_id='".$id."'");
			// $opt_id_result = $conn->query("select id from opt where topic_id='".$id."'");
			$mult_result = $conn->query("select mult from topic where id='".$id."'");
			//得到题目 是否多选
			$mult_row = $mult_result->fetch_assoc();
			$mult = $mult_row['mult'];
			$opt_row_num = $opt_ABC_result->num_rows;
			for ($j=0; $j < $opt_row_num; $j++) { 
				$opt_ABC_row = $opt_ABC_result->fetch_assoc();
				$opt_de_row = $opt_de_result->fetch_assoc();
				// $opt_id_row = $opt_id_result->fetch_assoc();
				$ABC = $opt_ABC_row['ABC'];
				$de = $opt_de_row['de'];
				// $opt_id = $opt_id_row['id'];
				
				//输出选项
				if ($mult) {
					echo '<input type="checkbox" name="'.$id.'" value="'.$ABC.'">'.$ABC.' ' . ' '.$de.'<br>';
				} else {
					echo '<input type="radio" name="'.$id.'" value="'.$ABC.'">'.$ABC.' ' . ' '.$de.'<br>';
				}
			}
		}
		echo '<input type="submit" value="提交"></input>';
	 ?>
</form>

<?php
}

//显示投票结果
function display_vote_result(){
	$conn = db_connect();
	$result = $conn->query("select de from topic");
	$row_num = $result->num_rows;  //问题数目
	for ($i=0; $i < $row_num; $i++) { 
		$row = $result->fetch_assoc();
		$de = $row['de'];
		// 输出问题
		echo "<p>".($i+1).".$de</p>";
		//得到问题的id；
		$id_result = $conn->query("select id from topic where de='".$de."'");
		$id_row = $id_result->fetch_assoc();
		$id = $id_row['id'];
		//得到选项的ABC、描述、id；
		$opt_ABC_result = $conn->query("select ABC from opt where topic_id='".$id."'");
		$opt_de_result = $conn->query("select de from opt where topic_id='".$id."'");
		// $opt_id_result = $conn->query("select id from opt where topic_id='".$id."'");
		//$mult_result = $conn->query("select mult from topic where id='".$id."'");
		//得到题目 是否多选
		//$mult_row = $mult_result->fetch_assoc();
		// $mult = $mult_row['mult'];
		$opt_row_num = $opt_ABC_result->num_rows;
		for ($j=0; $j < $opt_row_num; $j++) { 
			$opt_ABC_row = $opt_ABC_result->fetch_assoc();
			$opt_de_row = $opt_de_result->fetch_assoc();
			// $opt_id_row = $opt_id_result->fetch_assoc();
			$ABC = $opt_ABC_row['ABC'];
			$opt_de = $opt_de_row['de'];
			// $opt_id = $opt_id_row['id'];
			//得到投票数量
			$num_result = $conn->query("select num from opt where topic_id=".$id." and ABC='".$ABC."'");
			$num_row = $num_result->fetch_assoc();
			$num =  $num_row['num'];
			//输出选项及投票数量
			echo "<p>&nbsp;&nbsp;".$ABC.". ".$opt_de."      票数：&nbsp;&nbsp;&nbsp;&nbsp;".$num."</p>";
		}
	}
}

 ?>

















