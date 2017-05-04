<?php
	session_start();
	$useInfo=$_SESSION;
	if(!isset($_SESSION['user_name'])){
		if(!isset($_SESSION['phone'])){
			$res=[
				'msg'=>'请先登录',
				'code'=>0
			];
			echo '<script>var data = '.json_encode($res).'</script>';exit;
		}
	}
	include '../public/public_header.php';
	require_once '../php/mysql.class.php';
	$mysql = new MySQL('localhost','root','','family');
	$order_code=$_GET['order_code'];
	$res = $mysql->table('user_order')->where("order_code={$order_code}")->select();
	if(empty($res)){
		exit;
	}
	 $cmd= $mysql->table('order_commodity')->where("order_code={$res[0]['order_code']}")->select();
	$address = $mysql->table('user_address')->where("id={$res[0]['address']}")->select();
	$res['cmd']=$cmd;
	$res['address']=$address[0];
?>
		<link rel="stylesheet" type="text/css" href="../css/person_center/order_detail.css"/>
			<article>
				<section class="order_status" v-if='orderData[0].order_status==1'>
					<p>当前订单状态： 宝贝已拍下， 请在3天 内付款；若未及时付款，系统将自动取消订单 </p>
					<a href="../life_food/pay.php" class="to_pay_money">立即支付</a><a href="javascript:void(0)" class="cancel_order"   @click='cencelOrder()'>取消订单</a>
				</section>
				<section class="order_status" v-if='orderData[0].order_status==2'>
					<p>当前订单状态： 待发货， 保证48小时内发货; </p>
					<a href="javascript:void(0)" class="cancel_order"  @click='cencelOrder()'>取消订单</a>
				</section>
				<section class="order_status" v-if='orderData[0].order_status==3'>
					<p>当前订单状态： 待收货， 商品已经发货，请及时关注物流信息； </p>
					<a href="javascript:void(0)" class="to_pay_money" @click='getCmd()'>收货</a>
				</section>
				<section class="order_status" v-if='orderData[0].order_status==4'>
					<p>当前订单状态： 已完成 </p>
					<a href="javascript:void(0)" class="to_pay_money" @click='sellerAfterServer()'>申请售后</a>
				</section>
				<section class="order_status" v-if='orderData[0].order_status==5'>
					<p>当前订单状态： 售后处理中 </p>
					<a href="javascript:void(0);" class="to_pay_money" @click='cencelSale()'>取消售后</a>
				</section>
				<section class="order_info">
					<h2>订单信息</h2>
					<div class="order_info_ct">
						<p>收货地址：{{orderData.address.username}}，{{orderData.address.phone}}，{{orderData.address.address}} {{orderData.address.detailaddress}}</p>
						<p>订单编号： {{orderData[0].order_code}} </p>
						<p>创建时间： {{this.formatDate(orderData[0].create_time)}} </p>
						<div class="beizhu_ct">
							备注：
							<textarea name="" rows="" cols="" v-text='orderData[0].liuyan' readonly="readonly"></textarea>
						</div>
					</div>
				</section>
				<section class="commodity_info">
					<h2>商品信息</h2>
					<div class="commodity_info_ct">
						<div class="property box">
							<div class="item item2 "><span>商品详情</span></div>
							<div class="item">规格</div>
							<div class="item">数量</div>
							<div class="item">单价（元）</div>
							<div class="item">订单状态</div>
							<div class="item">商品总价</div>
						</div>
						<ul class="commodity_list ">
							<li class="box" v-for='item in orderData.cmd'>
								<div class="cmd_info item">
									<a href="#" class="box">
										<div><img :src="item.commodity_img" alt=""></div>
										<div class="item cd_title"><span v-text='item.commodity_title'>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
									</a></div>
								<div class="item ">￥<span class="price" v-text='item.sales_price'>500</span></div>

								<div class="item">x{{item.cmd_count}}</div>
								<div class="item before">￥{{item.sales_price}}<p>在线支付</p></div>
								<div class="item after  order_before" v-if='orderData[0].order_status==1'>等待付款</div>
								<div class="item after  order_before" v-if='orderData[0].order_status==2'>待发货</div>
								<div class="item after  order_before" v-if='orderData[0].order_status==3'>待收货</div>
								<div class="item after  order_before" v-if='orderData[0].order_status==4'>已完成</div>
								<div class="item after  order_before" v-if='orderData[0].order_status==5'>售后处理中</div>
								<div class="item">￥{{item.all_price}} <p>（运费：￥<span>10</span>）</p></div>
							</li>
						
						</ul>
						<div class="all_money">
							<span class="order_all_count">
								订单总价：<i>￥{{orderData[0].order_all_price}}</i> 元
							</span>
						</div>
					</div>
				</section>
			</article>
			<div class="add_address_window" v-if='sellerAfter'>
				<div class="add_address_inner">
					<h3>使用新地址 <a href="javascript:void(0)" class="close_win" @click='closeWin()'></a></h3>
					<div class="add_info">
						<form id="afterData" name="afterData">
							<label><span>退款原因<i>*</i></span><input type="text" name="back_reason" id="" value="" placeholder="请输入退款原因"></label>
							<label><span>退款金额<i>*</i></span><input type="text" name="back_price" id="" value="" placeholder="请输入退款金额"></label>
							
							<label><span>退款说明<i>*</i></span><textarea name="back_info" rows="" cols="" id="back_cmd_detail" placeholder="请输入退款说明"></textarea>  </label>
							<label><span>上传凭证<i>*</i></span><a class="select_pic_bt" href="javascript:void(0);"><input type="file" name="upfile" id="upfile" value="" enctype="multipart/form-data"/><span>上传退款凭证</span></a></label>
							
							<input type="submit" value="提交" id="confirm_cmd_back" @click.prevent='submitData()'>
						</form>
					</div>
				</div>
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
			<script type="text/javascript" src="../js/vue.js" ></script>
			<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
			<script type="text/javascript">
			<?php
					echo 'var data = '.json_encode($res);
			?>
			</script>
			<script type="text/javascript">
				if(data.code==0){
					alert(data.msg);
					location.href='../index/login.html';
				}else{
					var vm =new Vue({
						el:'#familyAndContain',
						data:function(){
							return{
								orderData:data,
								sellerAfter:false
							};
						},
						methods:{
							cencelSale:function(){
								if(confirm('是否确认取消售后！')){
									var url='../php/getData/getOrder.php?fc=cencelSale&order_code='+this.orderData[0].order_code;
										this.$http.get(url).then(function(res){
										res=JSON.parse(res.bodyText);
										console.log(res)
										if(res.code==1){
											alert(res.msg);
											this.orderData[0].order_status=4;return;
										}
										alert(res.msg);
									}, function(err){
										
									});
								}
							},
							submitData:function(){
								var formData = new FormData(document.getElementById('afterData'));
								formData.append('order_code',this.orderData[0].order_code);
								var url='../php/getData/getOrder.php?fc=createAfterOrder&order_code='+this.orderData[0].order_code;
										this.$http.post(url,formData).then(function(res){
										res=JSON.parse(res.bodyText);
										if(res.code==1){
											alert(res.msg);
											this.sellerAfter=false;
											this.orderData[0].order_status=5;
											return;
										}
										alert(res.msg);
									}, function(err){
										
									});
							},
							sellerAfterServer:function(){
								this.sellerAfter=true;
							},
							closeWin:function(){
								this.sellerAfter=false;
							},
							formatDate:function (ns) {  
							    var d = new Date(ns*1000);  
							    var dformat = [ d.getFullYear(), d.getMonth() + 1, d.getDate() ].join('-')   
							            + ' ' + [ d.getHours(), d.getMinutes(), d.getSeconds() ].join(':');  
							    return dformat;  
							},
							cencelOrder:function(){
								if(confirm('是否确认取消订单！')){
									var url='../php/getData/getOrder.php?fc=cencelOrder&order_code='+this.orderData[0].order_code;
										this.$http.get(url).then(function(res){
										res=JSON.parse(res.bodyText);
										console.log(res)
										if(res.code==1){
											alert(res.msg);
											location.href='../person_center/person_info.php';
											
										}
									}, function(err){
										
									});
								}
							},
							getCmd:function(){
								if(confirm('是否确认收货！')){
									var url='../php/getData/getOrder.php?fc=getCmd&order_code='+this.orderData[0].order_code;
										this.$http.get(url).then(function(res){
										res=JSON.parse(res.bodyText);
										console.log(res)
										if(res.code==1){
											alert(res.msg);
											location.href='../person_center/person_info.php';
											
										}
									}, function(err){
										
									});
								}
							}
						}
					});
				}
			</script>
	</body>
</html>
