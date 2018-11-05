<?php
include_once '../weixin.class.php';
include_once '../lib/Bmob/BmobObject.class.php';
include_once '../lib/Bmob/BmobUser.class.php';
include_once '../res/action/do_login.php';

$user = new Dologin();
$user = $user->getuser();

$pagesize = 10;
$currentpage = $_GET["page"];
$skippage = ($_GET["page"] - 1) * $pagesize;

//获得数据
$object = new BmobObject("make_friend");
$res=$object->get("",array('where={"isactive":true}'))->results;
if(count($res) == 0) header('location:../web/depweb/error/nocontent.php');

$res1=$object->get("",array('include=parent','where={"isactive":true}',"limit=$pagesize",'order=sort,-createdAt',"skip=$skippage"))->results;
$informations = json_encode($res1);

(count($res)%$pagesize == 0) ? $lastpage = intval(floor(count($res)/$pagesize)): $lastpage = intval(floor(count($res)/$pagesize)) + 1;
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<title>高邮老乡</title>
        <link rel="stylesheet"  href="../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../css/pages/make_friend.css">
		<link rel="stylesheet"  href="../css/iconfont1.css">
        <link rel="stylesheet"  href="../css/myPage.css">
        <link rel="stylesheet" href="../css/swiper.min.css">
        <script src="../js/swiper.min.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jqPaginator.min.js"></script>
        <script src="../js/iconfont.js"></script>

	</head>
	<body>
        <div style="display:flex;line-height: 30px;padding: 5px 10px;">
            <div style="width:20px;margin-right:5px"><i class="iconfont icon-laba" style="font-size:20px;color:#f30"></i></div>
            <div  style="width:calc(100% - 25px)"><marquee width=100% behavior=scroll direction=left align=left>
               人无癖不可与交，以其无深情也；人无疵不可与交，以其无真气也。
             </marquee></div>
			 <div style="width:20px;margin-left:5px" id="edit">
			   <a href ="consoleweb/edit.php?type=make_friend">
				 <i class="iconfont icon-fabu1" style="font-size:20px;color:#919191"></i>
			   </a>
			 </div>
        </div>

        <div class="main" id="main"></div>

        <div id="form1" runat="server" style="margin:10px 0;height:34px">
          <div style="text-align:center">
            <ul class="pagination" id="pagination"></ul>
            <input type="hidden" id="PageCount" runat="server" />
            <input type="hidden" id="PageSize" runat="server" value='10' />
            <input type="hidden" id="countindex" runat="server" value="10"/>
            <!--设置最多显示的页码数 可以手动设置 默认为7-->
            <input type="hidden" id="visiblePages" runat="server" value="5" />
         </div>
     </div>

       <script>
       var list = <?php echo $informations; ?>;
       console.log(list);

	   //得到列表
       for (var i = 0; i < list.length; i++)
       {
          var item = list[i];
          var html = "";
          html +="<div class='list' id='list' data-id="+item.objectId+">";
          html +="<div class='headeritem'><div class='avatar'><image src="+item.parent.avatar+" class='avatarimg' /></div>";
          html +="<div class='username'><div>"+item.parent.username+"</div><div class='creattime'>"+item.createdAt +"</div></div></div>";
          html +="<div class='titlestyle'>"+item.title+"</div>";
          if(item.sort == 1) html +='<div class="zhiding"><i class="iconfont icon-youqing" style="font-size:20px;color:#428bca;margin-right:5px"></i>置顶</div>';
          html +="</div>";
          $("#main").append(html);
       }

       $("#main").find("#list").bind("click",function(){
          window.location.href = "consoleweb/make_friend_detail.php?id="+$(this).attr("data-id");
       });

       $(document).ready(function()
       {
           var height = $(window).height();
           var width = $(window).width();
           var paginationheight = $("#form1").height();
           $("#main").css("height",height - paginationheight - 60);
           $(document.body).css('height',height);
       })

       //分页的功能
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
               first: '<li class="first"><a href="make_friend.php?page=1">首页</a></li>',
               last: '<li class="last"><a href="make_friend.php?page=<?php echo $lastpage; ?>">末页</a></li>',
               page: '<li class="page"><a href="make_friend.php?page={{page}}">{{page}}</a></li>',
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
