<?php
include_once '../weixin.class.php';
include_once '../lib/Bmob/BmobUser.class.php';
include_once '../lib/Bmob/BmobObject.class.php';

$weixin = new class_weixin();
$bmobUser = new BmobUser();

$username = $_COOKIE["username"];
$password = $_COOKIE["password"];
$pagesize = 10;
$currentpage = $_GET["page"];
$pagelimit = $_GET["page"] * $pagesize;
$skippage = ($_GET["page"] - 1) * $pagesize;

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

  $object = new BmobObject("find_work");
  $res=$object->get("",array('where={"isactive":true}'))->results;
  if(count($res) == 0) header('location:../web/depweb/error/nocontent.php');

  $res1=$object->get("",array('include=parent','where={"isactive":true}',"limit=$pagelimit",'order=sort',"skip=$skippage"))->results;
  $informations = json_encode($res1);

  (count($res)%$pagesize != 0) ? $lastpage = count($res)%$pagesize : $lastpage = count($res)%$pagesize + 1;
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<title>求职招聘</title>
        <link rel="stylesheet"  href="../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../css/index.css">
		<link rel="stylesheet"  href="../css/iconfont1.css">
        <link rel="stylesheet"  href="../css/myPage.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jqPaginator.min.js"></script>
        <script src="../js/iconfont.js"></script>
	</head>
	<body>
        <div class="main" id="main"></div>

        <div id="form1" runat="server" style="margin:10px 0;height:34px">
          <div style="text-align:center">
            <ul class="pagination" id="pagination"></ul>
            <input type="hidden" id="PageCount" runat="server" />
            <input type="hidden" id="PageSize" runat="server" value='8' />
            <input type="hidden" id="countindex" runat="server" value="10"/>
            <!--设置最多显示的页码数 可以手动设置 默认为7-->
            <input type="hidden" id="visiblePages" runat="server" value="5" />
         </div>
       </div>

       <script>
       var list = <?php echo $informations; ?>;
       console.log(list);

       for (var i = 0; i < list.length; i++)
       {
          var item = list[i];
          var html = "";
          html +="<div class='list' id='list' data-id="+item.objectId+">";
          html +="<div class='headeritem'><div class='avatar'><image src="+item.parent.avatar+" class='avatarimg' /></div>";
          html +="<div class='username'><div>"+item.parent.username+"</div><div class='creattime'>"+item.createdAt +"</div></div></div>";
          (item.sort <= 5) ? html +="<div class='titlestyle1'>"+item.title+"</div>":html +="<div class='titlestyle'>"+item.title+"</div>";
          if(item.sort <= 5) html +='<div class="zhiding"><i class="iconfont icon-redu" style="font-size:20px;color:#f30"></i>置顶</div>';
          html +="</div>";
          $("#main").append(html);
       }

       $("#main").find("#list").bind("click",function(){
          window.location.href = "consoleweb/index_detail.php?id="+$(this).attr("data-id");
       });

       $(document).ready(function()
       {
           var height = $(window).height();
           var paginationheight = $("#form1").height();
           $("#main").css("height",height - paginationheight - 20);
           $(document.body).css('height',height);
       })

       function loadData(num) {
           $("#PageCount").val(<?php echo count($res); ?>);
       };

       function exeData(num, type) {
           loadData(num);
           loadpage();
       };

       function loadpage() {
           var myPageCount = parseInt($("#PageCount").val());
           var myPageSize = parseInt($("#PageSize").val());
           var countindex = myPageCount % myPageSize > 0 ? (myPageCount / myPageSize) + 1 : (myPageCount / myPageSize);
           $("#countindex").val(countindex);

           $.jqPaginator('#pagination', {
               totalPages: parseInt($("#countindex").val()),
               visiblePages: parseInt($("#visiblePages").val()),
               currentPage: <?php echo $currentpage; ?>,
               first: '<li class="first"><a href="index.php?page=1">首页</a></li>',
               last: '<li class="last"><a href="index.php?page=<?php echo $lastpage; ?>">末页</a></li>',
               page: '<li class="page"><a href="index.php?page={{page}}">{{page}}</a></li>',
               onPageChange: function (num, type) {
                   if (type == "change") {
                        $("#main").empty();
                       exeData(num, type);
                   }
               }
           });
       };

       $(function () {
           loadData(<?php echo $currentpage; ?>);
           loadpage();
       });
       </script>
	</body>
</html>
