<?php
  include_once '../../lib/Bmob/BmobObject.class.php';

  $object = new BmobObject("order");
  $res=$object->get($_GET["id"],array('include=student,user,teacher'));

  if($res->student->objectId ==null)
  {
    $teacher = new BmobObject("teacher");
    $get=$teacher->get($res->teacher->objectId);
    $userid = $get->parent->objectId;
}else {
    $student = new BmobObject("student");
    $get=$student->get($res->student->objectId);
    $userid = $get->parent->objectId;
}

  $user = new BmobObject("_User");
  $userget=$user->get($userid);
?>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>详情</title>
        <link rel="stylesheet"  href="../../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../../css/iconfont1.css">
        <link rel="stylesheet"  href="../../css/consoleweb/ordercheck_detail.css">
		<script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script src="../../js/iconfont.js"></script>
	</head>
	<body>
        <div class="MobContain" id ="MobCcontent">

            <div style="text-align:left">
                <div style="color:#e61111;font-size:16px;font-weight:bold;" class="sheniqngren">申请人</div>
                <div class="item">
                    <div>
                        <img src="<?php echo $res->user->avatar; ?>" class="avatar" />
                    </div>
                    <div style="width:100%;margin-left:10px;line-height:40px">
                        <div>
                            <span><?php echo $res->user->username; ?></span>
                            <span style="color:#e61111;margin-left:10%"><?php echo $res->user->identity; ?></span>
                        </div>
                        <div>
                            联系电话：<?php echo $res->user->mobilePhoneNumber; ?>
                        </div>
                    </div>
                </div>

                <div style="color:#e61111;font-size:16px;font-weight:bold;margin-top:10%" class="sheniqngren">被申请人</div>
                <div class="item">
                    <div>
                        <img src="<?php echo $userget->avatar; ?>" class="avatar" />
                    </div>
                    <div style="width:100%;margin-left:10px;line-height:40px">
                        <div>
                            <span><?php echo$userget->username; ?></span>
                            <span style="color:#e61111;margin-left:10%"><?php echo $userget->identity; ?></span>
                        </div>
                        <div>
                            联系电话：<?php echo $userget->mobilePhoneNumber; ?>
                        </div>
                    </div>
                </div>
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
                      url: "../../action/appconsole/order_check.php",
                      data: {id:id,type:1},
                      success: function(data){
                           window.location.href= "ordercheck.php";
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
                      url: "../../action/appconsole/order_check.php",
                      data: {id:id,type:0},
                      success: function(data){
                          window.location.href= "ordercheck.php";
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
