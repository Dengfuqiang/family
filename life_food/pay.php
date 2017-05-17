<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
?>
	<style type="text/css">
		html,body{
			width: 100%;
			height: 100%;
		}
		img{
			display: block;
			width: 240px;
			height: 300px;
			
			margin: 78px auto;
		}
	</style>
		<img src="../img/1493722188878.jpg"/>
	<?php
		include '../public/public_footer.php';
		?>
	<script type="text/javascript">
		document.getElementsByTagName('img')[0].onclick=function(){
			location.href='pay_success.php?order_code='+location.search.replace('?order_code=','');
		}
	</script>
	</body>
</html>
