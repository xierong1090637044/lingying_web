<?php
     require_once "../jssdk.php";
     require_once "../res/comp/footer.php";
     include_once '../weixin.class.php';
     /* Report all errors except E_NOTICE */

     error_reporting(E_ALL^E_NOTICE);
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
    <link rel="stylesheet"  href="../css/index.css">
    <link rel="stylesheet"  href="../css/iconfont1.css">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/1.1.2/weui.min.css"/>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/iconfont.js"></script>
</head>
<body>


</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
        'openLocation',
        'getLocation',
        'onMenuShareTimeline',
        'onMenuShareAppMessage']
  });
  wx.ready(function () {
      wx.getLocation({
          type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
          success: function (res) {
              var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
              var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
              var speed = res.speed; // 速度，以米/每秒计
              var accuracy = res.accuracy; // 位置精度
          }
      });
  });
</script>
</html>
