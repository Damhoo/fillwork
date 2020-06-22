<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Fatal Error</title>
<style type="text/css">
body{font-family: "Microsoft YaHei",'楷体';}
body,h1,div,h2,h3,h4,h5,h6,p{padding: 0;margin:0;}
.error{padding: 0 2rem;}
.error h1{font-size: 10rem;font-weight: normal;}
.error .trace{margin-top: 1rem;}
</style>
</head>
<body>
<div class='error'>
	<h1>:(</h1>
	<?php if(APP_DEBUG): ?>
	<div class="errinfo">
		<h2>错误位置：</h2>
		<h3>Error: <?php echo $e['message']; ?></h3>
		<h3>File: <?php echo $e['file']; ?></h3>
		<h3>Line: <?php echo $e['line']; ?></h3>
	</div>
	<div class="trace">
		<?php echo nl2br($e['trace']); ?>
	</div>
	<?php else: ?>
	<div class="msg"><?php echo $e['message']; ?></div>
	<?php endif ?>
</div>
</body>
</html>