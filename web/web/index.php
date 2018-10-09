<?php
include_once '../weixin.class.php';
include_once '../phpcj/showtoast.php';
include_once '../phpcj/mask.php';
include_once '../phpcj/qrcodeshow.php';
include_once '../phpcj/button.php';
include_once '../phpcj/indexcaidan.php';
include_once '../lib/Bmob/BmobUser.class.php';

$weixin = new class_weixin();
$bmobUser = new BmobUser();

//$username = $_COOKIE["username"];
//$password = $_COOKIE["password"];
$username = "啦啦啦、岁月无恙";
$password = "oaFlg1uTBXz2U_J2njjOaUQY3_F0";
if($username ==null || $password ==null)
{
    if (!isset($_GET["code"])){
		$redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$jumpurl = $weixin->oauth2_authorize($redirect_url, "snsapi_userinfo", "123");
		Header("Location: $jumpurl");
	}else{
        $access_token_oauth2 = $weixin->oauth2_access_token($_GET["code"]);
		$userinfo = $weixin->oauth2_get_user_info($access_token_oauth2['access_token'], $access_token_oauth2['openid']);
		$name = $userinfo["nickname"];
		$password = $userinfo["openid"];
        $city = $userinfo["city"];
        $province = $userinfo["province"];

        $expire=time()+60*60*24*30;
        setcookie("username", $name, $expire);
        setcookie("password", $password, $expire);

        try {
            $res = $bmobUser->register(array("username"=>$userinfo["nickname"], "password"=>$userinfo["openid"],"openid"=>$userinfo["openid"],"avatar"=>str_replace("/0","/46",$userinfo["headimgurl"]),"sex"=>$userinfo["sex"],"city"=>$province.$city));
        } catch (Exception $e) {
            $res1 = $bmobUser->login($name,$password);
            $info=json_encode($res1);
            $info=json_decode($info,true);
        }
    }
}else {
    $res1 = $bmobUser->login($username,$password);
    $info=json_encode($res1);
    $info=json_decode($info,true);
}
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<title>个人中心</title>
		<link rel="stylesheet"  href="../css/index.css">
		<link rel="stylesheet"  href="../css/iconfont1.css">
		<script type="text/javascript" src="../srcjs/jquery.min.js"></script>
		<script type="text/javascript" src="../srcjs/bmob.js"></script>
        <script src="../js/iconfont.js"></script>
	</head>
	<body ontouchstart="">

		<div id="main" class="main">
            <div class="overplay">
                <img src="<?php echo $info["avatar"];?>" class="avatar">
                <div class="nickname"><?php echo $info["username"];?></div>
            </div>

            <div class="alllist">
                <div class="list">
                    <div class="iconstyle"><i class="iconfont icon-wode"></i></div>
                    <div class="listtext">我的认证</div>
                    <div class="iconstyle1"><i class="iconfont icon-youbian"></i></div>
                </div>
                <div class="list">
                    <div class="iconstyle"><i class="iconfont icon-6"></i></div>
                    <div class="listtext">我的手机</div>
                    <div class="iconstyle1"><i class="iconfont icon-youbian"></i></div>
                </div>
            </div>
	    </div>

      </div>

	    <script type="text/javascript">

	      $(document).ready(function()
	      {
	          var height = $(window).height();
	          $(document.body).css('height',height);

              $(function(){
        var $loadingToast = $('#loadingToast');
        $('#showLoadingToast').on('click', function(){
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);
            }, 2000);
        });
    });
          })


	    </script>

	</body>
</html>
