<?php
	header("content-type:text/html;charset=utf-8");
	session_start();
	if(isset( $_SESSION['username'])){
		if(isset($_SESSION['shoppingCar'])){
			if(array_key_exists($_GET['id'],$_SESSION['shoppingCar'])){
				$res=[
					'msg'=>'商品已在购物车中',
					'code'=>3,
					'car'=>$_SESSION['shoppingCar'],
				];
			}else{
				$_SESSION['shoppingCar'][$_GET['id']]=['category'=>$_GET['category'],'count'=>$_GET['count'],'table'=>$_GET['table']];
				$res=[
					'msg'=>'加入购物车成功',
					'code'=>1,
					'car'=>$_SESSION['shoppingCar'],
				];
			}
		}else{
			$_SESSION['shoppingCar']=[];
			$_SESSION['shoppingCar'][$_GET['id']]=['category'=>$_GET['category'],'count'=>$_GET['count'],'table'=>$_GET['table']];
			$res=[
				'msg'=>'加入购物车成功',
				'code'=>1,
				'car'=>$_SESSION['shoppingCar'],
			];
		}
	}else{
		$res=[
			'msg'=>'请先登录',
			'code'=>0
		];
	}
	
	echo json_encode($res);
?>