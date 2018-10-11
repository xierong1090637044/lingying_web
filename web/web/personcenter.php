<?php
     require_once "../jssdk.php";
     require_once "../res/comp/footer.php";
     require_once '../res/class/GetUser.php';
     require_once '../res/action/require_mobile.php';
     include_once '../weixin.class.php';

     error_reporting(E_ALL^E_NOTICE);//忽略php的notice

     $id = $_GET["id"];
     $user = new GetUser($id);
     var_dump($user);
     if($user->res==null) header('location:../web/depweb/error/404.php');

     $nickname = $user->nickname();
     $avatar = $user->avatar();

     $ismoile = new ISMOBILE();
     $ismoile->do_iswechat();

     //微信jssdk配置
     $jssdk = new JSSDK("wx938b0fcd9237d92a", "d1ae3338d17116ccc6cc7bc85a849700");
     $signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>个人中心</title>
    <link rel="stylesheet"  href="../css/pages/personcenter.css">
    <link rel="stylesheet"  href="../css/iconfont1.css">
    <link rel="stylesheet" href="../css/weui.min.css">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/1.1.2/weui.min.css"/>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript" src="../js/pages/personcenter.js"></script>
    <script src="../js/iconfont.js"></script>
</head>
<body ontouchstart="">
<div class="Mobcontent" id="Mobcontent">

</body>

</html>
