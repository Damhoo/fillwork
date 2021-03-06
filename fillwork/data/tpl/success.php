<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Success Page!</title>
</head>
<style type="text/css">
body{background: #ccc;}
.suc-box{max-width: 640px;min-width: 320px;margin:50px auto 0 auto;background: #fff;border-radius: .25rem;padding: 1rem 3rem;}
.suc-box h3{background: #98F898;color: white;padding: .1rem .2rem;}
.suc-box h4{background: #efefef;padding: .1rem .2rem;text-align: right;}
.suc-box h4 span{color: green;}
</style>
<body>
<div class="suc-box">
	<h3>Success Message</h3>
	<h2><?php echo $msg; ?></h2>
	<h4>页面将在 <span><?php echo $time; ?></span> 秒后跳转！</h4>
</div>
<script type="text/javascript">
window.onload = function () {
	setTimeout(function () {
		<?php echo $url; ?>
	}, <?php echo $time;?>*1000);
	var oSpan = document.getElementsByTagName('span')[0];
	var iTime = oSpan.innerHTML;
	function recvTime() {
		iTime--;
		if (iTime>0) oSpan.innerHTML = iTime;
	}
	setInterval(recvTime, 1000);
};
</script>
</body>
</html>