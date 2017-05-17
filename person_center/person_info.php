<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/person_center/person_info.css"/>
			<article class="person_info_arctile">
				<div class="nav_left">
					<ul>
						<li @click='navSelect($event,$index)' v-for='item in navInfo'><a href="javascript:void(0)" :class="{active_nav_select:navIndex==$index}" v-text='item'></a></li>
					</ul>
				</div>
					<component :is='currentView' :data='dataArr'></component>
				<template  id="info_right" >
						<section class="info_right" style="" >
							<h2>
								<span >
									个人资料
								</span>
							</h2>
							<form action="" method="post" class="person_info" >
								<label><span>头像：</span><div class="header_pic">
										<a href="">
											<img src="../img/120_120-(3)_02.png"/>
										</a>
									</div>
								</label>
								<label><span>姓名:</span><input type="text" name="" id="" v-model="data.userInfo.name" placeholder="骑着蜗牛狂飙"/></label>
								<p ><i>昵称长度不能超过8个字</i></p>
								<label><span>联系方式:</span><input type="text" name="" id="" v-model="data.userInfo.phone" placeholder="骑着蜗牛狂飙"/></label>
								<label for=""></label>
								<input type="submit" name="" class="save" value="保存" />
							</form>
							<div class="change_info">
								<p>
									<span>修改密码：</span>
									<i>经常的更换您的账号密码，并且不要和其他账号共用同一个密码</i>
									<a href="javascript:void(0);" @click='changePwd()'>修改</a>
								</p>
								<p>
									<span>修改钱包密码：</span>
									<i>经常的更换您的账号密码，并且不要和其他账号共用同一个密码</i>
									<a href="javascript:void(0);"  @click='changePurse()'>修改</a>
								</p>
							</div>
					</section>
				</template>
				<template id="order_list_ct">
					<section class="order_list_ct" >
						<h2>
							<span >
								我的订单
							</span>
							<div class="order_status_nav">
								<a href="javascript:void(0);" @click='tabSelect($index)' :class="{active_a:active==$index}" v-for='item in tabs' v-text='item'></a>
							</div>
						</h2>
						<div class="commodity_info_ct" v-for='items in data.myorder'>
							<div class="property box">
								<div class="item item2 "><span>商品详情</span></div>
								<div class="item">数量</div>
								<div class="item">总价（元）</div>
								<div class="item">交易状态</div>
								<div class="item">交易操作</div>
							</div>
							<ul class="commodity_list">
								<li v-for='child in items.cmd_list'>
									<div class="order_bianhao">
										订单编号：<span v-text='items.order_code'>SHYJ125203</span>
									</div>
									<div class="order_info_contain  box">
										<div class="order_cmd_info item">
											<a href="#" class="box">
												<div><img :src="child.commodity_img" alt=""></div>
												<div class="item cd_title"><span v-text='child.commodity_title'></span></div>
											</a>
										</div>
										<div class="item">x{{child.cmd_count}}</div>
										<div class="item order_before"><span class="price">￥{{child.all_price}}</span><p class="pay_way">在线支付</p></div>
										<div class="item after  order_before" v-if='items.order_status==1'><p class="order_status">等待付款</p><a href="javascript:void(0)" class="order_detail" @click='orderDetial(items)'>订单详情</a></div>
										<div class="item after  order_before" v-if='items.order_status==2'><p class="order_status">待发货</p><a href="javascript:void(0)" class="order_detail" @click='orderDetial(items)'>订单详情</a></div>
										<div class="item after  order_before" v-if='items.order_status==3'><p class="order_status" >待收货</p><a href="javascript:void(0)" class="order_detail" @click='orderDetial(items)'>订单详情</a></div>
										<div class="item after  order_before" v-if='items.order_status==4'><p class="order_status">已完成</p><a href="javascript:void(0)" class="order_detail" @click='orderDetial(items)'>订单详情</a></div>
										<div class="item after  order_before" v-if='items.order_status==5'><p class="order_status">售后处理中</p><a href="javascript:void(0)" class="order_detail" @click='orderDetial(items)'>订单详情</a></div>
										<div class="item" v-if='items.order_status==1'><a href="javascript:void(0);" class="to_pay" @click='topay($parent.$index,items)'>立即付款</a><a href="javascript:void(0);" class="cancel_order"  @click='cencelOrder($parent.$index,items)'>取消订单</a></div>
										<div class="item" v-if='items.order_status==2'><a href="javascript:void(0);" class="cancel_order" @click='cencelOrder($parent.$index,items)'>取消订单</a></div>
										<div class="item" v-if='items.order_status==3'><a href="javascript:void(0);" class="to_pay" @click='getCmd($parent.$index,items)'>收货</a></div>
										<div class="item" v-if='items.order_status==4'><a href="" class="cancel_order"></a></div>
										<div class="item" v-if='items.order_status==5'><a href="" class="to_pay" @click='cencelSale()'>取消售后</a><a href="" class="cancel_order"></a></div>
									</div>
								</li>
								
							
							</ul>
							
						</div>
					</section>
				</template>
				<template id="my_purse_info">
				<section class="my_purse_info" >
					<h2>
						<span  class="active_span">
							我的钱包
						</span><span>
							账单
						</span>
					</h2>
					<div class="purse_wrap">
						<div class="purse_inner">
							<p class="my_price">我的余额</p>
							<p>￥<span>88.50</span></p>
						</div>
						<p href="" class="zhifubao">支付宝</p>
						<a href="" class="to_charge">充值</a>
					</div>
					<div class="my_bill">
						<ul>
							<li>
								<p>充值<span>+100</span></p>
								<p class="pay_time">2017-4-6 3:50</p>
							</li>
							<li>
								<p>充值<span>+100</span></p>
								<p class="pay_time">2017-4-6 3:50</p>
							</li>
							<li>
								<p>充值<span>+100</span></p>
								<p class="pay_time">2017-4-6 3:50</p>
							</li>
						</ul>
					</div>
				</section>
				</template>
				<template id="my_favour_cmd">
				<section class="my_favour_cmd">
					<h2>
						<span  class="active_span">
							我的收藏
						</span>
					</h2>
					<div class="property box">
						<div class="item item2 "><label><input type="checkbox" name="" id="allSelect" @click='checkAll()'>全选</label><a href="javascript:void(0);" class="cancel_all" @click='deleteSelect()'>删除</a><span>商品详情</span></div>
						<div class="item">单价（元）</div>
						<div class="item">操作</div>
					</div>
					<ul class="commodity_list ">
						<li class="box" v-for='item in data.favourList'>
							<label><input @click='childCheck($index,item,$event)' type="checkbox" name="" id="" value="" :checked="checkAlls"></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img :src="item.pic" alt=""></div>
									<div class="item cd_title"><span v-text='item.title'>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>
							<div class="item before">￥<span class="price" v-text='item.salesPrice'>500</span></div>
							<div class="item"><a href="javascript:void(0);" class="cancel" @click='deleteThis($index,item)'>删除</a></div>
						</li>
					</ul>
				</section>
				</template>
				<template id="address_ct">
					<section class="address_ct" >
						<h2>
							<span >
								收获地址
							</span>
						</h2>
						<div class="address">
							<ul class="address_list">
								<li @click='selected($index,item,$event)' :class="defaults(item,$index)&&$index==thisIndex?'selected':''" v-for='item in data.addressList'>
									<p><span>{{item.address}}（{{item.username}}收）</span><span v-text='item.phone'>13689223290</span></p>
									<p v-text='item.detailaddrass'>天河车陂东圃大马路8号时代TIT广场A座4楼430</p>
									<div class="change_address"><a href="javascript:;" class="change_bt" @click='changeAddress(item)'>修改</a> | <a href="javascript:;" class="cancel_bt" @click='deleteAddress($index,item)'>删除</a></div>
								</li>
							</ul>
							<a href="javascript:void(0);" class="add_address" @click='addAddress'>+添加地址</a>
						</div>
						<div class="add_address_window" v-show='addWin'>
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
					</section>
				</template>
				<template id="help_center">
				<section class="help_center">
					<h2>
						<span >
							帮助中心
						</span>
					</h2>
					<div class="problem">
						<h3>常见问题</h3>
						<h2>1.如何修改收货地址 </h2>
						<p>答：在个人中心-送货地址进入可修改详细地址  </p>
						<h2> 2.如何修改密码</h2>
						<p>答：在个人中心-送货地址进入可修改详细地址</p>
						<h2>3.如何退款</h2>
						<p>答：在个人中心-送货地址进入可修改详细</p>
					</div>
					<div class="customer_server_center">
						<i></i>
						<p>周一至周五 8:00-6:00 </p>
						<h4>4000-8888-08</h4>
						<a href="javascript:void(0)">一键拨打</a>
					</div>
				</section>
				</template>
				<template id="feed_contain">
				<section class="feed_contain" >
					<h2>
						<span >
							意见反馈
						</span>
					</h2>
					<div class="feed_back">
						<textarea name="" rows="" cols="" v-model='backs'>
						
						</textarea>
						<div @click='back()' class="submit_feed" >提交</div>
					</div>
				</section>
				</template>
				<template id="change_pwd">
				<section class="change_pwd" >
					<h2>
						<span >
							修改密码
						</span>
					</h2>
					<form action="" method="post">
						
						<label><span>当前密码:</span><input type="password" name="" id="" value="" placeholder="请输入密码" v-model='obj.oldPwd'/></label>
						<label><span>新密码:</span><input type="password" name="" id="" value="" placeholder="请输入新密码" v-model='obj.newPwd'/></label>
						<label><span>确认密码:</span><input type="password" name="" id="" value="" placeholder="请再次输入密码" v-model='obj.repeatPwd'/></label>
						<i>注意：密码不得填空格，可由英文字母和数字组成</i>
						<input type="submit" value="保存" @click.prevent='submits' class="save"/>
					</form>
				</section>
				</template>
				<template id="change_purse_pwd">
				<section class="change_purse_pwd">
					<h2>
						<span >
							修改钱包密码
						</span>
					</h2>
					<form action="" method="post" v-if='data.purse'>
						<label><span>新密码:</span><input type="password" name="" id="" value="" placeholder="请输入新密码" v-model='changeData.newPursePwd'/></label>
						<label><span>确认密码:</span><input type="password" name="" id="" value="" placeholder="请再次输入密码" v-model='changeData.repeatPwd'/></label>
						<label><span>手机号码:</span><input type="text" name="" id="" value="" placeholder="请输入手机号码" v-model='changeData.phone'/></label>
						<label><span>验证码:</span><input type="text" name="" id="sms" value="" placeholder="请输入验证码" v-model='changeData.sms'/><a href="" id="sms_bt">获取验证码</a></label>
						<i>注意：密码不得填空格，可由英文字母和数字组成</i>
						<input type="submit" value="保存" class="save"  @click.prevent='changePursePwd()'/>
					</form>
					<form action="#" method="post" v-else>
						<label><span>钱包密码:</span><input type="text" name="" id="" value="" placeholder="请设置钱包密码" v-model='pursePwd'/></label>
						<input type="submit" value="保存" class="save" @click.prevent='setPursePwd()'/>
					</form>
				</section>
				</template>
				<template id="loading">
					<section class="loading">
						<span></span><a href="javascript:void(0);">数据加载中</a>
					</section>
				</template>
			</article>
			<article class="pay_success" style="display: none">
				<div class="pay_status">
						<h3>恭喜您已成功支付</h3>
						<p> 您可以在个人中心 > 我的订单中查询。</p>
				</div>
				<p class="auto_goback"><span>5</span>秒后 <a href="">自动返回>></a></p>
			</article>
			<?php
				include '../public/public_footer.php';
			?>
		</div>
		<script type="text/javascript" src="../js/vue.js" ></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
		<script type="text/javascript" src="../js/person_center_index.js" ></script>
		<script type="text/javascript">
			<?php
			 	if(isset($_GET['tab'])){
			 		echo 'var tab="'.$_GET['tab'].'",selectNum='.$_GET['selectNum'].';';
			 	}else{
			 		echo 'var tab="child0",selectNum=0;';
			 	}
			 
			 ?>
		</script>
	</body>
</html>
