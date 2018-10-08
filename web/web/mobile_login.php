<?php
     require_once '../res/action/require_mobile.php';

	 $ismoile = new ISMOBILE();
	 $ismoile->do_iswechat();
?>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>手机登录</title>
        <link rel="stylesheet"  href="../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../css/iconfont1.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery.cookie.js"></script>
        <script src="../js/iconfont.js"></script>
	</head>
    <style>
       input:focus
      {
            outline: none;
            border-color: #5d5d5d;
      }
      .input
      {
          border:1px solid#5d5d5d;
          height: 40px;
          line-height: 40px;
          padding-left: 5px;
          border-radius: 4px;
          width: 100%;
      }
      .Mobcontent
      {
          padding: 15px;
      }
      .input_mob
      {
          margin-bottom: 20px;
      }
      .input_code
      {
          display: flex;
          justify-content: space-between;
      }
      .getcode
      {
          width: 100%;
          height: 40px;
          background: #2ca879;
          color: #fff;
          text-align: center;
          border-radius: 4px;
      }
      .login
      {
          width: 60%;
          height: 40px;
          line-height: 40px;
          background: #2ca879;
          color: #fff;
          text-align: center;
          border-radius: 4px;
          margin:  0 auto;
          margin-top: 30px;
      }
      .toast
      {
          position: fixed;
          bottom: 10%;
          left: 0%;
          right: 0%;
          color: #000;
          height: 40px;
          line-height: 40px;
          margin: 0 auto;
          text-align: center;
      }

    </style>
	<body ontouchstart="">

     <div style="width:100%;margin-bottom:40px"><img src="../images/header.png" style="width:100%"/> </div>
	 <div class="Mobcontent" id="Mobcontent">
         <div class="input_mob">
             <input maxlength="11" placeholder="请输入手机号" class="input" id="mobilenumber"/>
         </div>
         <div class="input_code">
             <div>
                 <input class="input" maxlength="6" placeholder="验证码" id="code"/>
             </div>
             <div style="width:35%"><button class="getcode" id = "getcode">发送验证码</button></div>
         </div>
         <div class="login" id ="login">登录</div>

         <div id="toast" class="toast"></div>
     </div>

     <script type="text/javascript">
       $(document).ready(function()
       {
		   var getphone = $.cookie('phonenumber');
		   if(getphone != null ) window.location.href = "appconsole.php?id="+getphone;
           //验证码点击
           $("#getcode").click(function(){
              var phonenumber = $("#mobilenumber").val();
              if(phonenumber == null ||phonenumber.length <11)
              {
                  toast("请填写正确的手机号");
              }else {
                  $.ajax({
                      type: "POST",
                      url: "../action/do_mobile_login.php",
                      dataType:'json',
                      data: {phonenumber:phonenumber,type:0},
                      success: function(data){
						  if(data == "success")
						  {
							  $("#getcode").attr("disabled","true");
							  var code = 60;
	                          toast("发送成功");
	                          var interval = setInterval(function () {
	                              code = code - 1;
	                              $("#getcode").html(code +"秒");
	                              if(code == 1)
	                              {
	                                  $("#getcode").html("重发");
	                                  $("#getcode").removeAttr("disabled");
	                                  clearInterval(interval);
	                              }
	                          }, 1000);
						  }else {
						  	toast("发送失败");
						  }
                        },
                      error : function(data) {
						  console.log(data);
                          toast("发送失败");
                      },
                  });
              }
           });

           // 登录点击
           $("#login").click(function(){
               var phonenumber = $("#mobilenumber").val();
               var code = $("#code").val();
               if(phonenumber == null || phonenumber.length <11 || code == null)
               {
                   toast("请填写完整");
               }else {
                   $.ajax({
                       type: "POST",
                       url: "../action/do_mobile_login.php",
					   dataType:'json',
                       data: {phonenumber:phonenumber,code:code,type:1},
                       success: function(data){
                           console.log(data);
						   if(data == "success")
						   {
							   toast("登录成功");
							   $.cookie('phonenumber', phonenumber);
							   setTimeout(function(){
								   window.location.href = "appconsole.php?id="+phonenumber;
							   },1000);
						   }else {
						   	toast("验证码错误");
						   }
                       },
                       error : function(data) {
                          toast("登录失败");
                       },
                   });
               }
           });

           function toast(text)
           {
               $('#toast').html(text);
               setTimeout(function(){
                   $('#toast').html("");
               },1000)
           }
       })
     </script>
	</body>
</html>
