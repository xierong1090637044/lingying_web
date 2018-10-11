<?php
    require_once '../res/class/GetUser.php';
    require_once '../res/action/require_mobile.php';

    $id = $_GET["id"];
    $user = new GetUser($id);
    $nickname = $user->nickname();
    $avatar = $user->avatar();
    if(!$user->appconsole()) header('location:../web/depweb/error/404.php');

    $ismoile = new ISMOBILE();
    $ismoile->do_iswechat();
?>

<html lang="zh-cn">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>后台</title>
        <link rel="stylesheet"  href="../css/bootstrap1.min.css">
		<link rel="stylesheet"  href="../css/iconfont1.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
        <script src="../js/iconfont.js"></script>
	</head>
    <style>
      .Mobcontent
      {
          padding: 15px;
      }
      .avatar
      {
          width: 4rem;
          height: 4rem;
          border-radius: 50%;
      }
      .avatarandname
      {
          display: flex;
          margin: 0px 0px 10px;
          line-height: 4rem;
          align-items: center;
      }
      .nickname
      {
          margin: 0 0 0 10px;
      }
      .lineheight
      {
          line-height: 2rem;
      }
      .lineheight1
      {
          line-height: 2rem;
          color:#fff;
          padding: 0px 20px;
          background:#202a36;
          border-radius: 20px;
          text-align: center;
      }

      .liststyle
      {
          width: 100%;
          padding: 10px 0;
          float: left;
      }
      .iconfont
      {
         font-size: 35px;
         color: #fff;
     }
     .iconfont1
     {
        font-size: 35px !important;
    }
     .listitem
     {
         width: calc(25% - 10px);
         padding: 5px;
         border-radius: 4px;
         text-align: center;
         display: inline-block;
         float: left;
         margin: 5px;
         color: #000;
     }
     .iconstyle
     {
         background: #6ecad5;
         border-radius: 50%;
         height: 60px;
         width: 60px;
         text-align: center;
         line-height: 60px;
         margin: 0 auto;
     }
     .listtext
     {
         width: 100%;
         font-size: 13px;
         margin: 2px 0 0 0;
     }

    </style>
	<body ontouchstart="">
     <div class="Mobcontent" id="Mobcontent">
        <div class="avatarandname">
           <div>
               <img src="<?php echo $avatar;?>" class="avatar">
           </div>
           <div style="margin-left:5%">
               <div class="lineheight"><?php  echo $nickname;?></div>
               <div class="lineheight1">管理员</div>
           </div>
        </div>

        <div class="liststyle">
            <a class="listitem" href="../web/consoleweb/identify.php">
                <div class="iconstyle"><i class="iconfont icon-shenhe"></i> </div>
                <div class="listtext">教员审核</div>
            </a>
            <a class="listitem" href="../web/consoleweb/parent_identify.php">
                <div class="iconstyle"><i class="iconfont icon-personal-center"></i> </div>
                <div class="listtext">家长审核</div>
            </a>
            <a class="listitem" href="../web/consoleweb/ordercheck.php">
                <div class="iconstyle"><i class="iconfont icon-personal-center"></i> </div>
                <div class="listtext">申请审核</div>
            </a>
        </div>
     </div>
	</body>
</html>
