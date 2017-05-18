<?php
	header("content-type:text/html;charset=utf-8");
	require_once '../mysql.class.php';
	$mysql = new MySQL('localhost','root','','family');
	session_start();
	if(!isset($_SESSION['phone'])){
		$res=[
			'msg'=>'请先登录',
			'code'=>0
		];
		echo json_encode($res);exit;
	}
	if(isset($_GET['order_code'])&&isset($_GET['purse_pwd'])){
		$order_code=$_GET['order_code'];
		$pursePwd=md5(urldecode($_GET['purse_pwd']));
	}else{
		$res=[
			'msg'=>'请求参数错误',
			'code'=>2
		];
		echo json_encode($res);exit;
	}
	//校验支付密码
	$phone=$_SESSION['phone'];
	$sql="SELECT * FROM users WHERE phone ='$phone'";
	$result = $mysql->query($sql);
	if(!empty($result)){
		if($result[0]['purse_pwd']==''){
			$res=[
				'msg'=>'还没有设置支付密码哦，快去设置吧',
				'code'=>6
			];
			echo json_encode($res);exit;
		}else{
			$purse_pwd=$result[0]['purse_pwd'];
			if($purse_pwd==$pursePwd){
		 		//校验是否余额不足
				$balance=$_SESSION['balance'];
				$orderAllprice=$_SESSION['order_all_price'];
				if($balance<$orderAllprice){
					$res=[
						'msg'=>'余额不足！请先充值~',
						'code'=>7
					];
					echo json_encode($res);exit;
				}else{
					//扣款，修改订单状态，修改余额
					$flag=1;
					$change=$balance-$orderAllprice;
					$res=$mysql->table('users')->data(array('balance'=>$change))->where("phone={$phone}")->update();
					if(!$res){
						$flag=0;
					}
					$res=$mysql->table('user_order')->data(array('order_status'=>2))->where("order_code={$order_code}")->update();
					if(!$res){
						$flag=0;
					}
					if($flag){
						$res=[
							'msg'=>'支付成功',
							'code'=>1
						];
						echo json_encode($res);exit;
					}else{
						$res=[
							'msg'=>'支付失败',
							'code'=>4
						];
						echo json_encode($res);exit;
					}
				}
				
			}else{
				$res=[
					'msg'=>'支付密码错误',
					'code'=>3
				];
				echo json_encode($res);
			}
		}
	}else{
		$res=[
			'msg'=>'数据错误',
			'code'=>5
		];
		echo json_encode($res);exit;
	}
	
	
?>