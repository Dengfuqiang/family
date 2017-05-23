<?php
	session_start();
	$useInfo=$_SESSION;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel='stylesheet' type='text/css' href='../css/familyHeader.css'/>
		<link rel='stylesheet' type='text/css' href='../css/index/indexCss.css'/>
		<script type='text/javascript' src='../js/lunbo.js' ></script>
		<script type="text/javascript" src="../js/vue.js" ></script>
	</head>
	<body>
		<div id="familyAndContain">
			<header id="familyHeader">
				<div id="loginNav">
					<?php
					if(isset($useInfo['username'])){
						echo "<span><a href='javascript:;'>".$useInfo['username']."，您好</a>&emsp;<a href='../php/index/login_on.php'>注销登录</a></span>";

					}else{
						echo "<span>[<a href='login.html'>登录</a>]</span><span>[<a href='register.php'>注册</a>]</span>";
						
					}?>
					<span class="shuGang">|</span>
					<span><a href="../person_center/person_center_index.php" target="_blank">我的账号</a></span>


				</div>
				<div class="seacherKuang">
					<div class="seacherInner">
						<a href="javascript:void(0);" class="familyLogo">

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
							<li><a class="active_nav" href="javascript:void(0)">首页</a></li>
							<li><a href="../nav_contain/beautifulLife.php">精彩生活</a></li>
							<li><a href="../nav_contain/lifeFood.php">生活食品</a></li>
							<li><a href="../nav_contain/lifeArctiles.php">生活用品</a></li>
							<li><a href="../nav_contain/lifeFurniture.php">生活家居</a></li>
							<li><a href="javascript:void(0);">会员杂锦</a></li>
							<li><a href="../nav_contain/aboutOur.php">关于我们</a></li>
						</ul>
					</div>
				</div>
			</header>
			<div id="familyLunbo">
				<div class="familyLunboInner">
					<div id="lunbo_outer" class="lunboPicture">
						<div id="lunbo_inner">
							<img src="../img/lifepicture (2).jpg"/>
							<img src="http://www.gdshyj.com/shoppic/2017/3/21/dc09058d-e2a4-4ace-a1b5-424e5fe1d5b1.jpg"/>
							<img src="http://www.gdshyj.com/shoppic/2017/1/10/ebb93b84-d835-42d4-925c-5c34a255de56.jpg"/>
							<img src="http://www.gdshyj.com/shoppic/2017/3/27/2d7cfbb0-7caf-46b9-9df1-e46ca84a8a3a.jpg"/>
							<img src="http://www.gdshyj.com/shoppic/2017/3/2/01d45e4b-588f-4aba-81ed-9308372f47cc.jpg"/>
						</div>
						<div id="lunbobtn" class="lunboBtn">
							<a class="lunboBtns lunboBtnaddclass" href="javascript:void(0);"></a>
							<a class="lunboBtns" href="javascript:void(0)"></a>
							<a class="lunboBtns" href="javascript:void(0)"></a>
							<a class="lunboBtns" href="javascript:void(0)"></a>
						</div>
						<div id="preAndNext">
							<a id="pre_btn" href="javascript:void(0)">&lt;</a>
							<a id="next_btn" href="javascript:void(0)">&gt;</a>
						</div>
					</div>
					<div class="lunboRight">
						<ul>
							<li><a href="javascript:void(0);"><img src="../img/lifepicture (3).jpg"/></a></li>
							<li><a href="javascript:void(0);"><img src="../img/lifepicture (4).jpg"/></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="familyBody">
				<div class="familyBodyInner">
					<ul>
						<li class="jiCaiShengHuo">
							<h3>精彩生活</h3>
							<p>分员专享</p>
							<span class="pingPai">
								<a href="javascript:void(0);">更多信息 >></a>
							</span>
						</li>
						<li class="bodyliFirst">
							<a href="javascript:void(0);" @click='to_beautifu_inner(item)'  v-for='item in beautity_life'><img :src="item.pic" alt="" /></a>
						</li>
					</ul>
					<ul  >
						<li  class="ShengHuoShiPing">
							<h3>生活食品</h3>
							<p>为生活 添实惠</p>
							<ul @click='getDate($event,"life_food",1)'>
								<li><a href="javascript:void(0);" id="224">中外名酒</a></li>
								<li><a href="javascript:void(0);" id="225">茗茶月饼</a></li>
								<li><a href="javascript:void(0);" id="226">休闲食品</a></li>
								<li><a href="javascript:void(0);" id="229">奶粉</a></li>
								<li><a href="javascript:void(0);" id="230">饮品</a></li>
								<li><a href="javascript:void(0);" id="312">生鲜蔬果</a></li>
								<li><a href="javascript:void(0);" id="313">干货</a></li>
								<li><a href="javascript:void(0);" id="379">保健品</a></li>
								<li><a href="javascript:void(0);" id="402">特产类</a></li>
							</ul>
						</li>
						<li class="life_food_cmd">
							<a href="javascript:void(0);"  @click='to_detail(item,"life_food")' v-for='item in life_food'>
								<h3 class="title" v-text='item.title'></h3>
								<img :src="item.pic" alt="" />
							</a>
						</li>
					</ul>
					<ul  >
						<li  class="ShengHuoYongPing">
							<h3>生活用品</h3>
							<p>为生活 理舒适</p>
							<ul @click='getDate($event,"life_articles",2)'>
								<li><a href="javascript:void(0);" id="232">小家电</a></li>
								<li><a href="javascript:void(0);" id="233">大家电</a></li>
								<li><a href="javascript:void(0);" id="234">手机数码</a></li>
								<li><a href="javascript:void(0);" id="336">名表首饰</a></li>
								<li><a href="javascript:void(0);" id="337">化妆品</a></li>
								<li><a href="javascript:void(0);" id="370">服装</a></li>
								<li><a href="javascript:void(0);" id="371">女装</a></li>
								<li><a href="javascript:void(0);" id="372">母婴</a></li>
								<li><a href="javascript:void(0);" id="373">鞋靴箱包</a></li>
								<li><a href="javascript:void(0);" id="374">运动户外</a></li>
								<li><a href="javascript:void(0);" id="375">汽车用品</a></li>
								<li><a href="javascript:void(0);" id="380">日常用品</a></li>
								<li><a href="javascript:void(0);" id="395">床上用品</a></li>
							</ul>
						</li>
						<li class="life_articles">
							<a href="javascript:void(0);"  @click='to_detail(item,"life_articles")'   v-for='item in life_articles'>
								<h3 class="title" v-text='item.title'></h3>
								<img :src="item.pic" alt="" />
							</a>
						</li>
					</ul>
					<ul  >
						<li  class="ShengHuoJiaJu">
							<h3>生活家居</h3>
							<p>为生活 享生活</p>
							<ul @click='getDate($event,"life_furniture",3)'>
								<li><a href="javascript:void(0);" id="239">厨具</a></li>
								<li><a href="javascript:void(0);" id="240">家具</a></li>
								<li><a href="javascript:void(0);" id="241">灯具</a></li>
								<li><a href="javascript:void(0);" id="242">五金</a></li>
								<li><a href="javascript:void(0);" id="243">饰品</a></li>
							</ul>
						</li>
						<li class="life_furniture">
							<a href="javascript:void(0);"  @click='to_detail(item,"life_furniture")'  v-for='item in life_furniture'>
								<h3 class="title" v-text='item.title'></h3>
								<img :src="item.pic" alt="" />
							</a>
						</li>
					</ul>
					<p class="teMaititle">特卖专区 Sales</p>
					<ul class="teMaiSals">
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="javascript:void(0);">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="javascript:void(0);">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="javascript:void(0);">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="javascript:void(0);">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="javascript:void(0);">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="javascript:void(0);">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="javascript:void(0);">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="javascript:void(0);">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
					</ul>
				</div>
			</div>
			<div id="familyFooter">
				<a href="../index/index.php">首页</a><span>|</span>
				<a href="../nav_contain/beautifulLife.php">精彩生活</a><span>|</span>
				<a href="../nav_contain/lifeFood.php">生活食品</a><span>|</span>
				<a href="../nav_contain/lifeArctiles.php">生活用品</a><span>|</span>
				<a href="../nav_contain/lifeFurniture.php">生活家居</a><span>|</span>
				<a href="javascript:void(0);">会员杂锦</a><span>|</span>
				<a href="../person_center/person_info.php?tab=child6&selectNum=6">一键客服</a><span>|</span>
				<a href="../nav_contain/aboutOur.php">关于我们</a>
			</div>	
		</div>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type='text/javascript' src='../js/indexjs.js' ></script>
	</body>
</html>
