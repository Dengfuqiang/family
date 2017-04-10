<?php
	header("content-type:text/html;charset:utf-8");

	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr = $_POST;
	$phone=$arr['mobile_phone'];
	$pwd=$arr['pwd'];
	$sql="SELECT * FROM users WHERE phone ='$phone' and pwd = md5($pwd)";
	$result = $mysql->query($sql);
	var_dump ($result);
	 if(!empty($result)){
	 		$res=[
				'msg'=>'登录成功',
				'code'=>1,
				'data'=>$result
			];
			echo json_encode($res);
	}else{
		$res=[
				'msg'=>'手机号或密码错误',
				'code'=>0
			];
			echo json_encode($res);
	}
?>