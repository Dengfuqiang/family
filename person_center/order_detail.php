<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
		<link rel="stylesheet" type="text/css" href="../css/person_center/order_detail.css"/>
			<article>
				<section class="order_status">
					<p>当前订单状态： 宝贝已拍下， 请在3天 内付款；若未及时付款，系统将自动取消订单 </p>
					<a href="" class="to_pay_money">立即支付</a><a href="" class="cancel_order">取消订单</a>
				</section>
				<section class="order_info">
					<h2>订单信息</h2>
					<div class="order_info_ct">
						<p>收货地址：  庞少军，86-13751893217，广东省 广州市 天河区 车陂街道 广州市天河区东圃大马路8号时代TIT广</p>
						<p>订单编号： SKYJ12525441 </p>
						<p>创建时间： 2015-10-02 12:20</p>
						<div class="beizhu_ct">
							备注：
							<textarea name="" rows="" cols=""></textarea>
						</div>
					</div>
				</section>
				<section class="commodity_info">
					<h2>商品信息</h2>
					<div class="commodity_info_ct">
						<div class="property box">
							<div class="item item2 "><span>商品详情</span></div>
							<div class="item">规格</div>
							<div class="item">数量</div>
							<div class="item">单价（元）</div>
							<div class="item">订单状态</div>
							<div class="item">商品总价</div>
						</div>
						<ul class="commodity_list ">
							<li class="box">
								<div class="cmd_info item">
									<a href="#" class="box">
										<div><img src="../img/shiping (8).jpg" alt=""></div>
										<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
									</a></div>
								<div class="item ">￥<span class="price">500</span></div>

								<div class="item">x2</div>
								<div class="item before">￥158<p>在线支付</p></div>
								<div class="item after">代付款</div>
								<div class="item">￥316 <p>（运费：￥<span>10</span>）</p></div>
							</li>
							<li class="box">
								<div class="cmd_info item">
									<a href="#" class="box">
										<div><img src="../img/shiping (8).jpg" alt=""></div>
										<div class="item cd_title"><span>百草味 夏威夷果200g*3袋奶油 味  夏威夷果</span></div>
									</a></div>
								<div class="item ">￥<span class="price">500</span></div>

								<div class="item">x2</div>
								<div class="item before">￥158<p>在线支付</p></div>
								<div class="item after">代付款</div>
								<div class="item">￥316 <p>（运费：￥<span>10</span>）</p></div>
							</li>
						
						</ul>
						<div class="all_money">
							<span class="order_all_count">
								订单总价：<i>￥158</i> 元
							</span>
						</div>
					</div>
				</section>
			</article>
			<div class="add_address_window" >
				<div class="add_address_inner">
					<h3>使用新地址 <a href="" class="close_win"></a></h3>
					<div class="add_info">
						<form action="" method="post">
							<label><span>退款原因<i>*</i></span><input type="text" name="" id="" value="" placeholder="请输入退款原因"></label>
							<label><span>退款金额<i>*</i></span><input type="text" name="" id="" value="" placeholder="请输入退款金额"></label>
							
							<label><span>退款说明<i>*</i></span><textarea name="" rows="" cols="" id="back_cmd_detail" placeholder="请输入退款说明"></textarea>  </label>
							<label><span>上传凭证<i>*</i></span><a class="select_pic_bt" href="javascript:void(0);"><input type="file" name="upfile" id="upfile" value="" enctype="multipart/form-data"/><span>上传退款凭证</span></a></label>
							
							<input type="submit" value="提交" id="confirm_cmd_back">
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
	</body>
</html>