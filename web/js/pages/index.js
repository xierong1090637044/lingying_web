$(document).ready(function()
{
    //var getphone = $.cookie('phonenumber');
    //if(getphone != null ) window.location.href = "appconsole.php?id="+getphone;
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
                            window.location.href = "personcenter.php?id="+phonenumber;
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
