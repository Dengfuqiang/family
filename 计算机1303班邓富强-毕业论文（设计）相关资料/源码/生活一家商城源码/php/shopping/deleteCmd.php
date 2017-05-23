<?php
	session_start();
	$useInfo=$_SESSION;
	if(isset($_POST['fc'])){
		$_POST['fc']();
	}
	function deleteCmd(){
		global $_POST;
		if($_POST['flag']){
			require_once '../mysql.class.php';
			$mysql = new MySQL('localhost','root','','family');
			foreach ($_POST['cmdList'] as $key => $value) {
				unset($_SESSION['shoppingCar'][$value]);
			}
			$arr=[];
			foreach ($_SESSION['shoppingCar'] as $key => $value) {
				$sql='select * from '.$value['table'].' where id='.$key;
				$res = $mysql->query($sql);
				$res['count']=$value['count'];
				$arr[]=$res;
			};
			$res=[
						'msg'=>'删除成功',
						'code'=>1
					];
			
			$res['data']=$arr;
			echo json_encode($res);
		}
		else{
			$id=$_POST['id'];
			unset($_SESSION['shoppingCar'][$id]);
			$res=[
						'msg'=>'删除成功',
						'code'=>1
					];
			echo json_encode($res);
		}
	}
?>