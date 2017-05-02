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
	$_GET['fc']();
	function getOrder(){
		
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		$phone=$_SESSION['phone'];
		$status=$_GET['status'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$order=$mysql->table('user_order')->where("phone={$phone} and order_status={$status}")->select();
		foreach ($order as $key => $value) {
			$order_code=$value['order_code'];
			$order_commodity=$mysql->table('order_commodity')->where("order_code={$order_code}")->select();
			$order[$key]['cmd_list']=$order_commodity;
			//var_dump($order[$key]);
		}
		$res['data']=$order;
		echo  json_encode($res);
	}
	function userInfo(){
		global $mysql;
		$phone=$_SESSION['phone'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		$res['data']= $mysql->table('users')->where("phone={$phone}")->select();
		
		echo  json_encode($res);
	}
	function getFavour()
	{
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		$phone=$_SESSION['phone'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		
		$favour= $mysql->table('user_favour')->where("phone={$phone}")->select();
		$favour_list=[];
			//var_dump($favour);exit;
		foreach ($favour as $key => $value) {
			$cmd_id=$value['cmd_id'];
			//var_dump($cmd_id);exit;
			$sql='SELECT * FROM life_food WHERE id='.$cmd_id.' UNION SELECT * FROM life_furniture WHERE id='.$cmd_id.' UNION SELECT * FROM life_articles WHERE id='.$cmd_id;
			$favour_cmd_list= $mysql->query($sql);
			//var_dump($favour_cmd_list);exit;
			$favour_list[]=$favour_cmd_list[0];
		}
		$res['data']=$favour_list;
		echo  json_encode($res);
	}
	function getAddress()
	{
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		$phone=$_SESSION['phone'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		
		$sql='select * from user_address where phone='.$_SESSION['phone'];
		$res['data']=$mysql->query($sql);
		echo  json_encode($res);
	}
	function toback()
	{
		
		global $mysql;
		$phone=$_SESSION['phone'];
		$back=$_GET['back'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$result= $mysql->data(array('phone'=>$phone,'user_back'=>$back))->table('user_back')->add();
		if($result>0){
			$res=[
				'msg'=>'提交成功',
				'code'=>1
			];
		}else{
			$res=[
				'msg'=>'网络链接失败',
				'code'=>2
			];
		}
		echo  json_encode($res);
	}
	function changePwd(){
		global $mysql;
		$phone=$_SESSION['phone'];
		$newPwd=md5($_POST['newPwd']);
		$oldPwd=md5($_POST['oldPwd']);
		$sql="SELECT * FROM users WHERE phone='$phone' and pwd='$oldPwd'";
		$result = $mysql->query($sql);
		if(!empty($result)){
			$result = $mysql->table('users')->data(array('pwd'=>$newPwd))->where("phone={$phone}")->update();
			if($result>0){
				$_SESSION=[];
				$res=[
					'msg'=>'修改密码成功',
					'code'=>1
				];
			}else{
				$res=[
					'msg'=>'网络链接失败',
					'code'=>2
				];
			}
		}else{
			$res=[
					'msg'=>'原密码错误',
					'code'=>3,
					'123'=>$oldPwd,
					'result'=>$mysql->error()
				];
		}
		
		echo  json_encode($res);
	}
?>