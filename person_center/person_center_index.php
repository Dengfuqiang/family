<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
	
?>
		<link rel="stylesheet" type="text/css" href="../css/person_center/person_center_index.css"/>
			<article id='account_contain'>
				<section class="nav_left">
					<ul>
						<li><a href="person_info.php?tab=child0&selectNum=0">基本资料</a></li>
						<li><a href="person_info.php?tab=child1&selectNum=1">我的订单</a></li>
						<li><a href="person_info.php?tab=child2&selectNum=2">我的钱包</a></li>
						<li><a href="person_info.php?tab=child3&selectNum=3">我的收藏</a></li>
						<li><a href="person_info.php?tab=child4&selectNum=4">收货地址</a></li>
						<li><a href="person_info.php?tab=child5&selectNum=5">帮组中心</a></li>
						<li><a href="person_info.php?tab=child6&selectNum=6">意见反馈</a></li>
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
					<div class="my_order" v-for='item in data.order'>
						<h4>订单编号：{{item.order_code}}</h4>
						<div class="commodity_info" v-for='items in item.cmd_list'>
							<a class="info_ct">
								<span class="cmd_pic_ct">
									<img :src="items.commodity_img"/>
								</span>
								<span class="cmd_title" v-text='items.commodity_title'>
								</span>
								<span class="cmd_num">
									x{{items.cmd_count}}
								</span>
								<span class="pay_way">
									<p class="price" >￥{{items.all_price}}</p>
									<span>在线支付</span>
								</span>
							</a>
							<div class="cmd_status">
								<p class="status">
									<a href="javascript:void(0)" class="" v-if='item.order_status==1'>等待付款</a>
									<a href="javascript:void(0)" class="" v-if='item.order_status==2'>待发货</a>
									<a href="javascript:void(0)" class="" v-if='item.order_status==3'>待收货</a>
									<a href="javascript:void(0)" class="" v-if='item.order_status==4'>已完成</a>
									<a href="javascript:void(0)" class="" v-if='item.order_status==5'>售后处理中</a>
								</p>
								<p>
									<a href="javascript:void(0)" class="cmd_detail_bt"  @click='orderDetial(items)'>订单详情</a>
								</p>

							</div>
							<div class="operation" v-if='item.order_status==1'>
								<a href="../life_food/pay.php">立即付款</a>
								<a href="javascript:void(0)" @click='cencelOrder($parent.$index,items)'>取消订单</a>
							</div>
							<div class="operation" v-if='item.order_status==2'>
								<a href="javascript:void(0)" @click='cencelOrder($parent.$index,items)'>取消订单</a>
							</div>
							<div class="operation" v-if='item.order_status==3'>
								<a href="javascript:void(0)"  @click='getCmd($parent.$index,items)'>收货</a>
							</div>
							<div class="operation" v-if='item.order_status==4'>
							</div>
							<div class="operation" v-if='item.order_status==5'>
								<a href="javascript:void(0)">取消售后</a>
							</div>
						</div>
					</div>
					<h3>我的收藏</h3>
					<div class="my_favour">
						<ul>
							<li v-for='item in data.favour_cmd'>
								<a href="javascript:void(0);" @click='toDetail(item)'><img :src="item.pic" alt="" /></a>
								<h5 v-text='item.title'>同仁堂牌  枸杞子枸杞王500g</h5>
								<p><span class="price">￥{{item.salesPrice}}</span><del>￥{{item.marketPrice}}</del></p>
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
						echo 'var data=0;';
					}else{
					$phone=$_SESSION['phone'];
					$res= $mysql->table('users')->where("phone={$phone}")->select();
					$favour= $mysql->table('user_favour')->where("phone={$phone}")->limit(0,4)->select();
					$favour_list=[];
						//var_dump($favour);exit;
					foreach ($favour as $key => $value) {
						$cmd_id=$value['cmd_id'];
						//var_dump($cmd_id);exit;
						$sql='SELECT * FROM life_food WHERE id='.$cmd_id.' UNION SELECT * FROM life_furniture WHERE id='.$cmd_id.' UNION SELECT * FROM life_articles WHERE id='.$cmd_id;
						$favour_cmd_list= $mysql->query($sql);
						//var_dump($favour_cmd_list);exit;
						$favour_list[]=$favour_cmd_list[0];
					}
						//var_dump($favour_list);exit;
					//$phone=['0']['phone'];
					$defautl_address=$mysql->table('user_address')->where("phone={$phone} and `default`=1")->select();
					$order=$mysql->table('user_order')->where("phone={$phone}")->limit(0,5)->select();
					foreach ($order as $key => $value) {
						$order_code=$value['order_code'];
						$order_commodity=$mysql->table('order_commodity')->where("order_code={$order_code}")->select();
						$order[$key]['cmd_list']=$order_commodity;
						//var_dump($order[$key]);
					}
					$arr=['userInfo'=>$res[0],'address'=>$defautl_address[0],'order'=>$order,'favour_cmd'=>$favour_list];
					echo 'var data='. json_encode($arr).";";}
					?>
					console.log(data);
					if(!data){
						alert('请先登录！');
						location.href='../index/login.html';
					}
					var vm =new Vue({
						el:'#account_contain',
						data:{
							data:data
						},
						methods:{
							orderDetial:function(item){
								console.log(item);
								location.href='order_detail.php?order_code='+item.order_code;
							},cencelOrder:function(index,item){
								if(confirm('是否确认取消订单！')){
									var url='../php/getData/getOrder.php?fc=cencelOrder&order_code='+item.order_code;
										this.$http.get(url).then(function(res){
										res=JSON.parse(res.bodyText);
										console.log(res)
										if(res.code==1){
											alert(res.msg);
											this.data.order.splice(index,1);
											
										}
									}, function(err){
										
									});
								}
							},
							getCmd:function(index,item){
								if(confirm('是否确认收货！')){
									var url='../php/getData/getOrder.php?fc=getCmd&order_code='+item.order_code;
										this.$http.get(url).then(function(res){
										res=JSON.parse(res.bodyText);
										console.log(res)
										if(res.code==1){
											alert(res.msg);
											this.data.order[index].order_status=4;
											
										}
									}, function(err){
										
									});
								}
							},
							toDetail:function(item){
								location.href='../nav_contain/shipingxiangqing.php?category=life_food&id='+item.id;
							}
						}
					})
			</script>
	</body>
</html>


