<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/lifeFood.css"/>
			<div id="beatifulBody">
				<ul id="bt_left">
					<li v-for='item in nav' @click='getData($event,$index)' :class="{speilli:$index==nav_selected}"><a href="javascript:;" :id='item.id' v-text='item.title'></a></li>
				</ul>
				<div id="life_contain">
					<div class="food_selecter">
						<span>全部</span>
						<span class="active_span">销量<a href="javascript:void(0)" class="food_top"></a><a href="javascript:void(0)" class="food_bottom"></a></span>
						<span>评价<a href="javascript:void(0)" class="food_top"></a><a href="javascript:void(0)" class="food_bottom"></a></span>
						<span>价格<a href="javascript:void(0)" class="food_top"></a><a href="javascript:void(0)" class="food_bottom"></a></span>
						<span class="food_next_pre">
							<a class="food_pre" href="javascript:void(0)"></a>
							<span>1</span>/
							<span>50</span>
							<a class="food_next" href="javascript:void(0)"></a>
						</span>
					</div>
					<ul id="foodContain">
						<li v-for='item in cmd_list'>
							<a href="javascript:;"><img :src="item.pic" alt="" /></a>
							<h2 v-text='item.title'></h2>
							<p><i v-text='item.marketPrice'></i><span v-text='item.salesPrice'></span></p>
							<a href="javascript:;" class="addShoppingCar">加入购物车</a>
						</li>

					</ul>
					<div id="select-list">
						<a id="pre" href="javascript:;">&lt;&lt;</a>
						<a href="javascript:;" v-for='item in page'  @click='selectPage($event,item,$index)' :class="{active_a:active==$index}" v-text='item+1'></a>		
						<a id="next" href="javascript:;">&gt;&gt;</a>

					</div>
				</div>

			</div>
			<div id="familyFooter">
				<a href="index/index.html">首页</a><span>|</span>
				<a href="beautifulLife.html">精彩生活</a><span>|</span>
				<a href="lifeFood.html">生活食品</a><span>|</span>
				<a href="javascript:;">生活用品</a><span>|</span>
				<a href="javascript:;">生活家居</a><span>|</span>
				<a href="javascript:;">会员杂锦</a><span>|</span>
				<a href="javascript:;">一键客服</a><span>|</span>
				<a href="aboutOur.html">关于我们</a>
				<p>CopyrightO 生活一家 2007-2015, All Rights Reserved</p>
			</div>
		</div>
		<script type="text/javascript" src="../js/vue.js" ></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript">
			var nav ={"msg":"","list":{"columnIcon":"","msgCount":0,"pageList":[{"id":"224","title":"中外名酒"},{"id":"225","title":"茗茶月饼"},{"id":"226","title":"休闲食品"},{"id":"229","title":"奶粉"},{"id":"230","title":"饮品"},{"id":"312","title":"生鲜蔬果"},{"id":"313","title":"干货"},{"id":"379","title":"保健品"},{"id":"402","title":"特产类"}],"pageNum":1,"pageSize":10000,"totalPage":1,"totalRecord":9,"updateTime":""},"status":"0"};
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[0].className='';
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[1].className='active_nav';
			var url='../php/getData/getCommodityData.php?table=life_food&page=0&category=224';
			Vue.http.get(url).then(function(res){
				console.log(JSON.parse(res.bodyText))
				vm.cmd_list=JSON.parse(res.bodyText)[0];
				vm.hot_cmd_list=JSON.parse(res.bodyText)[1];
				var page=Math.floor(JSON.parse(res.bodyText)[2][0]['count(id)']/12) ;
				$arr=[];
				for(i=0;i<page;i++){
					$arr.push(i);
				}
				vm.page=$arr;
			}, function(res){
				console.log(res);
			});
			var vm=new Vue({
				el:'#beatifulBody',
				data:{
					cmd_list:null,
					hot_cmd_list:null,
					nav:nav.list.pageList,
					nav_selected:0,
					page:null,
					category:224,
					active:0
				},
				methods:{
					getData:function(event,index){
						this.nav_selected=index;
						this.category=event.target.id;
					var url='../php/getData/getCommodityData.php?table=life_food&page=0&category='+event.target.id;

					this.$http.get(url).then(function(res){
					console.log(JSON.parse(res.bodyText))
						vm.cmd_list=JSON.parse(res.bodyText)[0];
						}, function(res){
							console.log(res);
						});
					},
					selectPage:function (e,item,i){
						this.active=i;
						var url='../php/getData/getCommodityData.php?table=life_food&page='+item+'&category='+this.category;
						this.$http.get(url).then(function(res){
					console.log(JSON.parse(res.bodyText))
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
					}
				}
			})
		</script>
	</body>
</html>
