<?php
     require_once '../res/action/require_mobile.php';
     require_once "../res/comp/footer.php";

	 $ismoile = new ISMOBILE();
	 $ismoile->do_iswechat();

    if(isset($_COOKIE["phonenumber"])){
        header('location:personcenter.php?id='.$_COOKIE["phonenumber"]);
    }
?>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>手机登录</title>
        <link rel="stylesheet"  href="../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../css/iconfont1.css">
        <link rel="stylesheet"  href="../css/pages/index.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery.cookie.js"></script>
        <script type="text/javascript" src="../js/pages/index.js"></script>
        <script src="../js/iconfont.js"></script>
	</head>
	<body ontouchstart="">
     <div style="width:100%;margin-bottom:40px"><img src="../images/header.png" style="width:100%"/> </div>
	 <div class="Mobcontent" id="Mobcontent">
         <div class="input_mob">
             <input maxlength="11" placeholder="请输入手机号" class="input" id="mobilenumber"/>
         </div>
         <div class="input_code">
             <div>
                 <input class="input" maxlength="6" placeholder="验证码" id="code"/>
             </div>
             <div style="width:35%"><button class="getcode" id = "getcode">发送验证码</button></div>
         </div>
         <div class="login" id ="login">登录</div>

         <div id="toast" class="toast"></div>
     </div>
     <?php  $loading = new footer('footer');$loading->footer()?>
	</body>
</html>
