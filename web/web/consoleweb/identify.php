<?php
  include_once '../../lib/Bmob/BmobObject.class.php';

  $object = new BmobObject("identify");
  $res=$object->get("",array('include=parent','where={"isactive":"true"}'))->results;
  if(count($res) == 0) header('location:../../web/depweb/error/nocontent.php');
  $res = json_encode($res);
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>身份审核</title>
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
			 html +="<div class='list' id='list' data-id="+item.objectId+">";
			 html +="<div class='avatardiv'><img class='avatar' src="+item.parent.avatar+"></img></div>";
			 html +="<div class='username'><div>"+item.parent.username+"</div><div><span class='time'>"+item.createdAt+"</span><span class='state'>未审核</span></div></div>";
			 html +="</div>";
			 $("#MobCcontent").append(html);
		  }

		  $("#MobCcontent").on("click", "#list", function () {
		 	 var id = $(this).attr("data-id");
             window.location.href = "identify_detail.php?id="+id;
		  });

		</script>
	</body>
</html>
