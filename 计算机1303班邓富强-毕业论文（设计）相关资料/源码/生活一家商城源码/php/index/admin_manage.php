<?php

	header("content-type:text/html;charset=utf-8");
	require_once '../mysql.class.php';
	session_start();
	if(!isset($_SESSION['user_name'])){
		exit;
	}
	$mysql = new MySQL('localhost','root','','family');
	$_GET['fc']();
	function editCommodity(){
		global $mysql;
		
		$newData=json_decode($_POST['newData']) ;
		if(!empty($_FILES['pic']["name"])){
			$name = iconv('utf-8','gb2312',$_FILES['pic']["name"]);
			$arr=explode('.', basename($name));
			$hz=array_pop($arr);
			$name3=date('YmdHis').rand(100,999).'.'.$hz;
			$name1=$_SERVER['HTTP_ORIGIN'].'/php/upload/'.$name3;
			$name='../upload/'.$name3;
			$tmp = $_FILES['pic']["tmp_name"];
			move_uploaded_file($tmp,$name);
			$newData->pic=$name1;
		}
		
		
		if(!empty($_FILES['contents']['name'][0])){
			$content_pic='';
			$num=count($_FILES['contents']['name']);
			for($i=0;$i<$num;$i++){
				
				$content_name = iconv('utf-8','gb2312',$_FILES['contents']["name"][$i]);
				$content_arr=explode('.', basename($content_name));
				$content_hz=array_pop($content_arr);
				$content_name3=date('YmdHis').rand(100,999).'.'.$content_hz;
				$content_name1=$_SERVER['HTTP_ORIGIN'].'/php/upload/'.$content_name3;
				$content_pic.='<div style="text-align: center;"><img alt="" src="'.$content_name1.'" /></div>';
				$content_name='../upload/'.$content_name3;
				$content_tmp = $_FILES['contents']["tmp_name"][$i];
				move_uploaded_file($content_tmp,$content_name);
			}
			$newData->content=$content_pic;
		}
 		$table=$_POST['table'];
		$id=$newData->id;
		$result= $mysql->data($newData)->table($table)->where("id={$id}")->update();
		if($result>0){
			$res=[
				'msg'=>'编辑成功',
				'code'=>1,
			];
		}else{
			$res=[
				'msg'=>'编辑失败',
				'code'=>3,
				'erro'=>$mysql->error()
			];
		}
		echo  json_encode($res);
	
	}
	function addCommodity(){
		global $mysql;
		$name = iconv('utf-8','gb2312',$_FILES['pic']["name"]);
		$arr=explode('.', basename($name));
		$hz=array_pop($arr);
		$name3=date('YmdHis').rand(100,999).'.'.$hz;
		$name1=$_SERVER['HTTP_ORIGIN'].'/php/upload/'.$name3;
		$name='../upload/'.$name3;
		$tmp = $_FILES['pic']["tmp_name"];
		
		
		$content_pic='';
		$num=count($_FILES['contents']['name']);
		for($i=0;$i<$num;$i++){
			
			$content_name = iconv('utf-8','gb2312',$_FILES['contents']["name"][$i]);
			$content_arr=explode('.', basename($content_name));
			$content_hz=array_pop($content_arr);
			$content_name3=date('YmdHis').rand(100,999).'.'.$content_hz;
			$content_name1=$_SERVER['HTTP_ORIGIN'].'/php/upload/'.$content_name3;
			$content_pic.='<div style="text-align: center;"><img alt="" src="'.$content_name1.'" /></div>';
			$content_name='../upload/'.$content_name3;
			$content_tmp = $_FILES['contents']["tmp_name"][$i];
			move_uploaded_file($content_tmp,$content_name);
		}
		
		
		 if(move_uploaded_file($tmp,$name)){
		 		$table=$_POST['table'];
            	$arr1=[
					'id'=>time(),
					'marketPrice'=>$_POST['marketPrice'],
					'sellerCount'=>$_POST['sellerCount'],
					'salesPrice'=>$_POST['salesPrice'],
					'title'=>$_POST['title'],
					'category'=>$_POST['category'],
					'salesCount'=>500,
					'createDate'=>$_POST['createDate'],
					'pic'=>$name1,
					'content'=>$content_pic
				];
				$result= $mysql->data($arr1)->table($table)->add();
				if($result>0){
					$res=[
						'msg'=>'提交成功',
						'code'=>1,
					];
				}else{
					$res=[
						'msg'=>'添加失败',
						'code'=>3,
					];
				}
            	

        }else{
            $res=[
					'msg'=>'添加失败',
					'code'=>2,
				];
        }
		
		echo  json_encode($res);
	
	}
	function deleteUser(){
		global $mysql;
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$phone=$_GET['phone'];
		$result=$mysql->table('users')->where("phone={$phone}")->delete();
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
	function getOrder(){
		
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		$status=$_GET['status'];
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$order=$mysql->table('user_order')->where("order_status={$status}")->select();
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
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		$res['data']= $mysql->table('users')->select();
		
		echo  json_encode($res);
	}
	function getFavour()
	{
		$res=[
			'msg'=>'请求成功',
			'code'=>1
		];
		global $mysql;
		//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		if(isset($_GET['category'])){
			$category=$_GET['category'];
			if(isset($_GET['key'])){
				$key=$_GET['key'];
				$favour_list= $mysql->table($category)->order('createDate desc ')->where("title like '%{$key}%'")->select();
			}else{
				$favour_list= $mysql->table($category)->order('createDate desc ')->select();
			}
		}else{
			$favour_list= $mysql->table('life_food')->order('createDate desc ')->select();
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
	function changeUser(){
		global $mysql;
		$phone=$_POST['phone'];
		$_POST['pwd']=md5($_POST['pwd']);
		$_POST['purse_pwd']=md5($_POST['purse_pwd']);
		$result = $mysql->table('users')->data($_POST)->where("phone={$phone}")->update();
		if($result>0){
			$res=[
				'msg'=>'修改成功',
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
		$id=$_GET['cmd_id'];
		//$sql='delete * from user_favour where cmd_id in (-1';
		$table=$_GET['table'];
		$result=$mysql->table($table)->where("id={$id}")->delete();
		if($result>0){
			$res=[
					'msg'=>'删除成功',
					'code'=>1,
				];
			
		}else{
			$res=[
				'msg'=>'网络连接失败',
				'code'=>3,
				'result'=>$mysql->error()
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
			$name=$_SERVER['HTTP_ORIGIN'].'/php/upload/'.date('YmdHis').rand(100,999).'.'.$hz;
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
	function setWuliu(){
		global $mysql;
		$order_code=$_GET['order_code'];
		$wuliu=$_GET['value'];
		$result=$mysql->table('user_order')->data(array('order_status'=>'3','wuliu'=>$wuliu))->where("order_code={$order_code} and order_status=2")->update();
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
	function getBack(){
		global $mysql;
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$res=$mysql->table('user_back')->select();
		echo  json_encode($res);
	}
	function deleteBack(){
		global $mysql;
			//var_dump($favour_list);exit;
		//$phone=['0']['phone'];
		$id=$_GET['id'];
		$result=$mysql->table('user_back')->where("id={$id}")->delete();
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
?>