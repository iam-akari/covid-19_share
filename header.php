<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="modaal.min.css">
  <link rel="stylesheet" type="text/css" href="css/post.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
  <script src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src="modaal.min.js"></script>
  <script src="main.js"></script>
  <script src="modaal.js"></script>

</head>

<header id="header">
<nav>
  <ul class="nav wrapper">
    <div class="main-nav">
      <li><a href="login_form.php">ログイン</a></li>
      <li><a href="register_form.php">新規登録</a></li>
    </div>
    <div class="pass">
      <li><a href="reset_form.php">パスワード再設定</a></li>
    </div>
      <li><a href="">お問い合わせ</a></li>
    <div class="sain">
      <li><a href="login_form.php" class="modal">ログアウト</a></li>
    </div>
  </ul>
</nav>

</header>


<!-- <script>
  $('header a').click(function(){
    var id = $(this).attr('href');
    var position = $(id).offset().top;
    $('html,body').animate({
      'scrollTop':position
    },500);
  });
</script> -->
