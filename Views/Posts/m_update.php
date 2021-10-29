<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
session_start();
$error = 0;
$errormsg = [];

if($_POST['updated'] == '') {
  $error += 1;
  $errormsg[] = '更新日は必須項目です。';
}

if(preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $_POST['updated']) == 0) {
  $error += 1;
  $errormsg[] = '更新日は正しい形式でお願いいたします。';
}

if ($_POST['body'] == '') {
  $error += 1;
  $errormsg[] = '投稿内容は必須項目です。';
}
$post = new PostController();
  // $_SESSION['id'] = $_POST['id'];
if ($error > 0) {
  $_SESSION['updated'] = $_POST['updated'];
  $_SESSION['body'] = $_POST['body'];
  $_SESSION['error'] = $errormsg;
  header("Location:" . $_SERVER['HTTP_REFERER']);
  exit();
} else {
  $update = $post->m_update();
  header("Location: ./index.php");
  exit();
}
?>
