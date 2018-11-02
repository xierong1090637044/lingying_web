<?php
error_reporting(E_ALL^E_NOTICE);
include_once '../../weixin.class.php';
include_once '../../lib/Bmob/BmobObject.class.php';
include_once '../../lib/Bmob/BmobFile.class.php';
include_once '../../lib/Bmob/BmobUser.class.php';
include_once '../../res/action/do_login.php';
require_once "../../jssdk.php";

$user = new Dologin();
$user = $user->getuser();

$jssdk = new JSSDK("wxcae7e19d9799a9d3", "8145813a77235c06fdd7b9e3110c064d");
$signPackage = $jssdk->GetSignPackage();

$type = $_GET["type"];
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<title>发布</title>
        <link rel="stylesheet"  href="../../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../../css/consoleweb/edit.css">
		<link rel="stylesheet"  href="../../css/iconfont1.css">
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/iconfont.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	</head>
	<body>
        <div class="main">
           <div class="notice">我要发布</div>

           <div>
               <input type="text" name="title" placeholder="请填写标题" maxlength="30" class="inputtitle"/>
           </div>
           <div style="margin:20px 0 0">
               <textarea type="text" name="content" placeholder="请填写内容" maxlength="200" class="textareastyle"></textarea>
           </div>
           <div style="width:100%;overflow: scroll;">
              <div id="listimgs" style="margin-top:20px;text-align:left;">
                 <div class="imgdiv">
                    <input type="file" style="display:none" id="uploadimg" onchange='changepic(this)'/>
                    <img src="../../images/addimg.png" class="listimgs" id="addimgs">
                 </div>
             </div>
           </div>

           <div style="width:100%;text-align:center;margin:50px 0 0">
                <button id="submit" class="submit"> 提交</button>
           </div>
		   <div id="toast" class="toast"></div>
      </div>

       <script>

         var images = [];
         var filename = [];
         var userid = "<?php echo $user->objectId; ?>";

         $(document).ready(function()
         {
             var height = $(window).height();
             $(document.body).css('height',height);

             $("#addimgs").click(function(){
                 $("#uploadimg").click();
             });

             $("#submit").click(function(){
                addcontent();
             });
         });

         function addcontent()
         {
             var title = $(".inputtitle").val();
             var content = $(".textareastyle").val();
             var type ="<?php echo $type; ?>";

             $("#listimgs").find(".imgdiv_add").each(function(){
                 var name = $(this).find(".listimgs").attr("data-name");
                 var src = $(this).find(".listimgs").attr("src");

                 images.push(src);
                 filename.push(name);
             });

             console.log(type,title,content);

             if(title == "" || content=="")
             {
				 $("#toast").html("请填写完整");
				 setTimeout(function(){
					 $("#toast").html();
				 },1000);
                 // FIXME:
             }else {
                 $.ajax({
                     type: "POST",
                     url: "../../action/appconsole/edit_submit.php",
                     data: {type:type,title:title,content:content,images:images,names:filename,userid:userid},
                     success: function(data){
						 $("#toast").html("提交成功");
					   setTimeout(function(){
						   $("#toast").html();
						   window.history.go(-1);
						   setTimeout(function(){
							   window.location.reload();
						   },500);
					   },1000);
                     },
                     error : function(data) {
                         console.log((data));
                     },
                 });
             }
         };

         function changepic()
         {
             var reads= new FileReader();
             f=document.getElementById('uploadimg').files[0];
             console.log(f);
             reads.readAsDataURL(f);
             reads.onload=function (e) {
                 $.ajax({
                     type: "POST",
                     url: "../../action/upload.php",
                     data: {image:e.currentTarget.result,name:f.name,type:"upload"},
                     success: function(data){
                          console.log(data);
                          if(data.state)
                          {
                              var number = $("#listimgs").children().length;
                              if(number == 6)
                              {
                                  $("#addimgs").parent().css("display","none");
                              }
                              $("#listimgs").css("width",90*(number+1)+10);
                              $("#listimgs").append('<div class="imgdiv_add"><img src='+ data.url +' class="listimgs" data-name='+data.filename+'><div id="delete" class="delete">x</div></div>');
							  $("#listimgs").find("#delete").bind("click",function(){
								  var number = $("#listimgs").children().length;
								  $("#listimgs").css("width",90*(number+1)+10);
								  if(number <= 6)
	                              {
	                                  $("#addimgs").parent().css("display","inline-block");
	                              }

								  var src = $(this).parent().find(".listimgs").attr("src");
								  $(this).parent().remove();
					 			  console.log(src);
								  $.ajax({
				                      type: "POST",
				                      url: "../../action/upload.php",
				                      data: {image:src,type:"delete"},
				                      success: function(data){

				                      },
				                      error : function(data) {
				                          console.log((data));
				                      },
				                  });
							  });
                          }
                     },
                     error : function(data) {
                         console.log((data));
                     },
                 });
             };

         };

       </script>

	</body>
</html>
