<?php
include_once $_SERVER['DOCUMENT_ROOT'].'ycwfw_web/web/weixin.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'ycwfw_web/web/lib/Bmob/BmobUser.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'ycwfw_web/web/lib/Bmob/BmobObject.class.php';

/*** */
class Dologin
{

    function __construct()
    {
        // code...
    }

    public function getuser()
    {

        $weixin = new class_weixin();
        $bmobUser = new BmobUser();

        $username = $_COOKIE["username"];
        $password = $_COOKIE["password"];

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

                    return $info;
                } catch (Exception $e) {
                    $res1 = $bmobUser->login($name,$password);
                    $info=json_encode($res1);
                    $info=json_decode($info,true);

                    return $info;
                }
            }
        }else {
            $res1 = $bmobUser->login($username,$password);
            $info=json_encode($res1);
            $info=json_decode($info,true);

            return $info;
        }
    }
}
?>