<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
?>
	<link rel="stylesheet" type="text/css" href="../css/payOrder.css"/>
	<style type="text/css">
		html,body{
			width: 100%;
			height: 100%;
		}
	</style>
		<div id="container" class="container">
			<h2>订单信息</h2>
			<p>订单编号：<span v-text='orderCode'></span></p>
			<p>支付金额：<span v-text='pirce'></span></p>
			<h2>支付方式</h2>
			<div id="pay_way">
				<div @click='tab()' :class="{selected:balanceFlag}">
					<img src="../img/yuer.png"  />
					余额支付
				</div>
				<div   @click='tab2()' :class="{selected:aliFlag}">
					<img src="../img/zhifubao.jpg" />
					支付宝支付
				</div>
			</div>
			<p>支付密码：<input type="password" id="" name="" placeholder="请输入支付密码" v-model='payPwd'/></p>
			<div >
				<a href="javascript:void(0);" id="to_pay" @click='to_pay()'>确认支付</a>
			</div>
			<div class="balance">
				余额：<span v-text='balance'></span>
			</div> 
		</div>
	<?php
		include '../public/public_footer.php';
		?>
	<script type="text/javascript" src="../js/vue.js" ></script>
	<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
	<script type="text/javascript">
		Vue.http.options.emulateJSON = true;
		var orderCode=location.search.replace('?order_code=','');
		var url='../php/createOrder/getOrderInfo.php?order_code='+orderCode;
		Vue.http.get(url).then(function(res){
				res=JSON.parse(res.bodyText);
				if(res.code==0){
					alert('您还没登录！请先登录~');
					location.href='../index/login.html';
				}
				var vm= new Vue({
					el:'#container',
					data:{
						orderCode:orderCode,
						pirce:res.price,
						balance:res.balance,
						balanceFlag:true,
						aliFlag:false,
						payPwd:'',
					},
					methods:{
						tab:function(){
							this.balanceFlag=true;
							this.aliFlag=false;
						},
						tab2:function(){
							this.aliFlag=true;
							this.balanceFlag=false;
						},
						to_pay:function(){
							if(!Trim(this.payPwd,'g') ){
								alert('请输入支付密码');
								return false;
							}
							
							var url='../php/createOrder/deductMoney.php?order_code='+orderCode+'&purse_pwd='+encodeURIComponent(this.payPwd);
							this.$http.get(url).then(function(res){
								res=JSON.parse(res.bodyText);
								if(res.code==0){
									alert('您还没登录！请先登录~');
									//location.href='../index/login.html';
								}else if(res.code==1){
									alert(res.msg);
									location.href='pay_success.php?order_code='+orderCode;
								}else if(res.code==6){
									alert(res.msg);
									location.href='../person_center/person_info.php?tab=child0&selectNum=0';
								}else if(res.code==3){
									alert(res.msg);
								}
								else if(res.code==7){
									alert(res.msg);
								}
								console.log(res);
							}, function(res){
								console.log(res);
							});
						}
					}
				})
			}, function(res){
				console.log(res);
			});
			function Trim(str,is_global)
	        {
	            var result;
	            result = str.replace(/(^\s+)|(\s+$)/g,"");
	            if(is_global.toLowerCase()=="g")
	            {
	                result = result.replace(/\s/g,"");
	             }
	            return result;
			}
	</script>
	</body>
</html>
