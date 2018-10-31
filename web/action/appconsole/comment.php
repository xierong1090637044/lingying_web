<?php
  include_once '../../lib/Bmob/BmobObject.class.php';

  $id = $_POST["id"];
  $objectid = $_POST["objectid"];

  $comment = new BmobObject("Comment");
  $res = $comment->addRelPointer(array(array("author","_User",$id),array("post","find_work",$objectid)));
  $result = $comment->update($res->objectId, array("comment"=>$_POST["comment"]));

  if($result->updatedAt != null)
  {
      echo true;
  }
?>
