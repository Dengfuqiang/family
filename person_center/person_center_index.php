<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
	
?>
		<link rel="stylesheet" type="text/css" href="../css/person_center/person_center_index.css"/>
			<article id='account_contain'>
				<section class="nav_left">
					<ul>
						<li><a href="">基本资料</a></li>
						<li><a href="">升级会员</a></li>
						<li><a href="">我的订单</a></li>
						<li><a href="">我的钱包</a></li>
						<li><a href="">我的收藏</a></li>
						<li><a href="">收货地址</a></li>
						<li><a href="">帮组中心</a></li>
						<li><a href="">意见反馈</a></li>
					</ul>
				</section>
				<section class="info_right">
					<div class="info_money_ct">
						<div class="user_info">
							<a href="" class="pic_ct">
								<img src="../img/120_120-(3)_02.png" alt="" />
								<span></span>
							</a>
							<div class="info">
								<h2 v-text='data.userInfo.name'> <span></span></h2>
								<p class="address"  >{{data.address.name+data.address.detailaddrass}}[<a href="">修改</a>]</p>
							</div>
						</div>
						<div class="cash">
							<p class="my_price">我的余额</p>
							<p>￥<span  v-text='data.userInfo.balance'></span></p>
						</div>
					
					</div>
					<h3>我的订单</h3>
					<div class="my_order" >
						<h4>订单编号：{{data.order.order_code}}</h4>
						<div class="commodity_info" v-for='item in data.order_cmd'>
							<a class="info_ct">
								<span class="cmd_pic_ct">
									<img src="../img/120_120-(3)_02.png"/>
								</span>
								<span class="cmd_title" v-text=''>
									百草味 夏威夷果200g*3袋奶油 味  夏威夷果
								</span>
								<span class="cmd_num">
									x{{item.cmd_count}}
								</span>
								<span class="pay_way">
									<p class="price">￥500.00</p>
									<span>在线支付</span>
								</span>
							</a>
							<div class="cmd_status">
								<p class="status">
									<a href="" class="" v-if='data.order.order_status==1'>等待付款</a>
								</p>
								<p>
									<a href="" class="cmd_detail_bt">订单详情</a>
								</p>

							</div>
							<div class="operation">
								<a href="">立即付款</a>
							</div>
						</div>
					</div>
					<h3>我的收藏</h3>
					<div class="my_favour">
						<ul>
							<li>
								<a href=""><img src="../img/120_120-(3)_02.png" alt="" /></a>
								<h5>同仁堂牌  枸杞子枸杞王500g</h5>
								<p><span class="price">￥59.00</span><del>￥79.00</del></p>
								<a href="" class="add_shopping_car">加入购物车</a>
							</li>
							<li>
								<a href=""><img src="../img/120_120-(3)_02.png" alt="" /></a>
								<h5>同仁堂牌  枸杞子枸杞王500g</h5>
								<p><span class="price">￥59.00</span><del>￥79.00</del></p>
								<a href="" class="add_shopping_car">加入购物车</a>
							</li>
							<li>
								<a href=""><img src="../img/120_120-(3)_02.png" alt="" /></a>
								<h5>同仁堂牌  枸杞子枸杞王500g</h5>
								<p><span class="price">￥59.00</span><del>￥79.00</del></p>
								<a href="" class="add_shopping_car">加入购物车</a>
							</li>
							<li>
								<a href=""><img src="../img/120_120-(3)_02.png" alt="" /></a>
								<h5>同仁堂牌  枸杞子枸杞王500g</h5>
								<p><span class="price">￥59.00</span><del>￥79.00</del></p>
								<a href="" class="add_shopping_car">加入购物车</a>
							</li>
						</ul>
					</div>
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
				<?php
					header("content-type:text/html;charset=utf-8");
					require_once '../php/mysql.class.php';
					$mysql = new MySQL('localhost','root','','family');
					if(!isset($_SESSION['phone'])){
						echo 'var data=0;';exit;
					}
					$phone=$_SESSION['phone'];
					$res= $mysql->table('users')->where("phone={$phone}")->select();
					//$phone=['0']['phone'];
					$defautl_address=$mysql->table('user_address')->where("phone={$phone} and `default`=1")->select();
					$order=$mysql->table('user_order')->where("phone={$phone}")->limit(0,1)->select();
					$order_code=$order[0]['order_code'];
					$order_commodity=$mysql->table('order_commodity')->where("order_code={$order_code}")->limit(0,2)->select();
					$arr=['userInfo'=>$res[0],'address'=>$defautl_address[0],'order'=>$order[0],'order_cmd'=>$order_commodity];
					echo 'var data='. json_encode($arr).";";
					?>
			</script>
			<script type="text/javascript">
				if(!data){
					alert('请先登录！');
					location.href='../index/index.php';
				}
				var vm =new Vue({
					el:'#account_contain',
					data:{
						data:data
					}
				})
			</script>
	</body>
</html>
