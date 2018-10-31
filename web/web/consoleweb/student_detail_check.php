<?php
  include_once '../../lib/Bmob/BmobObject.class.php';

  $object = new BmobObject("jubao");
  $res=$object->get()->results;
  if(count($res) == 0) header('location:../../web/depweb/error/nocontent.php');
  $res = json_encode($res);
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>意见查看</title>
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
			 html +="<div style='margin-bottom: 20px;background: #fff;width: 100%;border-radius: 4px;padding: 10px;'>";
			 html +="<div style='border-bottom:1px solid#999;text-align:left;padding:0 0 5px'>"+item.text+'  '+item.anotnertext+"</div>";
             html +="<div style='display:flex;justify-content: space-between;font-size: 12px;margin-top:5px'><div id='delete' style='color:#f30' data-id="+item.objectId+
             ">删除</div><div id='getdetail' style='color:#2ca879' data-id="+item.parent.objectId+
             ">查看学生详情</div><div>"+item.createdAt+"</div></div>";
			 html +="</div>";
			 $("#MobCcontent").append(html);
		  }

          $("#MobCcontent").on("click", "#delete", function () {
              var id = $(this).attr("data-id");
              $.ajax({
                  type: "POST",
                  url: "../../action/base_bmob.php",
                  data: {id:id,type:"delete",object:"jubao"},
                  success: function(data){
                      console.log(data);
                      window.location.reload();
                  },
                  error : function(data) {
                      console.log((data));
                  },
              });
           });

           $("#MobCcontent").on("click", "#getdetail", function () {
               var id = $(this).attr("data-id");
               window.location.href= "student_detail.php?id="+id;
            });

		</script>
	</body>
</html>
