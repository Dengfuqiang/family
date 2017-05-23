<?php
	session_start();
	$useInfo=$_SESSION;
	
	include '../public/public_header.php';
?>
		<link rel="stylesheet" type="text/css" href="../css/lifefood/pay_success.css"/>
			<article>
				<section id="pay_success">
					<div class="pay_status">
						<h2>恭喜您已成功支付</h2>
						<p> 您可以在个人中心 > 我的订单中查询。</p>
					</div>
					<div class="pay_way">
						<p>您的支付方式：<span>余额支付</span></p>
						<p>您的订单号：<span id="code">10253256215845</span></p>
					</div>
					<p class="auto_goback"><span id="time">5</span>秒后 <a href="../person_center/person_center_index.php">自动返回>></a></p>
				</section>
			</article>
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
			<script type="text/javascript" src="../js/vue.js" ></script>
			<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
			<script type="text/javascript">
			var i=6;
			setInterval(function(){
				document.getElementById('time').innerHTML=--i;
				if(i==0){
					location.href='../person_center/person_center_index.php';
				}
				
			},1000);
				document.getElementById('code').innerHTML=location.search.replace('?order_code=',"");
			</script>
	</body>
</html>
