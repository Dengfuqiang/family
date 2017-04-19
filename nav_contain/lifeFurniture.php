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
						<span v-for='item in sort' @click='sorts($index,item)' :class="{active_span:active_sort==$index}">{{item.name}}<a href="javascript:void(0)" v-if='item.is' @click.stop='sorts($index,item,2)' class="food_top" :class='{active_top:active_sort==$index&&item.flag==2}'></a><a href="javascript:void(0)" v-if='item.is'  class="food_bottom" :class='{active_bottom:active_sort==$index&&item.flag==1}' @click.stop='sorts($index,item,1)'></a></span>
						<span class="food_next_pre">
							<a class="food_pre" href="javascript:void(0)" @click="selectPage(--nowPage)"></a>
							<span v-text='nowPage'></span>/
							<span v-text='page.length'></span>
							<a class="food_next" href="javascript:void(0)" @click="selectPage(++nowPage)"></a>
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
						<a href="javascript:;" v-for='item in page'  @click='selectPage($index)' :class="{active_a:active==$index}" v-text='item+1'></a>		
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
			var nav ={"msg":"","list":{"columnIcon":"","msgCount":0,"pageList":[{"id":"239","title":"厨具"},{"id":"240","title":"家具"},{"id":"241","title":"灯具"},{"id":"242","title":"五金"},{"id":"243","title":"饰品"}],"pageNum":1,"pageSize":10000,"totalPage":1,"totalRecord":5,"updateTime":""},"status":"0"};
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[0].className='';
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[4].className='active_nav';
			var url='../php/getData/getCommodityData.php?table=life_furniture&page=0&category=239';
			Vue.http.get(url).then(function(res){
				console.log(JSON.parse(res.bodyText))
				vm.cmd_list=JSON.parse(res.bodyText)[0];
				vm.hot_cmd_list=JSON.parse(res.bodyText)[1];
				var page=Math.floor(JSON.parse(res.bodyText)[2][0]['count(id)']/12) ;
				$arr=[];
				if(page==0){
					$arr.push(1);
				}else{
					for(i=0;i<page;i++){
				 		$arr.push(i);
					}
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
					page:0,
					category:239,
					active:0,
					nowPage:1,
					active_sort:0,
					sortId:0,
					sort:[
						{
							name:'全部',
							is:false,
						},
						{
							name:'销量',
							id:'sellerCount',
							flag:1,
							is:true,
						},
						{
							name:'价格',
							id:'marketPrice',
							flag:1,
							is:true,
						},
					]
				},
				methods:{
					getData:function(event,index){
						this.nav_selected=index;
						this.category=event.target.id;
						this.active_sort=0;
						var url='../php/getData/getCommodityData.php?table=life_furniture&page=0&category='+event.target.id;
						this.$http.get(url).then(function(res){
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							var page=Math.floor(JSON.parse(res.bodyText)[2][0]['count(id)']/12) ;
							$arr=[];
							if(page==0){
								$arr.push(0);
							}else{
								for(i=0;i<page;i++){
							 		$arr.push(i);
								}
							}
							vm.page=$arr;
							this.nowPage=1;
							this.active=0;
						}, function(res){
							console.log(res);
						});
					},
					selectPage:function (i){
						this.nowPage=i;
						this.active=i-1;
						if(this.active_sort){
							var url='../php/getData/getCommodityData.php?table=life_furniture&page='+this.nowPage+'&category='+this.category+'&sort='+this.sortId+'&top=0';
						}else{
							var url='../php/getData/getCommodityData.php?table=life_furniture&page='+this.nowPage+'&category='+this.category;
						}

						this.$http.get(url).then(function(res){
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
					},
					sorts:function(i,item,top){
						this.nowPage=1;
						this.active_sort=i;
						this.active=i-1;
						this.sortId=item.id;
						if(top==1){
							item.flag=top;
							var url='../php/getData/getCommodityData.php?table=life_furniture&page='+(this.nowPage-1)+'&category='+this.category+'&sort='+item.id+'&top=1';
						}else if(top==2){
							item.flag=top;
							var url='../php/getData/getCommodityData.php?table=life_furniture&page='+(this.nowPage-1)+'&category='+this.category+'&sort='+item.id+'&top=0';
						}else{
							var url='../php/getData/getCommodityData.php?table=life_furniture&page='+(this.nowPage-1)+'&category='+this.category+'&sort='+item.id;
						}

						this.$http.get(url).then(function(res){
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
