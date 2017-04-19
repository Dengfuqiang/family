<?php
	header("content-type:text/html;charset=utf-8");
	require_once 'php/mysql.class.php';
	$mysql = new MySQL('localhost','root','','family');
	$sql='select id from beautity_life';
	$res = $mysql->query($sql);
	foreach ($res as $key => $value) {
		$id=$value['id'];
		$url='http://www.gdshyj.com/shop/mbussinfo!get.action?id='.$id;
		$html=file_get_contents($url);
		$str=json_encode(json_decode($html)->obj->content);
		echo $str;
		//$sql='update beautity_life set content='.$str.' where id='.$id;
		//$result = $mysql->execute($sql);
		//var_dump($res);
	}
	
	//echo $res.'<br>'.$str;
?>