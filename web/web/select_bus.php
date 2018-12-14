<?php
     include_once '../weixin.class.php';
     require_once "../res/comp/dialog.php";
     require_once '../res/class/GetUser.php';
     require_once '../res/action/get_code.php';
     require_once '../res/action/require_mobile.php';
     include_once '../res/action/do_login.php';

     error_reporting(E_ALL^E_NOTICE);//忽略php的notice
     $ismoile = new ISMOBILE();
     $ismoile->do_iswechat();

     $user = new Dologin();
     $user = $user->getuser();

     $avatar = $user->avatar;
     $nickname = $user->username;
     $id = $user->objectId;

     $getcode = new Code($id);
     $codeimg = $getcode->getcodeimg();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>高邮公交信息</title>
    <link rel="stylesheet"  href="../css/pages/select_bus.css">
    <link rel="stylesheet"  href="../css/iconfont1.css">
    <link rel="stylesheet" href="../css/bootstrap1.min.css">
    <link rel="stylesheet" href="../css/weui.min.css">
    <link rel="stylesheet" href="../css/jquery-weui.css">
    <link rel="stylesheet" href="../css/demos.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/iconfont.js"></script>
</head>
<body ontouchstart="">
<div class="Mobcontent" id="Mobcontent">
    <div class="border-choice">

        <div class="every-item" id='show-actions'>
            <div>
                <a href="consoleweb/bus_way.php?name=高邮1路" style="width:100%">
                    <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                    <span>高邮1路公交车</span>
                </a>
            </div>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>

        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮2路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮2路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>

        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮3路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮3路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>

        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮4路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮4路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>

        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮5路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮5路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>
        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮6路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮6路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>
        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮7路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮7路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>
        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮8路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮8路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>
        <div class="every-item">
            <a href="consoleweb/bus_way.php?name=高邮9路" style="width:100%">
                <div class="item-border"><i class="iconfont icon-gongjiao" style="font-size:20px"></i></div>
                <span>高邮9路公交车</span>
            </a>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>
        <iframe  style="width:100%;padding: 15px;" src="//www.seniverse.com/weather/weather.aspx?uid=U5FB95A1A2&cid=CHJS050300&l=zh-CHS&p=SMART&a=0&u=C&s=1&m=2&x=1&d=3&fc=&bgc=&bc=&ti=0&in=0&li=" frameborder="0" scrolling="no" width="200" height="230" allowTransparency="true"></iframe>
    </div>
</body>


</html>
