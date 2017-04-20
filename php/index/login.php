<?php
	header("content-type:text/html;charset=utf-8");

	require_once '../mysql.class.php';
	
	$mysql = new MySQL('localhost','root','','family');
	$arr = $_POST;
	$phone=$arr['mobile_phone'];
	$pwd=$arr['pwd'];
	$sql="SELECT * FROM users WHERE phone ='$phone' and pwd = md5($pwd)";
	$result = $mysql->query($sql);
	if(!empty($result)){
		session_start();
		$_SESSION['username']=$result[0]['name'];
		$_SESSION['phone']=$result[0]['phone'];
 		$res=[
			'msg'=>'登录成功',
			'code'=>1,
			'data'=>$result
		];
		echo json_encode($res);
	}else{
		$res=[
				'msg'=>'手机号或密码错误',
				'code'=>0
			];
			echo json_encode($res);
	}
?>			<?php
				header("content-type:text/html;charset=utf-8");
				session_start();
				$useInfo=$_SESSION;
				if(isset( $_SESSION['username'])){
					if(isset($_SESSION['shoppingCar'])){
						require_once '../php/mysql.class.php';
						$mysql = new MySQL('localhost','root','','family');
						$arr=[];
						foreach ($_SESSION['shoppingCar'] as $key => $value) {
							$sql='select * from '.$value['table'].' where id='.$key;
							$res = $mysql->query($sql);
							$res[]=$value['count'];
							$arr[]=$res;
						}
						echo 'var login=1; var dataList='.json_encode($arr).';';
					}

					
				}else{
					echo 'var login=0;';
				}
				
				?>