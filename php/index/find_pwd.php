<?php
	header("content-type:text/html;charset:utf-8");
	$arr = $_POST;
	$sms=$arr['sms'];
	if($sms==000000){
		require_once '../mysql.class.php';
		$mysql = new MySQL('localhost','root','','family');
		$phone=$arr['mobile_phone'];
		$result=$mysql->table('users')->where("phone={$phone}")->select();
		if(!empty($result)){
			$pwd=md5($arr['pwd']);
			$result = $mysql->table('users')->data(array('pwd'=>$pwd,'name'=>'23333'))->where("phone={$phone}")->update();
			if($result>0){
				$res=[
					'msg'=>'找回密码成功！',
					'code'=>'1'
				];
				echo json_encode($res);
				}else{
					$res=[
						'msg'=>'找回密码失败',
						'code'=>0
					];
					echo json_encode($res);
				}
			
		}else{
			$res=[
					'msg'=>'找回密码失败,手机号码不存在',
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