<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr=[];
	$res = $mysql->query('select * from `beautity_life` LIMIT 0,20');
	$arr[]=$res;
	$res = $mysql->query('select * from `life_food` LIMIT 0,8');
	$arr[]=$res;
	$res = $mysql->query('select * from `life_articles` LIMIT 0,8');
	$arr[]=$res;
	$res = $mysql->query('select * from `life_furniture` LIMIT 0,8');
	$arr[]=$res;
	echo json_encode($arr);
?>