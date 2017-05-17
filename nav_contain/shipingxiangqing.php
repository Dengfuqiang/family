<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/foodxianqing.css"/>
			<div id="beatifulBody">
				<ul id="bt_right">
					<h4>同类热卖</h4>
					<li v-for='item in data[1]'>
						<a href="###"><img :src="item.pic" alt="" /></a>
						<h2 v-text='item.title'></h2>
						<span class="price">￥<i  v-text="item.salesPrice"></i></span>
					</li>
				</ul>
				<div id="beatiful_inner">
					<ul>
						<li class="childLi pictureAndInformation">
							<div id="picture_watch">
								<a class="bigPicture" href="###"><img  :src="data[0][0].pic" alt="" /></a>
								<a href="###"><img :src="data[0][0].pic" alt="" /></a>
							</div>
							<div id="information">
								<ul>
									<li><h2 v-text='data[0][0].title'></h2></li>
									<li class="priceFrame">
										<i>原价<del>￥{{data[0][0].marketPrice}}</del><i>
										<span class="price">
											￥{{data[0][0].salesPrice}}
										</span>
									</li>
									<li class="xianliang">限量：<span v-text='data[0][0].salesCount'></span><span class="speli_span">|</span >销量：<span v-text='data[0][0].sellerCount'></span><span class="speli_span2">|</span>限时：{{dd}}天{{hh}}时{{mm}}分{{ss}}秒</li>
									<li class="guige">规格<a href="javascript:void(0)">200g x2</a><a href="javascript:void(0)">400g x2</a></li>
									<li class="shuliang">
										数量 <span><input type="text" name="shuliang" id="shuliang" value="1" v-model='cmdCount' /><a id="add_cont" @click='addCount()' href="javascript:void(0)"></a><a id="reduce_cont" @click='reduceCount()' href="javascript:void(0)"></a></span>件
									</li>
									<li class="buying"><a href="javascript:void(0)" @click='toBuy()'>立即购买</a><a  class="mashangmai" href="javascript:void(0)" @click='toShoppingCar()'>加入购物车</a></li>
									<li class="sharefriend"><span href="javascript:void(0)">分享</span><span class="spelice_span">|</span><span class="shouchang" href="javascript:void(0)" @click='shouCang()'>收藏</span></li>
								</ul>
							</div>

						</li>
						<li class="childLi">
							<span class="spInformation">
								<a href="###">
									<h2 class="active_h2">产品详情</h2>
								</a>
								<!--<a href="###">
									<h2>用户评价</h2>
								</a>-->
							</span>
							<div id="" v-html='data[0][0].content'>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<?php
				include '../public/public_footer.php';
			?>
		</div>
		<script type="text/javascript" src="../js/vue.js" ></script>
		<script type="text/javascript" src="../js/jquery-2.2.2.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript">
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[0].className='';
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[1].className='active_nav';
			//var cmdId = location.search.split('=')[1];
			var arr=[];
			var endTime=0;
			location.search.split('&').forEach(function(k,v){
				arr[v]=k.split('=')[1]
			})
			var url='../php/getData/getDetailData.php?table='+arr[0]+'&id='+arr[1];
			var vm;
			Vue.http.get(url).then(function(res){
				var res =JSON.parse(res.bodyText );
				console.log(res);
				 vm=new Vue({
					el:'#beatifulBody',
					data:{
						data:res,
						cmdCount:1,
						dd:0,
						hh:0,
						mm:0,
						ss:0
					},
					methods:{
						toBuy:function(){
							var obj={
								'0':{
									'0':{}
								}
							};
							console.log(this.data[0][0]);
							obj['0']['0']['0']=this.data[0][0];
							obj['0']['0'].count=this.cmdCount;
							obj['allPrice']=this.cmdCount*this.data[0][0].salesPrice;
							var data = $.param(obj);
							location.href='../life_food/to_buy.php?'+data;
						},
						addCount:function(){
							this.cmdCount++;
							var maxCount=this.data[0][0].salesCount;
							if(this.cmdCount>maxCount){
								this.cmdCount=maxCount;
							}
						},
						reduceCount:function(){
							this.cmdCount--;
							if(this.cmdCount<1){
								this.cmdCount=1;
							}
						},
						toShoppingCar:function(){
							var url='../php/shopping/addToShoppingCar.php?category='+this.data[0][0].category+'&id='+this.data[0][0].id+'&count='+this.cmdCount+'&table='+arr[0];
							this.$http.get(url).then(function(res){
								res=JSON.parse(res.bodyText);
								console.log(res)
								if(!res.code){
									alert(res.msg);
									location.href='../index/login.html';
								}else{
									alert(res.msg);
								}
							},function(err){
								
							});
						},
						shouCang:function(){
							var url='../php/shopping/addToFavour.php?id='+arr[1];
							this.$http.get(url).then(function(res){
								res=JSON.parse(res.bodyText);
								if(res.code==2){
									alert(res.msg);
									location.href='../index/login.html';
								}
								alert(res.msg);
							},function(err){
								
							});
						}
					}
				})
			}, function(res){
				console.log(res);
			});
				function ShowCountDown(year,month,day)
	        {
	            var now = new Date();
	            var endDate = new Date(year, month, day);
	            var leftTime=endDate.getTime()-now.getTime();
	            var dd = parseInt(leftTime / 1000 / 60 / 60 / 24, 10);//计算剩余的天数
	            var hh = parseInt(leftTime / 1000 / 60 / 60 % 24, 10);//计算剩余的小时数
	            var mm = parseInt(leftTime / 1000 / 60 % 60, 10);//计算剩余的分钟数
	            var ss = parseInt(leftTime / 1000 % 60, 10);//计算剩余的秒数
	            vm.dd = checkTime(dd);
	            vm. hh = checkTime(hh);
	             vm.mm = checkTime(mm);
	             vm.ss = checkTime(ss);//小于10的话加0

	        }
	        function checkTime(i)
	        {
	            if (i < 10) {
	                i = "0" + i;
	            }
	            return i;
	        }
	        window.setInterval(function(){ShowCountDown(2018,4,20);}, 1000);
		</script>
	</body>
</html>
