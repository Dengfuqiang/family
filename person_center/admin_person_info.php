<?php
	header("content-type:text/html;charset=utf-8");
	session_start();
	$useInfo=$_SESSION;
	require_once '../php/mysql.class.php';
	$mysql = new MySQL('localhost','root','','family');
	$sql="SELECT * FROM admin_users WHERE user_name ='".$useInfo['user_name']."' and pwd ='".$useInfo['pwd']."'";
	$result = $mysql->query($sql);
	if(empty($result)){
		echo "<script> location.href='../index/admin_login.html';</script>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<?php 
			$path = "http://localhost/family";
			echo "<link rel='stylesheet' type='text/css' href='$path/css/familyHeader.css'/>";
			?>
	
	</head>
	<style type="text/css">
	#content_ct div{
		text-align: left!important;
	}
		#content_ct img{
			width: 500px;
			height: auto;
			
		}
		.info_right td,.info_right th{
				border: 1px solid #e5e5e5;
				padding: 15px;
		}
		.to_pay{
			cursor: pointer;
		}
		.to_pay:hover{
			color: white;
			background-color: #ffa130;
			border-color: #ffa130;
		}
	</style>
	<body>
		<div id="familyAndContain">
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
									账号信息
								</span>
							</h2>
							<table  cellspacing="0" cellpadding="0"style="width: 100%; border: 1px solid #e5e5e5; text-align: center;">
								<tr><th>name</th><th>phone</th><th>pwd</th><th>purse_pwd</th><th>balance</th><th>opeation</th></tr>
								<tr v-for='item in data.userInfo'><td>{{item.name}}</td><td>{{item.phone}}</td><td>{{item.pwd}}</td><td>{{item.purse_pwd}}</td><td>{{item.balance}}</td>
								<td>
									<div class="to_pay" @click='deleteUser($indet,item)'>
										删除
									</div>
									<div class="to_pay" @click='changeUser($index,item)'>
										修改
									</div>
								</td>
								</tr>
							</table>
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
										<div class="item" v-if='items.order_status==1'><a href="javascript:void(0);" class="cancel_order"  @click='cencelOrder($parent.$index,items)'>删除订单</a></div>
										<div class="item" v-if='items.order_status==2'><a href="javascript:void(0);" class="to_pay">发货</a><a href="javascript:void(0);" class="cancel_order" @click='cencelOrder($parent.$index,items)'>删除订单</a></div>
										<div class="item" v-if='items.order_status==3'><a href="javascript:void(0);" class="cancel_order" @click='cencelOrder($parent.$index,items)'>删除订单</a></div>
										<div class="item" v-if='items.order_status==4'><a href="javascript:void(0);" class="cancel_order"></a><a href="javascript:void(0);" class="cancel_order" @click='cencelOrder($parent.$index,items)'>删除订单</a></div>
										<div class="item" v-if='items.order_status==5'><a href="javascript:void(0);" class="to_pay" @click='cencelSale($parent.$index,items)'>拒绝售后</a><a href="" class="cancel_order"></a><a href="javascript:void(0);" class="cancel_order" @click='cencelOrder($parent.$index,items)'>删除订单</a></div>
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
				<section class="my_favour_cmd info_right">
					<h2>
						<span  class="active_span">
							商品管理
						</span>
						<a href="" class="to_pay" style="float: right;margin: 5px 10px 0 0;" @click='add_cmd()'>添加商品</a>
					</h2>
					<div class="property box">
						<div class="item item2 "><label><input type="checkbox" name="" id="allSelect" @click='checkAll()'>全选</label><a href="javascript:void(0);" class="cancel_all" @click='deleteSelect()'>删除</a><span>商品详情</span></div>
						<div class="item">单价（元）</div>
						<div class="item">操作</div>
					</div>
					<ul class="commodity_list ">
						<li class="box" v-for='item in data.favourList' @click='to_deatil(item)'>
							<label><input @click='childCheck($index,item,$event)' type="checkbox" name="" id="" value="" :checked="checkAlls"></label>
							<div class="cmd_info item">
								<a href="javascript:void(0);" class="box">
									<div><img :src="item.pic" alt=""></div>
									<div class="item cd_title"><span v-text='item.title'>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>
							<div class="item before">￥<span class="price" v-text='item.salesPrice'>500</span></div>
							<div class="item"><a href="javascript:void(0);" class="to_pay" @click='edit_cmd(item)'>编辑商品</a><a href="javascript:void(0);" class="cancel" @click='deleteThis($index,item)'>删除</a></div>
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
				<section class="help_center info_right">
					<h2>
						<span >
							编辑商品
						</span>
					</h2>
					<form action="" method="post" id="edit_cmd">

						<label><span>原价:</span><input type="text" name="marketPrice" id="marketPrice" v-model='data.editCmd.marketPrice'  placeholder="请输入原价" /></label>
						<label><span>优惠价:</span><input type="text" name="salesPrice" id="salesPrice" v-model='data.editCmd.salesPrice'  placeholder="请再次优惠价" /></label>
						<label><span>标题:</span><input type="text" name="title" id="title" v-model='data.editCmd.title'  placeholder="请输入商品标题" /></label>
						<label><span>销量:</span><input type="text" name="sellerCount" id="sellerCount" v-model='data.editCmd.sellerCount' placeholder="请销量" /></label>
						<label >
							<select  name="" @change='selectOne($event)' style="display: inline-block;width: 114px;margin-left: 70px; height: 40px;border: 1px solid #e5e5e5;background: none;">
								<option value='0' v-if='data.category=="life_food"'>生活食品</option>
								<option value='1' v-if='data.category=="life_articles"'>生活食品</option>
								<option value='2' v-if='data.category=="life_furniture"'>生活食品</option>
							</select>
							<select name=""  @change='selectTwo($event)' style="display: inline-block;width: 114px;height: 40px;border: 1px solid #e5e5e5;background: none;">
								<option value="0">选择二级类目</option>
								<option :value="item.id" v-for='item in data.twoCategory.list.pageList'>{{item.title}}</option>
							</select>
						</label>
						<label><span>商品图片</span><img v-if='picFlag' style="width: 100px;height: 100px; display: inline-block;" :src="data.editCmd.pic" /><img  :src="newPic" v-if='!picFlag' style="width: 100px;height: 100px; display: inline-block;" /><input style="border: none;" type="file" name="pic" id="pic" @change='changePic($event)'/></label>
						<label><span>商品图片</span><input type="file"  style="border: none;" multiple="multiple" name="contents[]" id="contents" @change='changeContent($event)' /></label>
						<div id="content_ct" v-html='data.editCmd.content' v-if='contentFlag'>
							
						</div>
						<div id="div" v-if='!contentFlag'>
							<img style="width: 100px;height: 100px; display: inline-block;" :src="item" v-for='item in imgList' track-by="$index"/>
						</div>
						<input type="submit" value="保存" class="save"  @click.prevent='changePursePwd()'/>
					</form>
				</section>
				</template>
				<template id="feed_contain">
				<section class="feed_contain info_right" >
					<h2>
						<span >
							意见反馈
						</span>
					</h2>
					<table  cellspacing="0" cellpadding="0"style="width: 100%; border: 1px solid #e5e5e5; text-align: center;">
						<tr><th>id</th><th>phone</th><th>user_back</th><th>opeation</th></tr>
						<tr v-for='item in data.backList'><td>{{item.id}}</td><td>{{item.phone}}</td><td>{{item.user_back}}</td>
						<td>
							<div class="to_pay" @click='deleteBack($indet,item)'>
								删除
							</div>
						</td>
						</tr>
					</table>
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
						
						<label><span>用户名:</span><input type="text" name="" id="" placeholder="请输入密码" v-model='obj.name'/></label>
						<label><span>密码:</span><input type="password" name="" id="" placeholder="请输入密码" v-model='obj.pwd'/></label>
						<label><span>钱包密码:</span><input type="password" name="" id=""  placeholder="请输入新密码" v-model='obj.purse_pwd'/></label>
						<label><span>余额:</span><input type="text" name="" id="" placeholder="请再次输入密码" v-model='obj.balance'/></label>
						<i>注意：密码不得填空格，可由英文字母和数字组成</i>
						<input type="submit" value="保存" @click.prevent='submits' class="save"/>
					</form>
				</section>
				</template>
				<template id="change_purse_pwd">
				<section class="change_purse_pwd">
					<h2>
						<span >
							添加商品
						</span>
					</h2>
					<form action="" method="post" id="add_cmd">

						<label><span>原价:</span><input type="text" name="marketPrice" id="marketPrice"  placeholder="请输入原价" /></label>
						<label><span>优惠价:</span><input type="text" name="salesPrice" id="salesPrice"  placeholder="请再次优惠价" /></label>
						<label><span>标题:</span><input type="text" name="title" id="title"  placeholder="请输入商品标题" /></label>
						<label><span>销量:</span><input type="text" name="sellerCount" id="sellerCount" placeholder="请销量" /></label>
						<label >
							<select  name="" @change='selectOne($event)' style="display: inline-block;width: 114px;margin-left: 70px; height: 40px;border: 1px solid #e5e5e5;background: none;">
								<option :value='$index' v-for='item in oneCategory' >{{item}}</option>
							</select>
							<select name=""  @change='selectTwo($event)' style="display: inline-block;width: 114px;height: 40px;border: 1px solid #e5e5e5;background: none;">
								<option value="0">选择二级类目</option>
								<option :value="item.id" v-for='item in twoCategory.list.pageList'>{{item.title}}</option>
							</select>
						</label>
						<label><span>商品ID:</span><input type="num" name="id" id="id"  placeholder="请输入商品ID" /></label>
						<label><span>商品图片</span><input  style="border: none;" type="file" name="pic" id="pic" /></label>
						<label><span>商品图片</span><input  style="border: none;" type="file" multiple="multiple" name="contents[]" id="contents" @change='addContent($event)' /></label>
						<!--<div id="div">
							<img style="width: 100px;height: 100px; display: inline-block;" :src="item" v-for='item in imgList' track-by="$index"/>
						</div>-->
						<input type="submit" value="保存" class="save"  @click.prevent='changePursePwd()'/>
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
		<script src="../js/vue-resource.min.js"></script>
		<script type="text/javascript" src="../js/admin_person_center_index.js" ></script>
	</body>
</html>
