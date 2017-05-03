<?php

	header("content-type:text/html;charset=utf-8");
	require_once '../mysql.class.php';
	$mysql = new MySQL('localhost','root','','family');
	session_start();
	if(!isset($_SESSION['phone'])){
		$res=[
			'msg'=>'请先登录',
			'code'=>0
		];
		echo json_encode($res);exit;
	}
	$_GET['fc']();
	function getOrder(){
		
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		$phone=$_SESSION['phone'];
		$status=$_GET['status'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$order=$mysql->table('user_order')->where("phone={$phone} and order_status={$status}")->select();
		foreach ($order as $key => $value) {
			$order_code=$value['order_code'];
			$order_commodity=$mysql->table('order_commodity')->where("order_code={$order_code}")->select();
			$order[$key]['cmd_list']=$order_commodity;
			//var_dump($order[$key]);
		}
		$res['data']=$order;
		echo  json_encode($res);
	}
	function userInfo(){
		global $mysql;
		$phone=$_SESSION['phone'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		$res['data']= $mysql->table('users')->where("phone={$phone}")->select();
		
		echo  json_encode($res);
	}
	function getFavour()
	{
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		$phone=$_SESSION['phone'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		
		$favour= $mysql->table('user_favour')->where("phone={$phone}")->select();
		$favour_list=[];
			//var_dump($favour);exit;
		foreach ($favour as $key => $value) {
			$cmd_id=$value['cmd_id'];
			//var_dump($cmd_id);exit;
			$sql='SELECT * FROM life_food WHERE id='.$cmd_id.' UNION SELECT * FROM life_furniture WHERE id='.$cmd_id.' UNION SELECT * FROM life_articles WHERE id='.$cmd_id;
			$favour_cmd_list= $mysql->query($sql);
			//var_dump($favour_cmd_list);exit;
			$favour_list[]=$favour_cmd_list[0];
		}
		$res['data']=$favour_list;
		echo  json_encode($res);
	}
	function getAddress()
	{
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		$phone=$_SESSION['phone'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		
		$sql='select * from user_address where phone='.$_SESSION['phone'];
		$res['data']=$mysql->query($sql);
		echo  json_encode($res);
	}
	function deleteAddress(){
		global $mysql;
		$phone=$_SESSION['phone'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$id=$_GET['id'];
		$result=$mysql->table('user_address')->where("id={$id}")->delete();
		if($result>0){
			$res=[
				'msg'=>'删除成功',
				'code'=>1
			];
		}else{
			$res=[
				'msg'=>'删除失败',
				'code'=>2
			];
		}
		
		echo  json_encode($res);
	}
	function toback()
	{
		
		global $mysql;
		$phone=$_SESSION['phone'];
		$back=$_GET['back'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$result= $mysql->data(array('phone'=>$phone,'user_back'=>$back))->table('user_back')->add();
		if($result>0){
			$res=[
				'msg'=>'提交成功',
				'code'=>1
			];
		}else{
			$res=[
				'msg'=>'网络链接失败',
				'code'=>2
			];
		}
		echo  json_encode($res);
	}
	function changePwd(){
		global $mysql;
		$phone=$_SESSION['phone'];
		$newPwd=md5($_POST['newPwd']);
		$oldPwd=md5($_POST['oldPwd']);
		$sql="SELECT * FROM users WHERE phone='$phone' and pwd='$oldPwd'";
		$result = $mysql->query($sql);
		if(!empty($result)){
			$result = $mysql->table('users')->data(array('pwd'=>$newPwd))->where("phone={$phone}")->update();
			if($result>0){
				$_SESSION=[];
				$res=[
					'msg'=>'修改密码成功',
					'code'=>1
				];
			}else{
				$res=[
					'msg'=>'网络链接失败',
					'code'=>2
				];
			}
		}else{
			$res=[
					'msg'=>'原密码错误',
					'code'=>3,
					'123'=>$oldPwd,
					'result'=>$mysql->error()
				];
		}
		
		echo  json_encode($res);
	}
	function setPurse(){
		global $mysql;
		$phone=$_SESSION['phone'];
		$purse=md5($_GET['purse']);
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$result= $mysql->table('users')->data(array('purse_pwd'=>$purse))->where("phone=$phone")->update();
		if($result>0){
			$res=[
				'msg'=>'设置成功',
				'code'=>1
			];
		}else{
			$res=[
				'msg'=>'网络链接失败',
				'code'=>2
			];
		}
		echo  json_encode($res);
	}
	function changePursePwd(){
		global $mysql;
		$thisPhone=$_SESSION['phone'];
		$phone=$_POST['phone'];
		$sms=$_POST['sms'];
		$newPurse=md5($_POST['newPursePwd']);
		if($thisPhone==$phone&&$sms==111111){
			$result= $mysql->table('users')->data(array('purse_pwd'=>$newPurse))->where("phone={$thisPhone}")->update();
			if($result>0){
			$res=[
					'msg'=>'修改成功',
					'code'=>1,
					'erro'=>$mysql->error()
				];
			}else{
				$res=[
					'msg'=>'网络连接失败',
					'code'=>3,
					'erro'=>$mysql->error()
				];
			}
		}else{
			$res=[
				'msg'=>'修改	失败，验证码错误',
				'code'=>2
			];
		}
		echo  json_encode($res);
	}
	function deleteFavour(){
		global $mysql;
		$thisPhone=$_SESSION['phone'];
		$arr=$_POST['arr'];
		//$sql='delete * from user_favour where cmd_id in (-1';
		$uname='';
		for($i=0;$i<count($arr);$i++){

		$uname=$uname."'".$arr[$i]."',";
		
		}
		
		$the_uname ="cmd_id in(".$uname."'')";
		
		
		$result=$mysql->table('user_favour')->where($the_uname)->delete();
		if($result>0){
			$res=[
					'msg'=>'删除成功',
					'code'=>1,
				];
			
		}else{
			$res=[
				'msg'=>'网络连接失败',
				'code'=>3,
				'erro'=>$sql
			];
		}
		echo  json_encode($res);
	}
	function cencelOrder(){
		global $mysql;
		$order_code=$_GET['order_code'];
		$result=$mysql->table('order_commodity')->where("order_code={$order_code}")->delete();
		$result=$mysql->table('user_order')->where("order_code={$order_code}")->delete();
		if($result>0){
			$res=[
					'msg'=>'取消订单成功',
					'code'=>1,
				];
			
		}else{
			$res=[
				'msg'=>'由于网络原因，取消订单失败',
				'code'=>3,
				'erro'=>$mysql->error()
			];
		}
		echo  json_encode($res);
	}
	function getCmd(){
		global $mysql;
		$order_code=$_GET['order_code'];
		$result=$mysql->table('user_order')->data(array('order_status'=>'4'))->where("order_code={$order_code}")->update();
		if($result>0){
			$res=[
					'msg'=>'操作成功',
					'code'=>1,
				];
			
		}else{
			$res=[
				'msg'=>'由于网络原因，操作失败',
				'code'=>3,
				'erro'=>$mysql->error()
			];
		}
		echo  json_encode($res);
	}
	function createAfterOrder(){
		global $mysql;
		    $back_reason = $_POST["back_reason"];
		    $back_price = $_POST["back_price"];
			$back_info = $_POST['back_info'];
			$order_code=$_POST['order_code'];
			$phone=$_SESSION['phone'];
		    $file = $_FILES["upfile"];
		    // var_dump($file);
		    //文件名
		    $name = iconv('utf-8','gb2312',$file["name"]);
			$arr=explode('.', basename($name));
			$hz=array_pop($arr);
			$name='../upload/'.date('YmdHis').rand(100,999).'.'.$hz;
			$arr=array('sale_reason'=>$back_reason,'sale_price'=>$back_price,'sale_explain'=>$back_info,'order_code'=>$order_code,'sale_picture'=>$name,'phone'=>$phone);
		    $file_type = $file["type"];
		    $tmp = $file["tmp_name"];
		    if($file_type=='image/png'||$file_type=='image/jpeg'||$file_type=='image/jpg'){
		        //判断文件是否存在
		        if(!file_exists($name)){
		            //移动文件
		            if(move_uploaded_file($tmp,$name)){
		                // echo "上传成功";
		                //$sql = "INSERT INTO `slide_img`(`id`, `link`, `title`, `src`) VALUES (null,'$link','$title','$name')";
		                $res=$mysql->data($arr)->table('sale_order')->add();
		                if($res>0){
		                	$mysql->data(array('order_status'=>5))->table('user_order')->where("order_code={$order_code}")->update();
		                	$res=[
								'msg'=>'提交成功',
								'code'=>1,
							];
		                }

		            }else{
		                $res=[
								'msg'=>'提交失败',
								'code'=>2,
							];
		            }
		        }else{
		              $res=[
							'msg'=>'提交失败，图片已存在',
							'code'=>3,
						];
		        }
		    }else{
				$res=[
				'msg'=>'提交失败，图片格式错误',
				'code'=>4,
				];
		    }
		echo json_encode($res);
	}
	function cencelSale(){
		global $mysql;
		$order_code=$_GET['order_code'];
		$result=$mysql->table('user_order')->data(array('order_status'=>'4'))->where("order_code={$order_code} and order_status=5")->update();
		if($result>0){
			$res=[
					'msg'=>'操作成功',
					'code'=>1,
				];
			
		}else{
			$res=[
				'msg'=>'由于网络原因，操作失败',
				'code'=>3,
				'erro'=>$mysql->error()
			];
		}
		echo  json_encode($res);
	}
?>