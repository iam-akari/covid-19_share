<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHP自作</title>
  <link rel="stylesheet" type="text/css" href="/css/post.css">
</head>
<body>
  <h1>新型コロナウイルスワクチン副反応投稿サイト</h1>
    <h2>ログイン</h2>
    <div class="login_box">
    <form action="login.php" method="post">
      <ul>
        <li>
          <label for="email">メールアドレス：</label>
          <input type="email" name="email" required>
        </li>
        <li>
          <label for="password">パスワード：</label>
          <input type="password" name="password" required>
        </li>
        <li>
          <button class="button" type="submit">ログイン</button>
        </li>
      </ul>
    </form>
    <a href="register_form.php">新規登録はこちら</a>
    <a href="reset_form.php">パスワードを忘れた方はこちら</a>
  </div>
</body>
