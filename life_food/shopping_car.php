<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
?>
		<link rel="stylesheet" type="text/css" href="../css/lifefood/shopping_car.css"/>
			<article id="shopping_car">
					<h2><p>全部商品(<span v-text='dataList.length'>3</span>)</p></h2>
					<div class="property box">
						<div class="item item2 "><label><input type="checkbox" name="" id="allSelect" value="" />全选</label><span>商品详情</span></div>
						<div class="item">单价（元）</div>
						<div class="item">数量</div>
						<div class="item">操作</div>
					</div>
					<ul class="commodity_list ">
						<li class="box" v-for='item in dataList'>
							<label><input type="checkbox" name="" @click='checkBox(item,$index)' :checked="checks" id="" value="" /></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img :src="item[0].pic" alt="" /></div>
									<div class="item cd_title"><span v-text='item[0].title'>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>
							<div class='item before'>￥<span class="price" v-text='item[0].salesPrice'>500</span></div>
							<div class="item before num_ct">数量<i class="reduce" @click='reduceCount(item)'></i><input readonly="readonly" type="text" name="num" id="num" class="num" v-model='item.count'/><i class="add"  @click='addCount(item)'></i>件</div>
							<div class="item"><a href="javscript:;" class="cancel" @click='removeCmd(item,$index)'>删除</a></div>
						</li>
					</ul>
					<div id="pay_money">
						<label><a href="#" class="cancel" @click='deleteAll()'>删除</a></label>
						
						<span href="javscript:;" id="to_pay" @click='submits()'>立即结算</span>
						<span class="heji">合计:<i v-text='selectCommodity.allPrice'>0</i></span>
						<span class="has_select">已选择商品<i v-text='selectNum'></i>件</span>
					</div>
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
				if(isset( $_SESSION['username'])){
					if(isset($_SESSION['shoppingCar'])){
						require_once '../php/mysql.class.php';
						$mysql = new MySQL('localhost','root','','family');
						$arr=[];
						foreach ($_SESSION['shoppingCar'] as $key => $value) {
							$sql='select * from '.$value['table'].' where id='.$key;
							$res = $mysql->query($sql);
							$res['count']=$value['count'];
							$arr[]=$res;
						}
						echo 'var login=1; var dataList='.json_encode($arr).';';
					}else{
						echo 'var login=2;';
					}

					
				}else{
					echo 'var login=0;';
				}?>
				console.log(dataList)
				if(!login){
					location.href='../index/login.html';
				}else if(login==2){
					dataList=null;
				};
				
				
		</script>
		<script type="text/javascript" src="../js/jquery-2.2.2.min.js" ></script>
		<script type="text/javascript">
				var vm=new Vue({
					el:'#shopping_car',
					data:{
						dataList:dataList,
						selectCommodity:{
							'0':[],
							allPrice:0
						},
						selectNum:0,
						checks:false
					},
					methods:{
						checkBox:function(item,index){
							if(!item.check){
								item.check=true;
								this.selectCommodity[0][index]=item;
								this.selectNum++;
								this.selectCommodity.allPrice+=item[0].salesPrice*item.count*1;
							}else{
								item.check=false;
								this.selectNum--;
								delete this.selectCommodity[index]
								this.selectCommodity.allPrice-=item[0].salesPrice*item.count*1;
							}
						},
						addCount:function(item){
							item.count++;
							if(item.check){
								this.selectCommodity.allPrice+=item[0].salesPrice*1;
							}
						},
						reduceCount:function(item){
							item.count--;
							if(item.check){
								this.selectCommodity.allPrice-=item[0].salesPrice*1;
							}
						},
						removeCmd:function(item,index){
							this.selectCommodity.allPrice-=item[0].salesPrice*item.count*1;
							this.dataList.splice(index,1);
						},
						deleteAll:function(){
							this.selectCommodity.allPrice=0;
							this.dataList.splice(0,this.dataList.length);
						},
						submits:function(){
							var data= $.param(this.selectCommodity);
							location.href='to_buy.php?'+data;
						}
					}
					
				})
			selectTree({
				allSelect:"#allSelect",
				two:".commodity_list"
			});
			function selectTree(obj){
				var oneArr=$(obj.two);
				//全选
				$(document).on('click',obj.allSelect,function(){
					if(this.checked){
						var len=vm.dataList.length;
						vm.checks=true;
						vm.selectCommodity[0]=vm.dataList;
						vm.selectNum=len;
						for(i=0;i<len;i++){
							console.log(vm.dataList[i].count)
							console.log(vm.dataList[i][0].salesPrice)
							console.log(vm.selectCommodity)
							vm.selectCommodity.allPrice+=vm.dataList[i].count*1*vm.dataList[i][0].salesPrice*1;
						}
					}else{
						vm.checks=false;
						vm.selectCommodity['0']={};
					}
				});
				if(obj.two){
					var twoArr=$(obj.two).find('input:checkbox');
						twoArr.click(function(){
						var flag=true;
						$(obj.two).find('input:checkbox').each(function(index,dom){
							if(!dom.checked){
								flag=false;
								return false;
							}
						});
						if(flag){
							$(allSelect)[0].checked=true;
						}else{
							
							$(allSelect)[0].checked=false;
						}
					});
				}
			}
		</script>
	</body>
</html>