<?php
    require_once '../../res/action/require_mobile.php';
    require_once '../../lib/Bmob/BmobObject.class.php';

    $bmobObj = new BmobObject("student");
    $result = json_encode($bmobObj->get());

    $ismoile = new ISMOBILE(2);
    $ismoile->do_iswechat();
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>找学生</title>
        <link rel="stylesheet"  href="../../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../../css/iconfont1.css">
		<script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script src="../../js/iconfont.js"></script>
	</head>
    <style>
    </style>
	<body ontouchstart="">
        <div>
        </div>
	</body>
    <script>
    $.ajax({
        type: "POST",
        url: "../../action/student/do_student.php",
        dataType:'json',
        data: {number:1},
        success: function(data){
            console.log(data);
          },
        error : function(data) {

        },
    });
    </script>
</html>
