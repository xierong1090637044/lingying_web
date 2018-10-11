<?php
  include_once '../../lib/Bmob/BmobObject.class.php';

  $object = new BmobObject("order");
  $res=$object->get("",array('include=user','where={"ischeck":"false"}'))->results;
  //var_dump($res);
  if(count($res) == 0) header('location:../../web/depweb/error/nocontent.php');
  $res = json_encode($res);
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>申请审核</title>
        <link rel="stylesheet"  href="../../css/consoleweb/identify.css">
        <link rel="stylesheet"  href="../../css/bootstrap1.min.css">
        <link rel="stylesheet"  href="../../css/common.css">
		<script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/spin.min.js"></script>
        <script type="text/javascript" src="../../js/comp/loading.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script src="../../js/iconfont.js"></script>
	</head>
	<body>
        <div id="loading" class="loading"></div>
        <div class="MobContain" id ="MobCcontent"></div>


		<script type="text/javascript">
		  var list = <?php echo $res; ?>;
		  for (var i = 0; i < list.length; i++)
		  {
		  	 var item = list[i];
			 console.log(item);
			 var html = "";
             html +="<div style='text-align:left;background:#fff' data-id="+item.objectId+" id='list'>"
             html +="<div class='state' style='padding-top:10px'>申请人</div> ";
             html +="<div class='list'>";
			 html +="<div class='avatardiv'><img class='avatar' src="+item.user.avatar+"></img></div>";
			 html +="<div class='username'><div>"+item.user.username+"</div><div><span class='time'>"+item.createdAt+"</span><span class='state'>未审核</span></div></div>";
			 html +="</div></div>";
			 $("#MobCcontent").append(html);
		  }

          $("#MobCcontent").on("click", "#list", function () {
		 	 var id = $(this).attr("data-id");
             window.location.href = "ordercheck_detail.php?id="+id;
		  });

		</script>
	</body>
</html>
