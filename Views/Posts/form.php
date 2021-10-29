<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
session_start();
$error = 0;
$errormsg = [];

if($_POST['created'] == '') {
  $error += 1;
  $errormsg[] = '更新日は必須項目です。';
}

if(preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $_POST['created']) == 0) {
  $error += 1;
  $errormsg[] = '更新日は正しい形式でお願いいたします。';
}

if ($_POST['body'] == '') {
  $error += 1;
  $errormsg[] = '投稿内容は必須項目です。';
}
$post = new PostController();

if ($error > 0) {
  $_SESSION['created'] = $_POST['created'];
  $_SESSION['body'] = $_POST['body'];
  $_SESSION['error'] = $errormsg;
  header("Location:" . $_SERVER['HTTP_REFERER']);
  exit();
} elseif($_SESSION['role'] == 1) {
  $create = $post->created();
  header("Location: ./index.php");
  exit();
} else {
  $m_create = $post->m_created();
  header("Location: ./index.php");
  exit();
}
