<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr=[];
	$min=$_GET['page']*15;
	$key=$_GET['key'];
	$max=15;
	if(!isset($_GET['sort'])){
		$sql='SELECT * FROM life_food WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_articles WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_furniture WHERE title LIKE "%'.$key.'%" LIMIT '.$min.','.$max;
	}else{
		if(isset($_GET['top'])){
			if($_GET['top']){
				$sql='SELECT * FROM life_food WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_articles WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_furniture WHERE title LIKE "%'.$key.'%" ORDER BY '.$_GET['sort'].' LIMIT '.$min.','.$max;
			}else{
				$sql='SELECT * FROM life_food WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_articles WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_furniture WHERE title LIKE "%'.$key.'%" ORDER BY '.$_GET['sort'].' desc LIMIT '.$min.','.$max;
			}
		}else{
			$sql='SELECT * FROM life_food WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_articles WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_furniture WHERE title LIKE "%'.$key.'%" ORDER BY '.$_GET['sort'].' LIMIT '.$min.','.$max;
		}
	}
		$sql2='SELECT * FROM life_food WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_articles WHERE title LIKE "%'.$key.'%" UNION SELECT * FROM life_furniture WHERE title LIKE "%'.$key.'%"';
	//$sql2='select * from '.$table.' where commodity_id=1';
	//$sql3=' select count(id) from '.$table.' where category='.$category;
	$res = $mysql->query($sql);
	$result=$mysql->query($sql2);
	$arr[]=$res;
	//$res = $mysql->query($sql2);
	//$arr[]=$res;
	//$res = $mysql->query($sql3);
	$arr[]=count($result);
	$arr[]=$sql;
	echo json_encode($arr);
?>