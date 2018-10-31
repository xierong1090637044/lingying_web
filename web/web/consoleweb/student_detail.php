<?php
  error_reporting(E_ALL^E_NOTICE);
  include_once '../../lib/Bmob/BmobObject.class.php';

  try {
      $bmobObj = new BmobObject("student");
      $res=$bmobObj->get($_GET["id"]);

      $studentdetail = new BmobObject("studentdetail");
      $detail=$studentdetail->get('',array('where={"student":'."\"".$_GET["id"]."\"".'}','include=author'));
  } catch (\Exception $e) {
      header('location:../../web/depweb/error/nocontent.php');
  }


?>
<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>学生详情</title>
        <link rel="stylesheet"  href="../../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../../css/iconfont1.css">
        <link rel="stylesheet"  href="../../css/consoleweb/student_detail.css">
		<script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap.js"></script>
        <script src="../../js/iconfont.js"></script>
	</head>
	<body>
        <div scroll-y="true" class='scrollview'>
        <div>
          <div class='list'>
           <div class='left'>求教科目</div>
           <div><?php echo $res->subject; ?></div>
          </div>

          <div class='list'>
           <div class='left'>家教费用</div>
           <div><?php echo $res->pay; ?></div>
          </div>

          <div class='list'>
           <div class='left'>学生年级</div>
           <div><?php echo $detail->results[0]->class; ?></div>
          </div>

          <div class='list'>
           <div class='left'>授课区域</div>
           <div><?php echo $res->city; ?></div>
          </div>

          <div class='list' bindtap='gotothis'>
           <div class='left'>详细地址</div>
           <div class='detailoverflow'><?php echo $res->localtion; ?></div>
          </div>

          <div class='list'>
           <div class='left'>授课时间</div>
           <div><?php echo $detail->results[0]->course_time; ?></div>
          </div>

          <div class='list'>
           <div class='left'>学员详情</div>
           <div class='detail'><?php echo $res->introduce; ?></div>
          </div>
        </div>

        <div class='title'>教员要求</div>

        <div>
          <div class='list'>
           <div class='left'>教员资质</div>
           <div><?php echo $detail->results[0]->aptitude; ?></div>
          </div>

          <div class='list'>
           <div class='left'>教员性别</div>
           <div><?php echo $detail->results[0]->t_sex; ?></div>
          </div>

          <div class='list'>
           <div class='left'>教员要求</div>
           <div class='detail'><?php echo $detail->results[0]->require; ?></div>
          </div>
        </div>
    </div>
</div>
<div style="text-align:center;margin-top: 20px;">
  <button class='bottom' id="delete"> 确认有问题？删除此条学生记录</button>
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
                    是否删除，删除后数据无法恢复？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id ="agree_confrim" data-id="<?php echo $res->objectId ?>" data-son="<?php echo $detail->results[0]->objectId; ?>">确认</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
    <script type="text/javascript">

      $('#delete').click(function(){
          $('#exampleModal').modal('toggle')
      });

      $("#agree_confrim").click(function(){
          var id = $(this).attr("data-id");
          var id1 = $(this).attr("data-son");
          $.ajax({
              type: "POST",
              url: "../../action/base_bmob.php",
              data: {id:id,type:"delete",object:"student"},
              success: function(data){
                  console.log(data);
                  console.log(id1);
                $.ajax({
                    type: "POST",
                    url: "../../action/base_bmob.php",
                    data: {id:id1,type:"delete",object:"studentdetail"},
                    success: function(data){
                        window.location.reload();
                    },
                });
              },
              error : function(data) {
                  console.log((data));
              },
          });
      });

    </script>

	</body>
</html>
