<?php
	include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/lifefood/shopping_car.css"/>
			<article id="shoppingCar">
				<form action="" method="post">
					<h2><p>全部商品(<span>3</span>)</p></h2>
					<div class="property box">
						<div class="item item2 "><label><span class="check_span"></span><input type="checkbox" name="" id="" value="" />全选</label><span>商品详情</span></div>
						<div class="item">单价（元）</div>
						<div class="item">数量</div>
						<div class="item">操作</div>
					</div>
					<ul class="commodity_list ">
						<li class="box" v-for='items in dataList'>
							<label><span class="check_span"></span><input type="checkbox" name="" id="" value="" /></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img :src="items[0].pic" alt="" /></div>
									<div class="item cd_title"><span v-text='items[0].title'></span></div>
								</a></div>
							<div class='item before'>￥<span class="price" v-text='items[0].salesPrice'></span></div>
							<div class="item before num_ct">数量<i class="reduce"></i><input type="text" name="num" id="num" class="num" value="1" v-model='items[1]' /><i class="add"></i>件</div>
							<div class="item"><a href="#" class="cancel">删除</a></div>
						</li>
					</ul>
					<div id="pay_money">
						<label><span class="check_span"></span><input type="checkbox" name="" id="" value="" />全选<a href="#" class="cancel">删除</a></label>
						
						<input type="submit" name="" id="to_pay" value="立即结算" />
						<span class="heji">合计:<i>399</i></span>
						<span class="has_select">已选择商品<i>3</i>件</span>
					</div>
				</form>
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
		</div>
		<script type="text/javascript" src="../js/vue.js" ></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript">
			<?php
				header("content-type:text/html;charset=utf-8");
				session_start();
				$useInfo=$_SESSION;
				if(isset( $_SESSION['username'])){
					if(isset($_SESSION['shoppingCar'])){
						require_once '../php/mysql.class.php';
						$mysql = new MySQL('localhost','root','','family');
						$arr=[];
						foreach ($_SESSION['shoppingCar'] as $key => $value) {
							$sql='select * from '.$value['table'].' where id='.$key;
							$res = $mysql->query($sql);
							$res[]=$value['count'];
							$arr[]=$res;
						}
						echo 'var login=1; var dataList='.json_encode($arr).';';
					}

					
				}else{
					echo 'var login=0;';
				}
				
				?>
				if(!login){
					location.href='../index/login.html';
				};
				var vm=new Vue({
					el:'#shoppingCar',
					data:{
						dataList:dataList,
					}
				})
		</script>
	</body>
</html>
<?php
	include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/lifefood/shopping_car.css"/>
			<article>
				<form action="" method="post">
					<h2><p>全部商品(<span>3</span>)</p></h2>
					<div class="property box">
						<div class="item item2 "><label><span class="check_span"></span><input type="checkbox" name="" id="" value="" />全选</label><span>商品详情</span></div>
						<div class="item">单价（元）</div>
						<div class="item">数量</div>
						<div class="item">操作</div>
					</div>
					<ul class="commodity_list ">
						<li class="box">
							<label><span class="check_span"></span><input type="checkbox" name="" id="" value="" /></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img src="../img/shiping (8).jpg" alt="" /></div>
									<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>a
							<div class='item before'>￥<span class="price">500</span></div>
							<div class="item before num_ct">数量<i class="reduce"></i><input type="text" name="num" id="num" class="num" value="1" /><i class="add"></i>件</div>
							<div class="item"><a href="#" class="cancel">删除</a></div>
						</li>
						<li class="box">
							<label><span class="check_span"></span><input type="checkbox" name="" id="" value="" /></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img src="../img/shiping (8).jpg" alt="" /></div>
									<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>
							<div class='item before'>￥<span class="price">500</span></div>
							<div class="item before num_ct">数量<i class="reduce"></i><input type="text" name="num" id="num" class="num" value="1" /><i class="add"></i>件</div>
							<div class="item"><a href="#" class="cancel">删除</a></div>
						</li>
						<li class="box">
							<label><span class="check_span"></span><input type="checkbox" name="" id="" value="" /></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img src="../img/shiping (8).jpg" alt="" /></div>
									<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>
							<div class='item before'>￥<span class="price">500</span></div>
							<div class="item before num_ct">数量<i class="reduce"></i><input type="text" name="num" id="num" class="num" value="1" /><i class="add"></i>件</div>
							<div class="item"><a href="#" class="cancel">删除</a></div>
						</li>
					</ul>
					<div id="pay_money">
						<label><span class="check_span"></span><input type="checkbox" name="" id="" value="" />全选<a href="#" class="cancel">删除</a></label>
						
						<input type="submit" name="" id="to_pay" value="立即结算" />
						<span class="heji">合计:<i>399</i></span>
						<span class="has_select">已选择商品<i>3</i>件</span>
					</div>
				</form>
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
		</div>
		<script type="text/javascript">
		</script>
	</body>
</html>
