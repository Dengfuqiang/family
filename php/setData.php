<?php
	require_once 'mysql.class.php';
	header("content-type:text/html;charset=utf-8");
	 $filename = "test.json";
     $json_string = file_get_contents($filename);
	 $obj=json_decode($json_string,true);
     if (!is_array($obj)) die('no successful');
	 foreach ($obj['list']['pageList'] as $key => $value) {
	 	$mysql = new MySQL('localhost','root','','family');
		 $value['category']=234;
		 var_dump($value['content']);exit; 
		//$result= $mysql->data($value)->table('life_articles')->add();
		echo '错误信息:'.$mysql->error().'<br>';
	 	if($result>0){
	 		echo '成功';
	 	}else{
	 		echo '失败';
	 	}
	 }
?>