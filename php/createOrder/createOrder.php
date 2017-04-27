<?php
	header("content-type:text/html;charset=utf-8");
	
	require_once '../mysql.class.php';
	session_start();
	$_SESSION['shoppingCar']=[];
	$mysql = new MySQL('localhost','root','','family');
	$data=$_POST;
	$phone=$_SESSION['phone'];
	$order_statue=1;
	$liuyan=$data['liuyan'];
	$create_time=time();
	$address_id=$data['addressId'];
	$order_code=date('Ymd').str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
	$order_code2=$order_code;
	$res = $mysql->data(array('address'=>$address_id,'order_code'=>$order_code,'phone'=>$phone,'order_status'=>$order_statue,'create_time'=>$create_time,'liuyan'=>$liuyan))->table('user_order')->add();
	foreach ($data['cmdId'] as $key => $value) {
		$commodity_id=$value['cmdId'];
		$cmd_count=$value['counts'];
		$sql='SELECT * FROM life_food WHERE id='.$commodity_id.' UNION SELECT * FROM life_furniture WHERE id='.$commodity_id.' UNION SELECT * FROM life_articles WHERE id='.$commodity_id;
		$cmd_info = $mysql->query($sql);
		$all_price = $cmd_info[0]['salesPrice']*$cmd_count;
		$title=$cmd_info[0]['title'];
		$img=$cmd_info[0]['pic'];
		$res2 = $mysql->data(array('commodity_img'=>$img,'commodity_title'=>$title,'commodity_id'=>$commodity_id,'order_code'=>$order_code2	,'cmd_count'=>$cmd_count,'all_price'=>$all_price))->table('order_commodity')->add();
	}
	if($res>0||$res2>0){
			$res=[
				'msg'=>'提交订单成功',
				'code'=>1,
				'order_code'=>$order_code
			];
				echo json_encode($res);
	}else{
		$res=[
			'msg'=>'提交订单失败,网络连接错误',
			'code'=>0,
			
		];
		echo '错误信息:'.$mysql->error().'<br>';
	}
?>