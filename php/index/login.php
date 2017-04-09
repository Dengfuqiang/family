<?php
	header("content-type:text/html;charset:utf-8");

	require_once 'mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr = $_POST;
	var_dump($arr);
	echo $mysql->data(array('name'=>'邓福','pwd'=>$pwd))->table('users')->add();
?>