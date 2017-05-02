<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
?>
	<style type="text/css">
		html,body{
			width: 100%;
			height: 100%;
			position: relative;
		}
		img{
			display: block;
			width: 240px;
			height: 300px;
			position: absolute;
			top: 0;
			bottom: 0;
			right: 0;
			left: 0;
			margin: auto;
		}
	</style>
		<img src="../img/1493722188878.jpg"/>
	<footer id="familyFooter" style="position: fixed;bottom: 0;left: 0;width: 100%;">
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
	<script type="text/javascript">
		document.getElementsByTagName('img')[0].onclick=function(){
			location.href='pay_success.html?order_code='+location.search.replace('?order_code=','');
		}
	</script>
	</body>
</html>
