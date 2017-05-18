<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<style type="text/css">
	#foodContain li{
		width: 19.9%;
	}
</style>
<link rel="stylesheet" type="text/css" href="../css/lifeFood.css"/>
			<div id="beatifulBody">
				<div id="life_contain"  style="width: 100%;">
					<div class="food_selecter">
						<span v-for='item in sort' @click='sorts($index,item)' :class="{active_span:active_sort==$index}">{{item.name}}<a href="javascript:void(0)" v-if='item.is' @click.stop='sorts($index,item,2)' class="food_top" :class='{active_top:active_sort==$index&&item.flag==2}'></a><a href="javascript:void(0)" v-if='item.is'  class="food_bottom" :class='{active_bottom:active_sort==$index&&item.flag==1}' @click.stop='sorts($index,item,1)'></a></span>
						<span class="food_next_pre">
							<a class="food_pre" href="javascript:void(0)" @click="selectPage2(0)"></a>
							<span v-text='nowPage+1'></span>/
							<span v-text='maxPage'></span>
							<a class="food_next" href="javascript:void(0)" @click="selectPage2(1)"></a>
						</span>
					</div>
					<ul id="foodContain">
						<li  @click='to_deatil(item)' v-for='item in cmd_list'>
							<a href="javascript:void(0);"><img :src="item.pic" alt="" /></a>
							<h2 v-text='item.title'></h2>
							<p><i v-text='item.marketPrice'></i><span v-text='item.salesPrice'></span></p>
							<a href="javascript:void(0);" class="addShoppingCar">加入购物车</a>
						</li>

					</ul>
					<div id="select-list">
						<a id="pre" href="javascript:void(0);" @click="selectPage2(0)">&lt;&lt;</a>
						<span v-text='nowPage+1' style="margin-left: 28px;"></span>/
							<span v-text='maxPage'></span>
						<a id="next" href="javascript:void(0);"@click="selectPage2(1)">&gt;&gt;</a><span style="margin-left: 28px;  color: #ccc;">跳转至第 <input type="text"  name="" id="" v-model='toPage' style="width: 28px; border:1px solid #ccc;text-align: center; outline: none; height: 28px; line-height: 30px;" /> 页</span><a href="javascript:void(0)" @click='selectPage(toPage)' style="padding: 0 10px;">确认</a>
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
			 var keys=decodeURIComponent(location.search.slice(location.search.indexOf('=')+1));
			 
			 var keys=document.getElementById('searchText').value=keys;
			var url='../php/getData/getCommodityDataByKey.php?key='+keys+'&page=0';
			Vue.http.get(url).then(function(res){
				vm.cmd_list=JSON.parse(res.bodyText)[0];
				vm.hot_cmd_list=JSON.parse(res.bodyText)[1];
				var page=Math.floor(JSON.parse(res.bodyText)[1]/12) ;
				vm.maxPage=page;
				$arr=[];
				if(page==0){
					$arr.push(1);
				}else{
					if(page>8){
						page=8;
						
					}
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
					nav_selected:0,
					page:0,
					category:224,
					active:0,
					nowPage:0,
					active_sort:0,
					sortId:0,
					maxPage:0,
					toPage:1,
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
					selectPage:function(num){
						if(num>this.maxPage){
							num=this.maxPage;
						}else if(num<1){
							num=1;
						}
						this.toPage=num;
						this.nowPage=num*1-1;
						if(this.active_sort){
							var url='../php/getData/getCommodityDataByKey.php?key='+keys+'&page='+this.nowPage+'&sort='+this.sortId+'&top=0';
						}else{
							var url='../php/getData/getCommodityDataByKey.php?key='+keys+'&page='+this.nowPage;
						}

						this.$http.get(url).then(function(res){
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
					},
					selectPage2:function (num){
						var len=this.maxPage;
						if(num){
							this.nowPage+=1;
							this.toPage=this.nowPage+1;
							if(this.nowPage>len-1){
								this.nowPage=len-1;
								return	false;
							}
							this.active+=1;
							if(this.active>4){
								this.active=4;
							}
							this.page.shift();
							this.page.push(this.nowPage+7);
						}else{
							this.nowPage-=1;
							this.toPage=this.nowPage+1;
							if(this.nowPage<0){
								this.nowPage=0;
								return false;
							}
							this.active-=1;
							this.page.unshift(this.nowPage);
							this.page.pop();
						}
						if(this.active_sort){
							var url='../php/getData/getCommodityDataByKey.php?key='+keys+'&page='+this.nowPage+'&sort='+this.sortId+'&top=0';
						}else{
							var url='../php/getData/getCommodityDataByKey.php?key='+keys+'&page='+this.nowPage;
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
							var url='../php/getData/getCommodityDataByKey.php?page='+(this.nowPage)+'&sort='+item.id+'&top=1&key='+keys;
						}else if(top==2){
							item.flag=top;
							var url='../php/getData/getCommodityDataByKey.php?page='+(this.nowPage)+'&sort='+item.id+'&top=0&key='+keys;
						}else{
							if(i==0){
								var url='../php/getData/getCommodityDataByKey.php?page='+(this.nowPage)+'&key='+keys;
								
							}else{
								var url='../php/getData/getCommodityDataByKey.php?page='+(this.nowPage)+'&key='+keys+'&sort='+item.id;
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
						location.href='shipingxiangqing.php?category='+item.tableName+'&id='+item.id;
					}
				}
			})
		</script>
	</body>
</html>
