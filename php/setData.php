<?php
	require_once 'mysql.class.php';
	header("content-type:text/html;charset=utf-8");
	 $filename = "test.json";
     $json_string = file_get_contents($filename);
	 $obj=json_decode($json_string,true);
     if (!is_array($obj)) die('no successful');
	 foreach ($obj['list']['pageList'] as $key => $value) {
	 	$mysql = new MySQL('localhost','root','','family');
		 var_dump($value);
		$result= $mysql->data($value)->table('life_furniture')->add();
	 	if($result>0){
	 		echo '成功';
	 	}else{
	 		echo '失败';
	 	}
	 }
?>