<?php
	session_start();
	$useInfo=$_SESSION;
	include '../public/public_header.php';
	var_dump($_POST)
?>
		<link rel="stylesheet" type="text/css" href="../css/lifefood/to_buy.css"/>
			<article>
				<form action="" method="post">
					<div class="address">
						<h2>选择收货地址</h2>
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
					<div class="confirm_order_info">
						<h2>确认订单信息</h2>
						<div class="property box">
							<div class="item item2 "><span>商品详情</span></div>
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
						<div class="liuyan">
							<label>买家留言：<input type="text" name="" value="" id="" /></label>
							<div class="zongji">
								<p>总计：<i>158.00</i></p>
								<input type="submit" name="" id="" value="提交订单" class="confirm_submit" />
							</div>
						</div>
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
			<div class="add_address_window" style="display: none;">
				<div class="add_address_inner">
					<h3>使用新地址 <a href="" class="close_win"></a></h3>
					<div class="add_info">
						<p><span>新增收货地址</span>电话号码、手机号选填一项，其余均为必真项</p>
						<form action="" method="post">
							<label><span>收货人姓名</span><input type="text" name="" id="reciver_name" value="" placeholder="长度不超过25个字符"/></label>
							<label><span>手机号码<i>*</i></span><input type="text" name="" id="mobile_phone" value="" placeholder="请输入手机号" /></label>
							<label><span>所在城市<i>*</i></span><input type="text" name="" id="city" value="" placeholder="请输入省市区" /></label>
							<label><span>详细地址<i>*</i></span><textarea name="" rows="" cols=""  id="address_detail" placeholder="建议你如实填写的的信息，如街道门牌号..."></textarea>  </label>
							<label><input type="checkbox" name="isdefault" id="isdefault" value="" />设置为默认收货地址</label>
							<input type="submit" value="保存" id="confirm_add_address"/>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>