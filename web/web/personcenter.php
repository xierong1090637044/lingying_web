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
    <title>个人中心</title>
    <link rel="stylesheet"  href="../css/pages/personcenter_1.css">
    <link rel="stylesheet"  href="../css/iconfont1.css">
    <link rel="stylesheet" href="../css/bootstrap1.min.css">
    <link rel="stylesheet" href="../css/weui.min.css">
    <link rel="stylesheet" href="../css/jquery-weui.css">
    <link rel="stylesheet" href="../css/demos.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/fastclick.js"></script>
    <script type="text/javascript" src="../js/pages/personcenter.js"></script>
    <script src="../js/iconfont.js"></script>
</head>
<body ontouchstart="">
<div class="Mobcontent" id="Mobcontent">
    <div class="headeritme">
        <div><img src="<?php echo $avatar;?>" class="avatar"></div>
        <div style="color:#fff;margin-left:10px;padding: 5px 0;text-align:left">
            <div style="margin-bottom:5px"><?php echo $nickname;?></div>
            <!--<div class="bindmobileicon"><i class="iconfont icon-6"></i></div>-->
            <div class="bindmobileicon"><i class="iconfont icon-weixin1"></i></div>
        </div>
        <!--<div class="mycode" id="mycode"><i class="iconfont icon-erweima" style="font-size:20px"></i></div>-->
    </div>
    <div class="border-choice">

        <div class="every-item" id='show-actions'>
            <div>
                <div class="item-border"><i class="iconfont icon-icon" style="font-size:20px"></i></div>
                <span>我要发布</span>
            </div>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>

        <div class="every-item">
            <div>
                <div class="item-border"><i class="iconfont icon-kecheng" style="font-size:20px"></i></div>
                <span>我的发布</span>
            </div>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>

        <div class="every-item">
            <div>
                <div class="item-border"><i class="iconfont icon-6" style="font-size:20px"></i></div>
                <span>我的手机</span>
            </div>
            <div><i class="iconfont icon-youbian" style="font-size:20px;color:#999"></i></div>
        </div>

    </div>
    <?php $loading = new Dialog('dialog','dialog',"我的二维码","<img id='qrocde' class='qrcode'>");$loading->dialog()  ?>
</body>

<script src="../js/jquery-weui.js"></script>
<script>
        var codeimg = "<?php  echo $codeimg ?>";
        $("#qrocde").attr("src",codeimg);
</script>

</html>
