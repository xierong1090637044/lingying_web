<?php
include_once '../lib/BmobUser.class.php';
include_once '../lib/BmobObject.class.php';
include_once 'login.php';

class GetUser {

  public function __construct()
  {
      $this->objectId = $_COOKIE["objectId"];

      $bmobObj = new BmobObject("_User");
      $this->res=$bmobObj->get($this->objectId);
  }

  public function nickname() {
      return $this->res->username;
  }

  public function avatar() {
      return $this->res->avatar;
  }

  public function appconsole() {
      return $this->res->appconsole;
  }

}
?>
