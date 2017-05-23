<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/beatifulLife.css"/>
<script type="text/javascript" src="../js/vue.js" ></script>
			<div id="beatifulBody">
				<ul id="bt_left" >
					<li v-for='item in nav' @click='getData($event,$index)'  :class="{speilli:$index==nav_selected}"><a href="javascript:;" :id='item.id' v-text='item.title'></a></li>
				</ul>
				<ul id="bt_right">
					<h4>热门商家</h4>
					<li v-for='item in hot_cmd_list' @click='to_inner(item)'>
						<a href="javascript:void(0)"><img :src="item.pic" alt="" /></a>
						<h2><a href="beautifulLife_inner.html" v-text='item.title'></a></h2>
						<i v-text='item.phone'></i>
					</li>
					<h4 class="speilce_h">最新消息</h4>
					<li class="bt_right_li">
						<h3><a href="beautifulLife_inner.html">时代廊桥(佛山)</a></h3>
						<p>南箕花苑是南济路和工业大道中交界处，保利花园对面的一个花园小...</p>
					</li>
					<li class="bt_right_li">
						<h3><a href="beautifulLife_inner.html">时代廊桥(佛山)</a></h3>
						<p>南箕花苑是南济路和工业大道中交界处，保利花园对面的一个花园小...</p>
					</li>
					<li class="bt_right_li">
						<h3><a href="beautifulLife_inner.html">时代廊桥(佛山)</a></h3>
						<p>南箕花苑是南济路和工业大道中交界处，保利花园对面的一个花园小...</p>
					</li>
					<li class="bt_right_li">
						<h3><a href="beautifulLife_inner.html">时代廊桥(佛山)</a></h3>
						<p>南箕花苑是南济路和工业大道中交界处，保利花园对面的一个花园小...</p>
					</li>
					<li class="bt_right_li">
						<h3><a href="beautifulLife_inner.html">时代廊桥(佛山)</a></h3>
						<p>南箕花苑是南济路和工业大道中交界处，保利花园对面的一个花园小...</p>
					</li>
				</ul>
				<ul id="bt_middle">
					<li @click='to_deatil(item)' v-for='item in cmd_list'>
						<a href="javascript:;"><img :src="item.pic" :alt="item.shortDesc" /></a>
						<span>
							<h2><a href="javascript:;" v-text='item.title'></a></h2>
							<i v-text='item.phone'></i></span>
						<h3><a href="beautifulLife_inner.html"></a></h3>
						<p v-text='item.shortDesc'></p>
					</li>
				</ul>
				<div id="select-list">
					<a id="pre" href="javascript:;">&lt;&lt;</a>
					<a href="javascript:;" v-for='item in page' @click='selectPage($event,item,$index)' :class="{active_a:active==$index}" v-text='item+1'></a>
					<a id="next" href="javascript:;">&gt;&gt;</a>
				</div>
			</div>
			<?php
				include '../public/public_footer.php';
			?>
		</div>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript">
			var nav = {"msg":"","list":{"columnIcon":"","msgCount":0,"pageList":[{"id":"188","title":"地产"},{"id":"189","title":"装饰家居"},{"id":"258","title":"汽车"},{"id":"259","title":"金融财税"},{"id":"260","title":"酒店"},{"id":"261","title":"餐饮"},{"id":"263","title":"夜生活"},{"id":"381","title":"美体休闲"},{"id":"382","title":"专卖"},{"id":"383","title":"茶艺收藏"},{"id":"384","title":"旅游"},{"id":"385","title":"体育保健"},{"id":"386","title":"广告花木"},{"id":"388","title":"婚纱摄影"},{"id":"389","title":"教育培训"},{"id":"392","title":"其它"}],"pageNum":1,"pageSize":10000,"totalPage":1,"totalRecord":16,"updateTime":""},"status":"0"};
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[0].className='';
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[1].className='active_nav';
			var url='../php/getData/getCommodityData.php?table=beautity_life&page=0&category=188';
			Vue.http.get(url).then(function(res){
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
					page:null,
					category:188,
					active:0,
					nav_selected:0,
				},
				methods:{
					to_inner:function(item){
						console.log(item)
						location.href='beautifulLife_inner.php?id='+item.id;
					},
					getData:function(event,index){
						this.nav_selected=index;
						this.category=event.target.id;
						var url='../php/getData/getCommodityData.php?table=beautity_life&page=0&category='+event.target.id;
			
						this.$http.get(url).then(function(res){
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
					},
					selectPage:function (e,item,i){
						var url='../php/getData/getCommodityData.php?table=beautity_life&page='+item+'&category='+this.category;
						this.$http.get(url).then(function(res){
							vm.cmd_list=JSON.parse(res.bodyText)[0];
							}, function(res){
								console.log(res);
							});
						this.active=i;
					},
					to_deatil:function(item){
						location.href='beautifulLife_inner.php?id='+item.id;
					}
				}
			})
		</script>
	</body>
</html>
