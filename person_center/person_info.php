<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/person_center/person_info.css"/>
			<article class="person_info_arctile">
				<div class="nav_left">
					<ul>
						<li><a href="">基本资料</a></li>
						<li><a href="">升级会员</a></li>
						<li><a href="">我的订单</a></li>
						<li><a href="">我的钱包</a></li>
						<li><a href="">我的收藏</a></li>
						<li><a href="">收货地址</a></li>
						<li><a href="">帮组中心</a></li>
						<li><a href="">意见反馈</a></li>
					</ul>
				</div>
				<section class="info_right" style="display: none" >
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
						<label><span>姓名:</span><input type="text" name="" id="" value="" placeholder="骑着蜗牛狂飙"/></label>
						<p ><i>昵称长度不能超过8个字</i></p>
						<label><span>联系方式:</span><input type="text" name="" id="" value="" placeholder="骑着蜗牛狂飙"/></label>
						<label for=""></label>
						<input type="submit" name="" class="save" value="保存" />
					</form>
					<div class="change_info">
						<p>
							<span>修改密码：</span>
							<i>经常的更换您的账号密码，并且不要和其他账号共用同一个密码</i>
							<a href="">修改</a>
						</p>
						<p>
							<span>修改钱包密码：</span>
							<i>经常的更换您的账号密码，并且不要和其他账号共用同一个密码</i>
							<a href="">修改</a>
						</p>
					</div>
				</section>
				<section class="change_pwd" style="display: none">
					<h2>
						<span >
							修改密码
						</span>
					</h2>
					<form action="" method="post">
						
						<label><span>当前密码:</span><input type="text" name="" id="" value="" placeholder="请输入密码"/></label>
						<label><span>新密码:</span><input type="text" name="" id="" value="" placeholder="请输入新密码"/></label>
						<label><span>确认密码:</span><input type="text" name="" id="" value="" placeholder="请再次输入密码"/></label>
						<i>注意：密码不得填空格，可由英文字母和数字组成</i>
						<input type="submit" value="保存" class="save"/>
					</form>
				</section>
				<section class="change_purse_pwd" style="display: none">
					<h2>
						<span >
							修改钱包密码
						</span>
					</h2>
					<form action="" method="post">
						

						<label><span>新密码:</span><input type="text" name="" id="" value="" placeholder="请输入新密码"/></label>
						<label><span>确认密码:</span><input type="text" name="" id="" value="" placeholder="请再次输入密码"/></label>
						<label><span>手机号码:</span><input type="text" name="" id="" value="" placeholder="请输入手机号码"/></label>
						<label><span>验证码:</span><input type="text" name="" id="sms" value="" placeholder="请输入验证码"/><a href="" id="sms_bt">获取验证码</a></label>
						<i>注意：密码不得填空格，可由英文字母和数字组成</i>
						<input type="submit" value="保存" class="save"/>
					</form>
				</section>
				
				<section class="my_purse_info"  style="display: none;">
					<h2>
						<span  class="active_span">
							我的钱包
						</span><span>
							账单
						</span>
					</h2>
					<div class="purse_wrap" style="display: none;">
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
				<section class="my_favour_cmd" style="display: none;">
					<div class="property box">
						<div class="item item2 "><label><span class="check_span"></span><input type="checkbox" name="" id="" value="">全选</label><a href="javascript:;" class="cancel_all">删除</a><span>商品详情</span></div>
						<div class="item">单价（元）</div>
						<div class="item">操作</div>
					</div>
					<ul class="commodity_list ">
						<li class="box">
							<label><span class="check_span"></span><input type="checkbox" name="" id="" value=""></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img src="../img/shiping (8).jpg" alt=""></div>
									<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>
							<div class="item before">￥<span class="price">500</span></div>
							<div class="item"><a href="#" class="cancel">删除</a></div>
						</li>
						<li class="box">
							<label><span class="check_span"></span><input type="checkbox" name="" id="" value=""></label>
							<div class="cmd_info item">
								<a href="#" class="box">
									<div><img src="../img/shiping (8).jpg" alt=""></div>
									<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
								</a></div>
							<div class="item before">￥<span class="price">500</span></div>
							<div class="item"><a href="#" class="cancel">删除</a></div>
						</li>
					</ul>
				</section>
				<section class="help_center" style="display: none;">
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
				<section class="feed_contain" style="display: none;">
					<h2>
						<span >
							意见反馈
						</span>
					</h2>
					<div class="feed_back">
						<textarea name="" rows="" cols="">
						
						</textarea>
						<a href="" class="submit_feed">提交</a>
					</div>
				</section>
				<section class="address_ct"  style="display: none">
					<h2>
						<span >
							收获地址
						</span>
					</h2>
						<div class="address">
							<ul class="address_list">
								<li class="selected">
									<p><span>广东广州（庞少军收）</span><span>13689223290</span></p>
									<p>天河车陂东圃大马路8号时代TIT广场A座4楼430</p>
									<div class="change_address"><a href="javascript:;" class="change_bt">修改</a> | <a href="javascript:;" class="cancel_bt">删除</a></div>
								</li>
								<li class="">
									<p><span>广东广州（庞少军收）</span><span>13689223290</span></p>
									<p>天河车陂东圃大马路8号时代TIT广场A座4楼430</p>
									<div class="change_address"><a href="javascript:;" class="change_bt">修改</a> | <a href="javascript:;" class="cancel_bt">删除</a></div>
								</li>
								<li class="">
									<p><span>广东广州（庞少军收）</span><span>13689223290</span></p>
									<p>天河车陂东圃大马路8号时代TIT广场A座4楼430</p>
									<div class="change_address"><a href="javascript:;" class="change_bt">修改</a> | <a href="javascript:;" class="cancel_bt">删除</a></div>
								</li>
							</ul>
							<a href="" class="add_address">+添加地址</a>
						</div>
				</section>
				<section class="order_list_ct" >
					<h2>
						<span >
							我的订单
						</span>
						<div class="order_status_nav">
							<a href="" class="active_a">待付款</a>
							<a href="">待发货</a>
							<a href="">待收货</a>
							<a href="">已完成</a>
							<a href="">退货/售后</a>
						</div>
					</h2>
					<div class="commodity_info_ct">
						<div class="property box">
							<div class="item item2 "><span>商品详情</span></div>
							<div class="item">数量</div>
							<div class="item">单价（元）</div>
							<div class="item">交易状态</div>
							<div class="item">交易操作</div>
						</div>
						<ul class="commodity_list">
							<li>
								<div class="order_bianhao">
									订单编号：<span>SHYJ125203</span>
									<a href="" class="delete_order"></a>
								</div>
								<div class="order_info_contain  box">
									<div class="order_cmd_info item">
										<a href="#" class="box">
											<div><img src="../img/shiping (8).jpg" alt=""></div>
											<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
										</a>
									</div>
									<div class="item">x2</div>
									<div class="item order_before"><span class="price">￥158.00</span><p class="pay_way">在线支付</p></div>
									<div class="item after  order_before"><p class="order_status">等待付款</p><a href="javascript:void(0)" class="order_detail">订单详情</a></div>
									<div class="item"><a href="" class="to_pay">立即付款</a><a href="" class="cancel_order">取消订单</a></div>
								</div>
							</li>
							<li>
								<div class="order_bianhao">
									订单编号：<span>SHYJ125203</span>
									<a href="" class="delete_order"></a>
								</div>
								<div class="order_info_contain  box">
									<div class="order_cmd_info item">
										<a href="#" class="box">
											<div><img src="../img/shiping (8).jpg" alt=""></div>
											<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
										</a>
									</div>
									<div class="item">x2</div>
									<div class="item order_before"><span class="price">￥158.00</span><p class="pay_way">在线支付</p></div>
									<div class="item after  order_before"><p class="order_status">等待付款</p><a href="javascript:void(0)" class="order_detail">订单详情</a></div>
									<div class="item"><a href="" class="to_pay">立即付款</a><a href="" class="cancel_order">取消订单</a></div>
								</div>
							</li>
						
						</ul>
						
					</div>
				</section>
			</article>
			<article class="pay_success" style="display: none">
				<div class="pay_status">
						<h3>恭喜您已成功支付</h3>
						<p> 您可以在个人中心 > 我的订单中查询。</p>
				</div>
				<p class="auto_goback"><span>5</span>秒后 <a href="">自动返回>></a></p>
			</article>
			<div class="add_address_window"  style="display: none">
				<div class="add_address_inner">
					<h3>使用新地址 <a href="" class="close_win"></a></h3>
					<div class="add_info">
						<p><span>新增收货地址</span>电话号码、手机号选填一项，其余均为必真项</p>
						<form action="" method="post">
							<label><span>收货人姓名</span><input type="text" name="" id="reciver_name" value="" placeholder="长度不超过25个字符"></label>
							<label><span>手机号码<i>*</i></span><input type="text" name="" id="mobile_phone" value="" placeholder="请输入手机号"></label>
							<label><span>所在城市<i>*</i></span><input type="text" name="" id="city" value="" placeholder="请输入省市区"></label>
							<label><span>详细地址<i>*</i></span><textarea name="" rows="" cols="" id="address_detail" placeholder="建议你如实填写的的信息，如街道门牌号..."></textarea>  </label>
							<label><input type="checkbox" name="isdefault" id="isdefault" value="">设置为默认收货地址</label>
							<input type="submit" value="保存" id="confirm_add_address">
						</form>
					</div>
				</div>
			</div>
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
	</body>
</html>