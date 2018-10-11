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

    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: '<?php echo $signPackage["timestamp"];?>',
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            'openLocation',
            'getLocation',
            'onMenuShareTimeline',
            'onMenuShareAppMessage']
        });
        wx.ready(function () {
            wx.getLocation({
                type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    var speed = res.speed; // 速度，以米/每秒计
                    var accuracy = res.accuracy; // 位置精度
                }
            });
        });
})
