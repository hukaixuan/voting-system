<?php 
	//数据库连接类，得到一个数据库连接对象
function db_connect(){
	$conn = new mysqli('localhost','root','hkx1008','vote');
	if ( !$conn ) {
		throw new Exception('连接数据库失败 ');
	} else {
		//终于解决了插入数入库时候的中文乱码问题！！！
		$conn->query("SET NAMES 'utf8'");
		$conn->query("SET CHARACTER_SET_CLIENT=utf8");
		$conn->query("SET CHARACTER_SET_RESULTS=utf8");
		return $conn;
	}
}

/*//返回一个查询之后的结果数组，以字段值为下标进行存储
function get_db_value($var,$table){
	$conn = db_connect();
	$sql ="select ".$var." from ".$table."";
	$result = $conn->query($sql);
	if (!$result) {
		throw new Exception("db_fns....get_value失败");
	}
	$row_num = $conn->num_rows;
	for ($i=0; $i < $row_num; $i++) { 
		$row = $result->fetch_assoc();
	}
	return $row;
}*/

 ?>
