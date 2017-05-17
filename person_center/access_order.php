<?php
	session_start();
	$useInfo=$_SESSION;
		include '../public/public_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/person_center/access_order.css"/>
			<article>
				<ul>
					<li>
						<div class="cmd_info_ct">
							<a href=""><img src="../img/120_120-(3)_02.png" alt="" />
								<div>
									<p class="title">坚果特产山核桃奶油味碧根...</p>
									<p>规格：600g</p>
									<p class="price">￥29.5 </p>
								</div>
							</a>
						</div>
						<div class="access_ct">
							<h3>评论
								<p>
									<span class="selected"></span>
									<span class="selected"></span>
									<span class="selected"></span>
									<span></span>
									<span></span>
								</p>
							</h3>
							<textarea name="" id="" cols="30" rows="10"></textarea>
							<a href="" class="submit_access">发表评论</a>
						</div>
					</li>
					
				</ul>
			</article>
			<?php
				include '../public/public_footer.php';
			?>
	</body>
</html>
