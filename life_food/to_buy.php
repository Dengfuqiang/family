<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
	if(isset( $_SESSION['username'])){
		require_once '../php/mysql.class.php';
		$mysql = new MySQL('localhost','root','','family');
		$arr=$_GET;
		$sql='select * from user_address where phone='.$_SESSION['phone'];
		$arr['address']=$mysql->query($sql);
	}else{
		echo 'var login=0;';
	}
?>
		<link rel="stylesheet" type="text/css" href="../css/lifefood/to_buy.css"/>
			<article id='submit_order_ct'>
				<form action="" method="post">
					<div class="address">
						<h2>选择收货地址</h2>
						<ul class="address_list" >
							<li @click='selected($index,item,$event)' :class="defaults(item,$index)&&$index==thisIndex?'selected':''" v-for='item in dataList.address'>
								<p><span>{{item.address}}（{{item.username}}收）</span><span v-text='item.phone'>13689223290</span></p>
								<p v-text='item.detailaddrass'>天河车陂东圃大马路8号时代TIT广场A座4楼430</p>
								<div class="change_address"><a href="javascript:;" class="change_bt"  @click='changeAddress(item)'>修改</a> | <a href="javascript:;" class="cancel_bt"  @click='deleteAddress($index,item)'>删除</a></div>
							</li>
						</ul>
						<a href="javascript:void(0)" @click='addAddress()' class="add_address">+添加地址</a>
					</div>
					<div class="confirm_order_info">
						<h2>确认订单信息</h2>
						<div class="property box">
							<div class="item item2 "><span>商品详情</span></div>
							<div class="item">单价（元）</div>
							<div class="item">数量</div>
							<div class="item">操作</div>
						</div>
						<ul class="commodity_list ">
							<li class="box" v-for='items in dataList[0]'>
								<label></label>
								<div class="cmd_info item">
									<a href="#" class="box">
										<div><img :src="items[0].pic" alt="" /></div>
										<div class="item cd_title"><span v-text='items[0].title'>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
									</a></div>
								<div class='item before'>￥<span class="price" v-text='items[0].salesPrice'></span></div>
								<div class="item before num_ct">数量<i class="reduce" @click="reduceCount(items)"></i><input readonly="readonly" type="text" name="num" id="num" class="num" v-model='items.count' /><i class="add" @click="addCount(items)"></i>件</div>
								<div class="item"><a href="javscript:void(0);" class="cancel" @click='removeCmd(items)'>删除</a></div>
							</li>
						</ul>
						<div class="liuyan">
							<label>买家留言：<input type="text" name="" id="" v-model='liuyan'/></label>
							<div class="zongji">
								<p>总计：<i v-text='allPrice'>158.00</i></p>
								<input type="submit" name="" id="" value="提交订单" @click.prevent='submitOrder()' class="confirm_submit" />
							</div>
						</div>
					</div>
				</form>
			</article>
			<?php
		include '../public/public_footer.php';
		?>
			<div class="add_address_window" style="display: none;" v-show='addWin'>
				<div class="add_address_inner">
					<h3>使用新地址 <a href="javascript:void(0);" class="close_win" @click='addAddress()'></a></h3>
					<div class="add_info">
						<p><span>新增收货地址</span>电话号码、手机号选填一项，其余均为必真项</p>
						<form action="" method="post">
							<label><span>收货人姓名</span><input type="text" name="" id="reciver_name" value="" placeholder="长度不超过25个字符" v-model='address.userName'/></label>
							<label><span>手机号码<i>*</i></span><input type="text" name="" id="mobile_phone" value="" placeholder="请输入手机号"  v-model='address.phone'/></label>
							<label><span>所在城市<i>*</i></span><input type="text" name="" id="city" value="" placeholder="请输入省市区" v-model='address.provinCity'/></label>
							<label><span>详细地址<i>*</i></span><textarea name="" rows="" cols=""  id="address_detail" placeholder="建议你如实填写的的信息，如街道门牌号..."  v-model='address.addressDetail'></textarea>  </label>
							<label><input type="checkbox" name="isdefault" id="isdefault"  v-model='address.isDefault'/>设置为默认收货地址</label>
							<input type="submit" value="保存" id="confirm_add_address" @click.prevent='submitAddAddress()'/>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/vue.js" ></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript">
			<?php
				
				echo 'var login=1; var dataList='.json_encode($arr).';';
				?>
		</script>
		<script type="text/javascript">	
			if(!login){
					location.href='../index/login.html';
				}
			Vue.http.options.emulateJSON = true;
			var vm=new Vue({
				el:'#familyAndContain',
				data:{
					dataList:dataList,
					allPrice:dataList.allPrice*1,
					liuyan:'',
					selectedAddress:0,
					addWin:false,
					flag:1,
					address:{
						userName:'',
						phone:'',
						provinCity:'',
						addressDetail:'',
						isDefault:'',
						thisIndex:0,
						id:''
					}
				},
				methods:{
					changeAddress:function(item){
						console.log(item)
						this.addWin=!this.addWin;
						this.address.userName=item.username;
						this.address.phone=item.phone;
						this.address.provinCity=item.address;
						this.address.addressDetail=item.detailaddrass;
						this.address.isDefault=item.default;
						this.address.id=item.id;
						this.flag=0;
					},
					addCount:function(item){
						item.count++;
						if(item.check){
							this.allPrice+=item[0].salesPrice*1;
						}
					},
					reduceCount:function(item){
						item.count--;
						if(item.check){
							this.allPrice-=item[0].salesPrice*1;
						}
					},
					removeCmd:function(item,index){
						this.allPrice-=item[0].salesPrice*item.count*1;
						this.dataList[0].splice(index,1);
					},
					defaults:function(item,index){
						if(item.default==1){
							this.selectedAddress=item.id;
							this.thisIndex=index;
							return true;
						}
						else{
							return false;
						}
					},
					selected:function(index,item,e){
						var lis=document.querySelector('.address_list').children;
						for(i=0;i<lis.length;i++){
							lis[i].className='';
						}
						lis[index].className='selected';
						this.selectedAddress=item.id;
					},
					addAddress:function(){
						this.addWin=!this.addWin;
					},
					deleteAddress:function(index,item){
						if(confirm('是否确认删除收货地址！')){
							var url='../php/getData/getOrder.php?fc=deleteAddress&id='+item.id;
								this.$http.get(url).then(function(res){
								res=JSON.parse(res.bodyText);
								console.log(res)
								if(res.code==1){
									alert(res.msg);
									this.dataList.address.splice(index,1);
									return;
								}
								alert(res.msg)
							}, function(err){
								
							});
						}
					},
					submitAddAddress:function(){
						var url='../php/createOrder/addAddress.php?flag='+this.flag+'&id='+this.address.id;
						this.$http.post(url, this.address).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res);
							if(res.code){
								alert(res.msg);
								vm.addWin=false;
								this.thisIndex=this.dataList.address.length-1;
								if(this.flag){
									console.log(vm.address.userName)
									vm.dataList.address.push({
										'address':vm.address.provinCity,
										'username':vm.address.userName,
										'default':vm.address.isDefault,
										'detailaddrass':vm.address.addressDetail,
										'id':res.id[0]['max(id)'],
										'phone':vm.address.phone
									});
								}else{
									location.reload();
								}
								this.addWin=false;
							}else{
								alert(res.msg);
								
							}
						}, function(err){
							
						});
					},
					submitOrder:function(){
						var url='../php/createOrder/createOrder.php';
						addressId=this.selectedAddress;
						var obj={};
							obj.cmdId=[],
							obj.addressId=addressId;
							obj.liuyan=this.liuyan;
							for(a in this.dataList[0]){
								obj.cmdId.push({
									'cmdId':this.dataList[0][a][0].id,
									'counts':this.dataList[0][a].count
								});
							}
						this.$http.post(url, obj).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res);
							if(res.code==1){
								alert(res.msg);
								location.href='pay.php?order_code='+res.order_code;
							}else{
								alert(res.msg)
							}
						}, function(err){
							console.log(res);
							
						});
					}
				}
			});
		</script>
	</body>
</html>
