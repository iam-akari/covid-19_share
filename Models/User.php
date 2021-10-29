<?php
session_start();
require_once(ROOT_PATH .'/Models/Db.php');

class User extends Db {
  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }

  public function userRegister() {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($_POST['email']) || empty($_POST['password'])) {
      header("Location: ./register_fail.php");
      exit();
    }

    $sql = 'INSERT INTO users SET pref_id="'.$_POST['pref_name'].'",nick_name="'.$_POST['nick_name'].'",age="'.$_POST['age'].'",gender="'.$_POST['gender'].'",email="'.$_POST['email'].'",password="'.$password.'",role="'.$_POST['role'].'"';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $_SESSION['nick_name'] = $_POST['nick_name'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['role'] = $_POST['role'];
    $_SESSION['pref_name'] = $_POST['pref_name'];
  }

  public function log_in() {
    $sql = 'SELECT * FROM users WHERE email = "'.$_POST['email'].'"';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if(isset($row['email']) && password_verify($_POST['password'], $row['password'])) {
      session_regenerate_id(true);
      $_SESSION['email'] = $row['email'];
    } else {
      header("Location: ./login_fail.php");
      exit();
    }
    $_SESSION['id'] = $row['id'];
    $_SESSION['nick_name'] = $row['nick_name'];
    $_SESSION['age'] = $row['age'];
    $_SESSION['gender'] = $row['gender'];
    $_SESSION['role'] = $row['role'];
  }

  public function new_password() {
    $sql = 'SELECT * FROM users WHERE email = "'.$_POST['email'].'" AND nick_name = "'.$_POST['nick_name'].'"';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if($row['email'] && $row['nick_name']) {
      session_regenerate_id(true);
      $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    } else {
      header("Location: ./reset_fail.php");
      exit();
    }
    $sql_up = 'UPDATE users SET users.password = "'.$new_password.'"';
    $sql_up .= ' WHERE email = "'.$_POST['email'].'" AND nick_name = "'.$_POST['nick_name'].'"';
    $sth = $this->dbh->prepare($sql_up);
    $sth->execute();
    $_SESSION['new_password'] = $_POST['new_password'];
  }

}
?>
