<?php
		session_start();
		$_SESSION['username']=null;
		$_SESSION['phone']=null;
		echo "<script>alert('注销成功！');location.href='../../index/index.php'</script>";
?>