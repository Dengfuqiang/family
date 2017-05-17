<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr=[];
	$table=$_GET['table'];
	if(isset($_GET['page'])){
		$min=$_GET['page']*12;
	}else{
		$min=0;
	}
	$max=$min+12;
	$category=$_GET['category'];
	
	 $sql='select * from '.$table.' where category='.$category.' LIMIT 0,8';
	$res = $mysql->query($sql);
	$arr[]=$res;
	echo json_encode($arr);
?>