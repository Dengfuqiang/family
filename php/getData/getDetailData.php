<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr=[];
	$table=$_GET['table'];
	$id=$_GET['id'];
	$sql='select * from '.$table.' where id='.$id;
	$sql2='select * from '.$table.' where commodity_id=1';
	$res = $mysql->query($sql);
	$arr[]= $res ;
	$res = $mysql->query($sql2);
	$arr[]=$sql;
	echo json_encode($arr) ;
?>