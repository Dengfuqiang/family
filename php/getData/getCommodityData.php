<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr=[];
	$table=$_GET['table'];
	$min=$_GET['page']*12;
	$category=$_GET['category'];
	$max=$min+12;
	$sql='select * from '.$table.' where category='.$category.' LIMIT '.$min.','.$max;
	$sql2='select * from '.$table.' where commodity_id=1';
	$sql3=' select count(id) from '.$table.' where category='.$category;
	$res = $mysql->query($sql);
	$arr[]=$res;
	$res = $mysql->query($sql2);
	$arr[]=$res;
	$res = $mysql->query($sql3);
	$arr[]=$res;
	$arr[]=$sql;
	echo json_encode($arr);
?>