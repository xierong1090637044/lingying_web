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
    <link rel="stylesheet" href="../css/weui.min.css">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/1.1.2/weui.min.css"/>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/iconfont.js"></script>
</head>
<style>
    .Mobcontent {
        padding: 15px 30px;
    }

    .avatar {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .avatarandname {
        display: inline-block;
        /*line-height: 4rem;*/
        align-items: center;
        text-align: center;
        list-style: none;
    }

    .nickname {
        margin: 0 0 0 10px;
    }

    .lineheight {
        line-height: 2rem;
    }

    .lineheight1 {
        line-height: 2rem;
        color: #fff;
        padding: 0px 20px;
        background: #202a36;
        border-radius: 20px;
        text-align: center;
    }

    .liststyle {
        width: 100%;
        padding: 10px 0;
        float: left;
    }

    .iconfont {
        font-size: 35px;
        color: #fff;
    }

    .iconfont1 {
        font-size: 35px !important;
    }

    .listitem {
        width: calc(25% - 10px);
        padding: 5px;
        border-radius: 4px;
        text-align: center;
        display: inline-block;
        float: left;
        margin: 5px;
        color: #000;
    }

    .iconstyle {
        background: #6ecad5;
        border-radius: 50%;
        height: 60px;
        width: 60px;
        text-align: center;
        line-height: 60px;
        margin: 0 auto;
    }

    .listtext {
        width: 100%;
        font-size: 13px;
        margin: 2px 0 0 0;
    }

    .weui_cell_ft:after{
        height: 10px!important;
        width: 10px!important;
    }

    p{
        margin: 10px 0px;
    }

</style>
<body ontouchstart="">
<div class="Mobcontent" id="Mobcontent">
    <div class="weui_cells_title" style="text-align: center">
        <!--        带图标、说明、跳转的列表项-->
        <ul class="avatarandname">
            <li><img src="<?php echo $avatar; ?>" class="avatar"></li>
            <li>
                <div class="lineheight"><?php echo $nickname; ?></div>
            </li>
        </ul>
    </div>
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="../images/logo1.png" alt="icon" style="width:20px;margin-right:5px;display:block">
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的认证</p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="../images/logo1.png" alt="icon" style="width:20px;margin-right:5px;display:block">
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的发布</p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="../images/logo1.png" alt="icon" style="width:20px;margin-right:5px;display:block">
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的申请 </p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="../images/logo1.png" alt="icon" style="width:20px;margin-right:5px;display:block">
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的手机</p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="../images/logo1.png" alt="icon" style="width:20px;margin-right:5px;display:block">
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>权限设置</p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
        <a class="weui_cell" href="../web/consoleweb/aboutus.php">
            <div class="weui_cell_hd">
                <img src="../images/logo1.png" alt="icon" style="width:20px;margin-right:5px;display:block">
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>关于我们</p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
    </div>

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
