<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	session_start();
	$mysql = new MySQL('localhost','root','','family');
	$flag=$_GET['flag'];
	$phone=$_SESSION['phone'];
	$addressName=$_POST['userName'];
	$addressPhone=$_POST['phone'];
	$address=$_POST['provinCity'];
	$detail=$_POST['addressDetail'];
	$isDefault=$_POST['isDefault'];
	$ids=$_GET['id'];
	if($isDefault){
		$mysql->execute('update `user_address` set `default` = 0');
		$isDefault=1;
	}else{
		$isDefault=0;
	}
	if($flag){
		$res = $mysql->data(array('address'=>$address,'phone'=>$phone,'detailaddrass'=>$detail,'username'=>$addressName,'default'=>$isDefault))->table('user_address')->add();
		$id=$mysql->query('select max(id) from user_address;');
	}else{
		$res = $mysql->data(array('address'=>$address,'phone'=>$phone,'detailaddrass'=>$detail,'username'=>$addressName,'default'=>$isDefault))->where("id={$ids}")->table('user_address')->update();	
		$id=$mysql->query('select max(id) from user_address;');
	}
	if($res>0){
			$res=[
				'msg'=>'操作成功',
				'code'=>1,
				'id'=>$id
			];
				echo json_encode($res);
		}else{
			$res=[
				'msg'=>'操作失败,网络连接错误',
				'code'=>0,
				
			];
			echo json_encode($res);
		}
?>