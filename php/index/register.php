<?php
	header("content-type:text/html;charset=utf-8");
	$arr = $_POST;
	$sms=$arr['sms'];
	if($sms==000000){
		require_once '../mysql.class.php';
		$mysql = new MySQL('localhost','root','','family');
		$phone=$arr['mobile_phone'];
		$name=$arr['username'];
		$pwd=md5($arr['pwd']);
		$result=$mysql->table('users')->where("phone={$phone}")->select();
		if(empty($result)){
			$result= $mysql->data(array('name'=>$name,'phone'=>$phone,'pwd'=>$pwd))->table('users')->add();
			if($result>0){
				$res=[
					'msg'=>'注册成功',
					'code'=>1,
					'data'=>array('name'=>$name,'phone'=>$phone,'pwd'=>$pwd)
				];
					echo json_encode($res);
			}else{
				$res=[
					'msg'=>'注册失败,网络连接错误',
					'code'=>0,
					
				];
				echo json_encode($res);
			}
		}else{
			$res=[
					'msg'=>'注册失败,手机号码已被注册',
					'code'=>3
				];
				echo json_encode($res);
		}
	}else{
		$res=[
			'msg'=>'短信验证码错误',
			'code'=>4
		];
		echo json_encode($res);
	}
	
	
?>