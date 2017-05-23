<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/beatifulLife.css"/>
			<div id="beatifulBody">
				<ul id="bt_right">
					<h4>热门商家</h4>
					<li v-for='item in data[1]' @click='to_inner(item)'>
						<a href="javascript:void(0);"><img :src="item.pic" alt="" /></a>
						<h2><a href="javascript:void(0);" v-text='item.title'></a></h2>
						<i v-text='item.phone'></i>
					</li>
				</ul>
				<div id="beatiful_inner">
					<ul>
						<li class="pictureAndInformation">
							<div id="picture_watch">
								<a class="bigPicture" href="javascript:void(0);"><img  :src="data[0][0].pic" alt="" /></a>
								<a href="javascript:void(0);"><img :src="data[0][0].pic" alt="" /></a>
							</div>
							<div  id="information">
								<h6 v-text="data[0][0].title"></h6>
								<p v-text="data[0][0].shortDesc"></p>

							</div>
							<a class="telphone" href="javascript:void(0);"  v-text="data[0][0].phone"></a>
						</li>
						<li v-html='data[0][0].content'>
							<span class="spInformation">
								<a href="javascript:void(0);">
									<h2>商品详情</h2>
								</a>
							</span>
							<span class="xiangxi">
								<a href="javascript:void(0)"><img src="../img/bthouse (1).jpg" alt="" /></a>
								<span>
									<h2>01</h2>
									<h4>时代廊桥（佛山）</h4>
									<p>时代地产在佛山又推出了一大力作时代廊桥（佛山）已于国庆佳节开放样板间，吸引众多购房者落地看房，小编也赶紧凑个热闹去到了现场，为大家带来了样板间图赏。这次小编就为大家推荐一款自已也很心水的98平米户型</p>
								</span>
							</span>
							<span class="xiangxi">
								<a href="javascript:void(0)"><img src="../img/bthouse (2).jpg" alt="" /></a>
								<span>
									<h2>02</h2>
									<h4>时代廊桥（佛山）</h4>
									<p>时代地产在佛山又推出了一大力作时代廊桥（佛山）已于国庆佳节开放样板间，吸引众多购房者落地看房，小编也赶紧凑个热闹去到了现场，为大家带来了样板间图赏。这次小编就为大家推荐一款自已也很心水的98平米户型</p>
								</span>
							</span>
							<span class="xiangxi">
								<a href="javascript:void(0)"><img src="../img/bthouse (3).jpg" alt="" /></a>
								<span>
									<h2>03</h2>
									<h4>时代廊桥（佛山）</h4>
									<p>时代地产在佛山又推出了一大力作时代廊桥（佛山）已于国庆佳节开放样板间，吸引众多购房者落地看房，小编也赶紧凑个热闹去到了现场，为大家带来了样板间图赏。这次小编就为大家推荐一款自已也很心水的98平米户型</p>
								</span>
							</span>
							<span class="xiangxi">
								<a href="javascript:void(0)"><img src="../img/bthouse (4).jpg" alt="" /></a>
								<span>
									<h2>04</h2>
									<h4>时代廊桥（佛山）</h4>
									<p>时代地产在佛山又推出了一大力作时代廊桥（佛山）已于国庆佳节开放样板间，吸引众多购房者落地看房，小编也赶紧凑个热闹去到了现场，为大家带来了样板间图赏。这次小编就为大家推荐一款自已也很心水的98平米户型</p>
								</span>
							</span>
							<span class="xiangxi">
								<a href="javascript:void(0)"><img src="../img/bthouse (5).jpg" alt="" /></a>
								<span>
									<h2>05</h2>
									<h4>时代廊桥（佛山）</h4>
									<p>时代地产在佛山又推出了一大力作时代廊桥（佛山）已于国庆佳节开放样板间，吸引众多购房者落地看房，小编也赶紧凑个热闹去到了现场，为大家带来了样板间图赏。这次小编就为大家推荐一款自已也很心水的98平米户型</p>
								</span>
							</span>
						</li>
					</ul>
				</div>
			</div>
			<?php
				include '../public/public_footer.php';
			?>
		</div>
		<script type="text/javascript" src="../js/vue.js" ></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript">
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[0].className='';
		   document.getElementsByClassName('headerNavInner')[0].getElementsByTagName('a')[1].className='active_nav';
			var cmdId = location.search.split('=')[1];
			var url='../php/getData/getDetailData.php?table=beautity_life&id='+cmdId;
			Vue.http.get(url).then(function(res){
				var res =JSON.parse(res.bodyText );
				console.log(res)
				var vm=new Vue({
					el:'#beatifulBody',
					data:{
						data:res,
					},
					methods:{
						to_inner:function(item){
							console.log(item)
							location.href='beautifulLife_inner.php?id='+item.id;
						},
					}
				})
			}, function(res){
				console.log(res);
			});
			
		</script>
	</body>
</html>
