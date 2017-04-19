<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr=[];
	$table=$_GET['table'];
	$min=$_GET['page']*12;
	$category=$_GET['category'];
	$max=$min+12;
	if(!isset($_GET['sort'])){
		$sql='select * from '.$table.' where category='.$category.' LIMIT '.$min.','.$max;
	}else{
		if(isset($_GET['top'])){
			if($_GET['top']){
				$sql='select * from '.$table.' where category='.$category.' ORDER BY '.$_GET['sort'].' LIMIT '.$min.','.$max;
			}else{
				$sql='select * from '.$table.' where category='.$category.' ORDER BY '.$_GET['sort'].' desc LIMIT '.$min.','.$max;
			}
		}else{
			$sql='select * from '.$table.' where category='.$category.' ORDER BY '.$_GET['sort'].' LIMIT '.$min.','.$max;
		}
	}
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