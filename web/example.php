<?php
require_once('../weixin.class.php');
include_once '../phpcj/navbottom.php';
include_once '../lib/BmobUser.class.php';
include_once '../lib/BmobBql.class.php';

?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>三行情书</title>
        <link rel="stylesheet"  href="../css/navbottom.css">
		<link rel="stylesheet"  href="../css/iconfont1.css">
		<script type="text/javascript" src="../srcjs/jquery.min.js"></script>
		<script type="text/javascript" src="../srcjs/bmob.js"></script>
		<!--<link rel="stylesheet"  href="../cjcss/danmu.css">-->
		<!--<script type="text/javascript" src="../cjjs/danmu.js"></script>-->
        <script src="../js/iconfont.js"></script>
	</head>
	<body ontouchstart="">
          <?php  $bottom =new Bottomnav("2");$bottom->Bottom() ?>
		  <!--<button id="stop" class="btn btn-primary">停止</button>-->
		  <!--<button id="open" class="btn btn-primary">弹</button>-->
		  <!--<div class="inputdanmu">
			  <input type="text" class="form-control" name="" id="barrage_content" placeholder="发送弹幕,最多15个字" maxlength=15>
			  <button class="btn btn-primary" id="submit_barraget">发送</button>
		  </div>-->
	    </script>
		<!--<script type="text/javascript" src="../cjjs/creatdanmu.js"></script>-->
	</body>
</html>
