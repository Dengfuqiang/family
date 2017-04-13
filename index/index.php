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
						echo "<span><a href='javascript:;'>".$useInfo['username']."，您好</a></span>";
					}else{
						echo "<span>[<a href='login.html'>登录</a>]</span><span>[<a href='register.html'>注册</a>]</span>";
						
					}?>
					<span class="shuGang">|</span>
					<span><a href="../person_center/person_center_index.php">我的账号</a></span>
					<span class="shuGang">|</span>
					<span><a href="###">生活一家app下载</a></span>
				</div>
				<div class="seacherKuang">
					<div class="seacherInner">
						<a href="###" class="familyLogo">

						</a>
						<select id="addressSelect" name="addressSelect">
							<option value="广州">广州</option>
						</select>
						<input type="text" name="searchText" id="searchText" value="" /><input type="submit" name="searchBt" id="searchBt" value="搜索" />
						<div class="kefuShoppingCar">
							<a href="###" id="kefu">一键客服</a><a href="###" id="shoppingCar">购物车</a>
						</div>
					</div>

				</div>
				<div class="headerNav">
					<div class="headerNavInner">
						<ul>
							<li><a class="active_nav" href="index/index.php">首页</a></li>
							<li><a href="../nav_contain/beautifulLife.php">精彩生活</a></li>
							<li><a href="../nav_contain/lifeFood.php">生活食品</a></li>
							<li><a href="###">生活用品</a></li>
							<li><a href="###">生活家居</a></li>
							<li><a href="###">会员杂锦</a></li>
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
							<img src="../img/lifepicture (2).jpg"/>
							<img src="../img/lifepicture (2).jpg"/>
							<img src="../img/lifepicture (2).jpg"/>
							<img src="../img/lifepicture (2).jpg"/>
						</div>
						<div id="lunbobtn" class="lunboBtn">
							<a class="lunboBtns lunboBtnaddclass" href="###"></a>
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
							<li><a href="###"><img src="../img/lifepicture (3).jpg"/></a></li>
							<li><a href="###"><img src="../img/lifepicture (4).jpg"/></a></li>
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
								<a href="###">更多信息 >></a>
							</span>
						</li>
						<li class="bodyliFirst">
							<a href="###" v-for='item in cmd_info[0]'><img :src="item.pic" alt="" /></a>
						</li>
					</ul>
					<ul>
						<li  class="ShengHuoShiPing">
							<h3>生活食品</h3>
							<p>为生活 添实惠</p>
							<ul>
								<li><a href="###">传统糕点</a></li>
								<li><a href="###">膨化食品</a></li>
								<li><a href="###">无糖食品</a></li>
								<li><a href="###">传统糕点</a></li>
								<li><a href="###">膨化食品</a></li>
								<li><a href="###">无糖食品</a></li>
								<li><a href="###">传统糕点</a></li>
								<li><a href="###">膨化食品</a></li>
								<li><a href="###">无糖食品</a></li>
							</ul>
						</li>
						<li class="life_food_cmd">
							<a href="###" v-for='item in cmd_info[1]'>
								<h3 class="title" v-text='item.title'></h3>
								<img :src="item.pic" alt="" />
							</a>
						</li>
					</ul>
					<ul>
						<li  class="ShengHuoYongPing">
							<h3>生活用品</h3>
							<p>为生活 理舒适</p>
							<ul>
								<li><a href="###">厨房用品</a></li>
								<li><a href="###">日常用品</a></li>
								<li><a href="###">创意用品</a></li>
								<li><a href="###">厨房用品</a></li>
								<li><a href="###">日常用品</a></li>
								<li><a href="###">创意用品</a></li>
								<li><a href="###">厨房用品</a></li>
								<li><a href="###">日常用品</a></li>
								<li><a href="###">创意用品</a></li>
							</ul>
						</li>
						<li class="life_articles">
							<a href="###" v-for='item in cmd_info[2]'>
								<h3 class="title" v-text='item.title'></h3>
								<img :src="item.pic" alt="" />
							</a>
						</li>
					</ul>
					<ul>
						<li  class="ShengHuoJiaJu">
							<h3>生活家居</h3>
							<p>为生活 享生活</p>
							<ul>
								<li><a href="###">厨房用品</a></li>
								<li><a href="###">日常用品</a></li>
								<li><a href="###">创意用品</a></li>
								<li><a href="###">厨房用品</a></li>
								<li><a href="###">日常用品</a></li>
								<li><a href="###">创意用品</a></li>
								<li><a href="###">厨房用品</a></li>
								<li><a href="###">日常用品</a></li>
								<li><a href="###">创意用品</a></li>
							</ul>
						</li>
						<li class="life_furniture">
							<a href="###" v-for='item in cmd_info[3]'>
								<h3 class="title" v-text='item.title'></h3>
								<img :src="item.pic" alt="" />
							</a>
						</li>
					</ul>
					<p class="teMaititle">特卖专区 Sales</p>
					<ul class="teMaiSals">
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="###">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="###">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="###">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="###">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="###">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="###">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
						<li><img src="../img/gouyugao.jpg" alt="">
								<h2><a href="###">[10月抢购预告] 荣耀乐檬大神爆款 惊爆价</a></h2>
							</img></li>
						<li><img src="../img/jingbaokaiqiang.jpg" alt="">
								<h2><a href="###">[劲爆开抢] 宝洁大礼包优惠前所未有</a></h2>
							</img></li>
					</ul>
				</div>
			</div>

			<div id="familyFooter">
				<a href="index.html">首页</a><span>|</span>
				<a href="../beautifulLife.html">精彩生活</a><span>|</span>
				<a href="../lifeFood.html">生活食品</a><span>|</span>
				<a href="###">生活用品</a><span>|</span>
				<a href="###">生活家居</a><span>|</span>
				<a href="###">会员杂锦</a><span>|</span>
				<a href="###">一键客服</a><span>|</span>
				<a href="../aboutOur.html">关于我们</a>
				<p>CopyrightO 生活一家 2007-2015, All Rights Reserved</p>
			</div>	
		</div>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type='text/javascript' src='../js/indexjs.js' ></script>
	</body>
</html>
