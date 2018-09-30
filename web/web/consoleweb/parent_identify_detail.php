<?php
  include_once '../../lib/BmobObject.class.php';

  $object = new BmobObject("parent_identify");
  $res=$object->get($_GET["id"],array('include=parent'));
?>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>详情</title>
        <link rel="stylesheet"  href="../../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../../css/iconfont1.css">
        <link rel="stylesheet"  href="../../css/consoleweb/identify.css">
		<script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script src="../../js/iconfont.js"></script>
	</head>
	<body>
        <div class="MobContain" id ="MobCcontent">
            <div class="titletext">
                <div>姓名：</div>
                <div><?php echo $res->name ?></div>
            </div>
            <div class="titletext">
                <div>联系方式：</div>
                <div><?php echo $res->mobile ?></div>
            </div>
            <div class="titletext">
                <div>求教科目：</div>
                <div><?php echo $res->class ?>、<?php echo $res->subject ?></div>
            </div>
            <div style="margin:10% 0 5%">
               <button type="button" class="btn btn-danger button" id="refuse" data-toggle="modal" data-target="#exampleModal">拒绝</button>
               <button type="button" class="btn btn-dark button" id="agree" data-toggle="modal" data-target="#agreeModal">通过</button>
           </div>

           <!-- Modal -->
           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">提示</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </div>
                           <div class="modal-body">
                               是否拒绝
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                               <button type="button" class="btn btn-primary" id ="refuse_confrim" data-id="<?php echo $res->objectId ?>">确认</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AgreeModal -->
            <div class="modal fade" id="agreeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">提示</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>
                            <div class="modal-body">
                                是否通过审核
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                <button type="button" class="btn btn-primary" id ="agree_confrim" data-id="<?php echo $res->objectId ?>">确认</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>


        <script type="text/javascript">

	      $(document).ready(function()
	      {
	          var height = $(window).height();
	          $(document.body).css('height',height);

              $("#refuse").click(function(){
                  $('#exampleModal').modal('toggle')
              });

              $("#agree").click(function(){
                  $('#agreeModal').modal('toggle')
              });

              $("#refuse_confrim").click(function(){
                  var id = $(this).attr("data-id");
                  console.log(id);
                  $.ajax({
                      type: "POST",
                      url: "../../action/appconsole/identify.php",
                      data: {id:id,type:3},
                      success: function(data){
                          window.location.href= "parent_identify.php";
                      },
                      error : function(data) {
                          console.log((data));
                      },
                  });
              });

              $("#agree_confrim").click(function(){
                  var id = $(this).attr("data-id");
                  console.log(id);
                  $.ajax({
                      type: "POST",
                      url: "../../action/appconsole/identify.php",
                      data: {id:id,type:4},
                      success: function(data){
                          window.location.href= "parent_identify.php";
                      },
                      error : function(data) {
                          console.log((data));
                      },
                  });
              });

          })

	    </script>
	</body>
</html>
