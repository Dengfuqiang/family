<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/lifeFood.css"/>
			<div id="beatifulBody">
				<ul id="bt_left">
					<li v-for='item in nav' @click='getData($event,$index)' :class="{speilli:$index==nav_selected}"><a href="javascript:void(0);" :id='item.id' v-text='item.title'></a></li>
				</ul>
				<div id="life_contain">
					<div class="food_selecter">
						<span v-for='item in sort' @click='sorts($index,item)' :class="{active_span:active_sort==$index}">{{item.name}}<a href="javascript:void(0)" v-if='item.is' @click.stop='sorts($index,item,2)' class="food_top" :class='{active_top:active_sort==$index&&item.flag==2}'></a><a href="javascript:void(0)" v-if='item.is'  class="food_bottom" :class='{active_bottom:active_sort==$index&&item.flag==1}' @click.stop='sorts($index,item,1)'></a></span>
						<span class="food_next_pre">
							<a class="food_pre" href="javascript:void(0)" @click="selectPage2(0)"></a>
							<span v-text='nowPage+1'></span>/
							<span v-text='page.length'></span>
							<a class="food_next" href="javascript:void(0)" @click="selectPage2(1)"></a>
						</span>
					</div>
					<ul id="foodContain">
						<li  @click='to_deatil(item)' v-for='item in cmd_list'>
							<a href="javascript:void(0);"><img :src="item.pic" alt="" /></a>
							<h2 v-text='item.title'></h2>
							<p><i v-text='item.salesPrice'></i><span v-text='item.marketPrice '></span></p>
							<a href="javascript:void(0);" class="addShoppingCar" @click.stop='toShoppingCar(item)'>加入购物车</a>
						</li>
						<li v-if='cmd_list.length<1' style="width: 100%;padding:250px 0 ; text-align: center;">暂时还没有商品数据哦~</li>
					</ul>
					<div id="select-list">
						<a id="pre" href="javascript:void(0);" @click="selectPage2(0)">&lt;&lt;</a>
						<a href="javascript:void(0);" v-for='item in page'  @click='selectPage($index)' :class="{active_a:active==$index}" v-text='item+1'></a>		
						<a id="next" href="javascript:void(0);"@click="selectPage2(1)">&gt;&gt;</a>

					</div>
				</div>
			</div>
			<?php
			include '../public/public_footer.php';
		?>
		</div>
		<script type="text/javascript" src="../js/vue.js" ></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript">
			var nav ={"msg":"","list":{"columnIcon":"","msgCount":0,"pageList":[{"id":"224","title":"中外名酒"},{"id":"225","title":"茗茶月饼"},{"id":"226","title":"休闲食品"},{"id":"229","title":"奶粉"},{"id":"230","title":"饮品"},{"id":"312","title":"生鲜蔬果"},{"id":"313","title":"干货"},{"id":"379","title":"保健品"},{"id":"402","title":"特产类"}],"pageNum":1,"pageSize":10000,"totalPage":1,"totalRecord":9,"updateTime":""},"status":"0"};
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[0].className='';
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[2].className='active_nav';
			var url='../php/getData/getCommodityData.php?table=life_food&page=0&category=224';
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
					cmd_list:[],
					hot_cmd_list:null,
					nav:nav.list.pageList,
					nav_selected:0,
					page:0,
					category:224,
					active:0,
					nowPage:0,
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
					toShoppingCar:function(item){
						var url='../php/shopping/addToShoppingCar.php?category='+this.category+'&id='+item.id+'&count=1&table=life_food';
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
					getData:function(event,index){
						this.nav_selected=index;
						this.category=event.target.id;
						this.active_sort=0;
						var url='../php/getData/getCommodityData.php?table=life_food&page=0&category='+event.target.id;
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
							this.nowPage=0;
							this.active=0;
						}, function(res){
							console.log(res);
						});
					},
					selectPage:function (i){
						this.nowPage=i;
						this.active=i;
						if(this.active_sort){
							var url='../php/getData/getCommodityData.php?table=life_food&page='+i+'&category='+this.category+'&sort='+this.sortId+'&top=0';
						}else{
							var url='../php/getData/getCommodityData.php?table=life_food&page='+i+'&category='+this.category;
						}

						this.$http.get(url).then(function(res){
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
							
							
						
					},
					selectPage2:function (num){
						var len=this.page.length;
						if(num){
							this.nowPage+=1;
							if(this.nowPage>len-1){
								this.nowPage=len-1;
								return	false;
							}
							this.active+=1;
							if(this.active>len)this.active=len-1;
						}else{
							this.nowPage-=1;
							if(this.nowPage<0){
								this.nowPage=0;
								return false;
							}
							this.active-=1;
							if(this.active<0)this.active=0;
						}
						if(this.active_sort){
							var url='../php/getData/getCommodityData.php?table=life_food&page='+this.nowPage+'&category='+this.category+'&sort='+this.sortId+'&top=0';
						}else{
							var url='../php/getData/getCommodityData.php?table=life_food&page='+this.nowPage+'&category='+this.category;
						}

						this.$http.get(url).then(function(res){
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
					},
					sorts:function(i,item,top){
						this.nowPage=0;
						this.active_sort=i;
						this.active=i-1;
						this.sortId=item.id;
						if(top==1){
							item.flag=top;
							var url='../php/getData/getCommodityData.php?table=life_food&page='+(this.nowPage)+'&category='+this.category+'&sort='+item.id+'&top=1';
						}else if(top==2){
							item.flag=top;
							var url='../php/getData/getCommodityData.php?table=life_food&page='+(this.nowPage)+'&category='+this.category+'&sort='+item.id+'&top=0';
						}else{
							if(i==0){
								var url='../php/getData/getCommodityData.php?table=life_food&page='+(this.nowPage)+'&category='+this.category;
								
							}else{
								var url='../php/getData/getCommodityData.php?table=life_food&page='+(this.nowPage)+'&category='+this.category+'&sort='+item.id;
							}

						}

						this.$http.get(url).then(function(res){
						console.log(JSON.parse(res.bodyText))
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
					},
					to_deatil:function(item){
						location.href='shipingxiangqing.php?category=life_food&id='+item.id;
					}
				}
			})
		</script>
	</body>
</html>
