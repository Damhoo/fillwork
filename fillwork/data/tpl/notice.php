<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Notice Page!</title>
</head>
<style type="text/css">
body{background: #ccc;}
body,h1,h2,h3,h4,h5,div{padding:0;margin:0;}
.err-box{max-width: 640px;min-width: 320px;margin:50px auto 0 auto;background: #fff;border-radius: .25rem;padding: 1rem 3rem;}
.err-box h2{background: #FF8C00;color: white;padding: .1rem .2rem;margin-bottom: 1rem;}
.err-box h4{background: #efefef;padding: .1rem .2rem;text-align: right;}
</style>
<body>
<div class="err-box">
	<h2>Notice Tip</h2>
	<h3>Error: <?php echo $errmsg; ?></h3>
	<h3>File: <?php echo $errfile; ?></h3>
	<h3>Line: <?php echo $errline; ?></h3>
</div>
</body>
</html>