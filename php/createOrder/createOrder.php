<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr=$_POST;
	$table=$_GET['table'];
	$min=$_GET['page']*12;
	$max=$min+12;
	$category=$_GET['category'];
	
	 $sql='select * from '.$table.' where category='.$category.' LIMIT 0,8';
	$res = $mysql->query($sql);
	$arr[]=$res;
	echo json_encode($arr);
?>