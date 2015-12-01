<?php 
//验证数据是否有效

function filled_out($form_vars){
//检查表单项是否已填
	foreach ($form_vars as $key => $value) {
		//如果未被设值或值为空，返回false
		if (  (!isset($key)) || ($value == '')  ) {
			return false;
		}
	}
	return true;
}

//验证邮箱是否合法
function valid_email($address){
	if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$',$address)) {   //ereg(模式,字符串)  正则表达式匹配
		return true;
	}else{
		return false;
	}
}

 ?>