<?php
	header("content-type:text/html;charset=utf-8");
	session_start();
	if(isset( $_SESSION['username'])){
		$cmd_id=$_GET['id'];
		require_once '../mysql.class.php';
		$mysql = new MySQL('localhost','root','','family');
		$res = $mysql->table('user_favour')->where("cmd_id={$cmd_id}")->select();
		if($res){
			$res=[
				'msg'=>'商品已存在收藏夹',
				'code'=>0,
			];
		}else{
			$phone=$_SESSION['phone'];
			$res= $mysql->data(array('phone'=>$phone,'cmd_id'=>$cmd_id))->table('user_favour')->add();
			if($res>0){
				$res=[
					'msg'=>'加入收藏加成功',
					'code'=>1
				];
			}else{
				$res=[
					'msg'=>'由于网络原因,加入收藏加失败',
					'code'=>0
				];
			}
		}
	}else{
		$res=[
			'msg'=>'请先登录',
			'code'=>2
		];
	}
	
	echo json_encode($res);
?>