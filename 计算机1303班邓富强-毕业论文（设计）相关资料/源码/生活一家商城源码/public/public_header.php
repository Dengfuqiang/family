
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<?php 
			$path = "http://localhost/family";
			echo "<link rel='stylesheet' type='text/css' href='$path/css/familyHeader.css'/>";
			?>
	
	</head>
	<body>
		<div id="familyAndContain">
			<header id="familyHeader">
				<div id="loginNav">
					<?php
					if(isset($useInfo['username'])){
						echo "<span><a href='javascript:;'>".$useInfo['username']."，您好</a>&emsp;<a href='../php/index/login_on.php'>注销登录</a></span>";
					}else{
						echo "<span>[<a href='../index/login.html'>登录</a>]</span><span>[<a href='../index/register.php'>注册</a>]</span>";
						
					}?>
					<span class="shuGang">|</span>
					<span><a href="../person_center/person_center_index.php" target="_blank">我的账号</a></span>

				</div>
				<div class="seacherKuang">
					<div class="seacherInner">
						<a href="../index/index.php" class="familyLogo">

						</a>
						<input type="text" name="searchText" id="searchText" value="" /><input type="submit" name="searchBt" id="searchBt" value="搜索" />
						<div class="kefuShoppingCar">
							<a href="../person_center/person_info.php?tab=child6&selectNum=6" id="kefu">一键客服</a><a href="../life_food/shopping_car.php" id="shoppingCar">购物车</a>
						</div>
					</div>

				</div>
				<div class="headerNav">
					<div class="headerNavInner">
						<ul>
							<li><a class="active_nav" href="../index/index.php">首页</a></li>
							<li><a href="../nav_contain/beautifulLife.php">精彩生活</a></li>
							<li><a href="../nav_contain/lifeFood.php">生活食品</a></li>
							<li><a href="../nav_contain/lifeArctiles.php">生活用品</a></li>
							<li><a href="../nav_contain/lifeFurniture.php">生活家居</a></li>
							<li><a href="###">会员杂锦</a></li>
							<li><a href="../nav_contain/aboutOur.php">关于我们</a></li>
						</ul>
					</div>
				</div>
			</header>
			<script type="text/javascript">
				
				 document.getElementById('searchBt').onclick=function(){
				 	 var keys=encodeURIComponent(document.getElementById('searchText').value);
				 	location.href='../nav_contain/commodityList.php?keys='+keys;
				 }
			</script>