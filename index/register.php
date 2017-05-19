
<?php
  //接口类型：互亿无线触发短信接口，支持发送验证码短信、订单通知短信等。
  //账户注册：请通过该地址开通账户http://sms.ihuyi.com/register.html
  //注意事项：
  //（1）调试期间，请用默认的模板进行测试，默认模板详见接口文档；
  //（2）请使用APIID（查看APIID请登录用户中心->验证码、通知短信->帐户及签名设置->APIID）及 APIkey来调用接口；
  //（3）该代码仅供接入互亿无线短信接口参考使用，客户可根据实际需要自行编写；

	header("content-type:text/html;charset=utf-8");
session_start();

function random($length = 6 , $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}
$_SESSION['send_code'] = random(6,1);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/index/register.css"/>
	</head>
	<body>
		<div class="body_contain">
			
			<header>
				<a href="index.php">
					<img src="../img/login_logo.jpg" alt="" />
				</a>
				<span>欢迎注册</span>
			</header>
			<article>
				<form action="../php/index/register.php" method="post" id="register_form">
					<h1>注册</h1>
					<label>&emsp;用户名：<input type="text" name="username" id="username" value="" placeholder="请输入用户名" /></label>
					<label>手机号码：<input type="text" name="mobile_phone" id="mobile_phone" placeholder="请输入手机号码" /></label>
					<label>&emsp;验证码：<input type="password" name="sms" id="sms" value="" placeholder='请输入密码'/><a href="javascript:void(0);" id="get_sms">获取验证码</a></label>
					<label>创建密码：<input type="password" name="pwd" id="pwd" value="" placeholder='输入6-16位字母或数字密码'/></label>

					<label>确认密码：<input type="password" name="confirm_pwd" id="confirm_pwd" value="" placeholder='再次输入密码'/></label>
					<input type="submit" value="注册" id="register" class="confirm_submit"/>
					<div class="to_login">
						<p>已经注册过？</p>
						<p>请点击 <a href="login.html">直接登录</a></p>
					</div>
				</form>
			</article>
		</div>
		<footer id="familyFooter">
				<a href="index.html">首页</a><span>|</span>
				<a href="../beautifulLife.html">精彩生活</a><span>|</span>
				<a href="../lifeFood.html">生活食品</a><span>|</span>
				<a href="###">生活用品</a><span>|</span>
				<a href="###">生活家居</a><span>|</span>
				<a href="###">会员杂锦</a><span>|</span>
				<a href="###">一键客服</a><span>|</span>
				<a href="../aboutOur.html">关于我们</a>
				<p>CopyrightO 生活一家 2007-2015, All Rights Reserved</p>
		</footer>
		<script type="text/javascript" src="../js/jquery-2.2.2.min.js" ></script>
		<script type="text/javascript">
			$("#register").on('click',function(e){
				if(document.getElementById('username').value==''){
					alert('请输入用户名');
					return false;
				}
				if(document.getElementById('mobile_phone').value==''){
					alert('请输入手机号码');
					return false;
				}
				if(document.getElementById('sms').value==''){
					alert('请输入验证码');
					return false;
				}
				if(document.getElementById('pwd').value==''){
					alert('请输入密码');
					return false;
				}
				if(document.getElementById('confirm_pwd').value==''){
					alert('请输入确认密码');
					return false;
				}
				e.preventDefault();
	            $.ajax({
	                url:'../php/index/register.php',//请求地址
	                type:'POST',//请求类型
	                dataType:'json',//预期请求数据类型
	                data:$("#register_form").serialize(), //查询字符
	                success:function(res){
	                    //成功的回调
	                    console.log(res);
	                    if(res.code==1){
	                    	alert(res.msg);
	                    	location.href='login.html';
	                    }else if(res.code==4){
	                    	alert(res.msg);
	                    	$("#sms").focus();
	                    }else if(res.code==3){
	                    	alert(res.msg);
	                    	$("#mobile_phone").focus();
	                    }else{
	                    	alert(res.msg);
	                    }
	                },
	                error:function(err){
	                    console.log(err)
	                }
	            })
	        })
	        $("#get_sms").click(function(){
	        	 if(!this.flag){
	        	 		get_mobile_code();
	        	 }
	        });
	        function get_mobile_code(){
			        $.post('../php/index/sms.php', {mobile:jQuery.trim($('#mobile_phone').val()),send_code:<?php echo $_SESSION['send_code'];?>}, function(msg) {
									alert(jQuery.trim(unescape(msg)));
									if(msg=='提交成功'){
										RemainTime();
									}
			        });
				};
				var iTime = 59;
				var Account;
				function RemainTime(){
					document.getElementById('get_sms').flag=true;
					var iSecond,sSecond="",sTime="";
					console.log(1)
					if (iTime >= 0){
						iSecond = parseInt(iTime%60);
						iMinute = parseInt(iTime/60)
						if (iSecond >= 0){
							if(iMinute>0){
								sSecond = iMinute + "分" + iSecond + "秒";
							}else{
								sSecond = iSecond + "秒";
							}
						}
						sTime=sSecond;
						if(iTime==0){
							clearTimeout(Account);
							sTime='获取手机验证码';
							iTime = 59;
							document.getElementById('get_sms').innerHTML ='获取验证码';
							document.getElementById('get_sms').flag=false;
						}else{
							Account = setTimeout("RemainTime()",1000);
							iTime=iTime-1;
						}
					}else{
						sTime='没有倒计时';
					}
					document.getElementById('get_sms').innerHTML = sTime+'后发送';
				}	
		</script>
	</body>
</html>
