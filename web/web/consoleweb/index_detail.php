<?php
  include_once '../../lib/Bmob/BmobObject.class.php';
  include_once '../../lib/Bmob/BmobUser.class.php';

  $bmobObj = new BmobObject("find_work");
  $bmobUser = new BmobUser();
  $res=$bmobObj->get($_GET["id"],array('include=parent','where={"isactive":"true"}'));
  $result = json_encode($res);


  //用户登录
  $username = $_COOKIE["username"];
  $password = $_COOKIE["password"];
  $info = $bmobUser->login($username,$password);

  //查询评论
  $id = $_GET["id"];
  $comment = new BmobObject("Comment");
  $getcommet=$comment->get("",array('where={"post":{"__type":"Pointer","className":"find_work","objectId":'."\"".$id."\"".'}}','include=author','order=-createdAt'))->results;

  $getcommet_result = json_encode($getcommet);
?>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>详情</title>
        <link rel="stylesheet"  href="../../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../../css/iconfont1.css">
        <link rel="stylesheet"  href="../../css/consoleweb/index_detail.css">
		<script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script src="../../js/iconfont.js"></script>
	</head>
	<body>
        <div id="MobContain">
            <div class="title"><?php echo $res->title;  ?></div>

            <div style="display:flex;" class="seconditem">
                <div><img src="<?php echo $res->parent->avatar;  ?>"  class="avatar"/> </div>
                <div class="centeritem">
                    <div class="username"><?php echo $res->parent->username;  ?></div>
                    <div class="time"><?php echo $res->createdAt;  ?></div>
                </div>
                <div class="notice">楼主</div>
            </div>

            <div class="content">
                 <div><?php echo $res->content;  ?></div>
                 <div id="images" style="margin:10px 0 0"></div>
             </div>

             <div class="bordertop"></div>

             <div class="comment" id="commentview"></div>

             <div>
                 <div style="display:flex;margin:10px 0 0">
                     <div><img src="<?php echo $info->avatar;  ?>" class="avatar"/></div>
                     <div style="margin-left:10px;width: calc(100% - 50px);"><input maxlength="50" class="inputstyle" placeholder="我也说一句"/></div>
                 </div>
                 <div style="text-align:right;margin:10px 0 0"><button type="button" class="btn btn-info" id="comment">回复</button></div>
             </div>
        </div>

        <div class="mask"><img id="bigimage" class="bigimage"/></div>
        <script>
             var result = <?php echo $result; ?>;
             var getcommet_result = <?php echo $getcommet_result; ?>;
             console.log(getcommet_result);

             for (var i = 0; i < getcommet_result.length; i++) {
                 var item = getcommet_result[i];
                 console.log(item);
                 var html = "";
                 html +="<div class='list' id='list' data-id="+item.objectId+">";
                 html +="<div class='headeritem'><div class='avatar'><image src="+item.author.avatar+" class='avatar' /></div>";
                 html +="<div class='username_comment'><div style='color: #0006ff'>"+item.author.username+"</div><div class='creattime'>"+item.createdAt +"</div></div></div>";
                 html +="<div class='titlestyle1'>"+item.comment+"</div>";
                 (i == 0) ?html +="<div class='comment_notice'>沙发</div>":html +="<div class='comment_notice'>板凳</div>";
                 html +="</div>";
                 $("#commentview").append(html);
             }

            var html = "";
            if(result.image1 !=null) html += "<div class='imagesize'><img src="+result.image1.url+" class='listimage'></div>";
            if(result.image2 !=null) html += "<div class='imagesize'><img src="+result.image2.url+" class='listimage'></div>";
            if(result.image3 !=null) html += "<div class='imagesize'><img src="+result.image3.url+" class='listimage'></div>";
            if(result.image4 !=null) html += "<div class='imagesize'><img src="+result.image4.url+" class='listimage'></div>";
            if(result.image5 !=null) html += "<div class='imagesize'><img src="+result.image5.url+" class='listimage'></div>";
            if(result.image6 !=null) html += "<div class='imagesize'><img src="+result.image6.url+" class='listimage'></div>";
            $("#images").append(html);

            $("#images").find(".listimage").bind("click",function(){
                $(".mask").css("display","block");
                var url = $(this).attr("src");
                console.log(url);
                $("#bigimage").attr("src",url);
            });

            $(".mask").click(function(){
                $("#bigimage").attr("src",null);
                $(".mask").css("display","none");
            });

            $("#comment").click(function(){
                var comment = $(".inputstyle").val().trim();
                console.log(comment);
                var id = "<?php echo $info->objectId;  ?>";
                var objectid = "<?php echo $_GET["id"]; ?>";
                if(comment == null || comment =="")
                {}else {
                    $.ajax({
                        type: "POST",
                        url: "../../action/appconsole/comment.php",
                        data: {id:id,objectid:objectid,comment:comment},
                        success: function(data){
                             if(data)
                             {
                                 window.location.reload();
                             }
                        },
                        error : function(data) {
                            console.log((data));
                        },
                    });
                }
            });

        </script>
	</body>
</html>