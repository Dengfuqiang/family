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
		$order_code=$_GET['order_code'];
		$phone=$_SESSION['phone'];
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		$order=$mysql->table('user_order')->where("order_code={$order_code}")->select();
		$res['price']=$order[0]['order_all_price'];
		$_SESSION['order_all_price']=$order[0]['order_all_price'];
		$balance=$mysql->table('users')->where("phone={$phone}")->select();
		$_SESSION['balance']=$balance[0]['balance'];
		$res['balance']=$balance[0]['balance'];
		echo  json_encode($res);	
?>