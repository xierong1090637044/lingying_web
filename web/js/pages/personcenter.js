$(document).ready(function()
{
    $("#mycode").click(function(){
        $("#dialog").toggle();
    });

    $(".weui_mask").click(function(){
        $("#dialog").toggle();
    });

    $("#callce").click(function(){
        $("#dialog").toggle();
    });

    $("#confrim").click(function(){
        $("#dialog").toggle();
    });

    $(function() {
      FastClick.attach(document.body);
    });

    $(document).on("click", "#show-actions", function() {
       $.actions({
         onClose: function() {
           console.log("close");
         },
         actions: [
           {
             text: "求职招聘",
             className: "color-primary",
             onClick: function() {
               window.location.href = "index.php?page=1";
             }
           },
           {
             text: "谈婚论嫁",
             className: "color-primary",
             onClick: function() {
               window.location.href = "love_marry.php?page=1";
             }
           },
           {
             text: "老乡邦",
             className: 'color-primary',
             onClick: function() {
               window.location.href = "make_friend.php?page=1";
             }
           }
         ]
       });
     });
})
