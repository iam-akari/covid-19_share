<?php
require_once(ROOT_PATH.'Controllers/PostController.php');
$post = new PostController();
$e_params = $post->mEdit();
// session_start();

if(!empty($_SESSION['error'])) {
  foreach($_SESSION['error'] as $error) {
    echo $error;
    echo "<br>";
  }
}

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
  <h1>投稿編集</h1>
    <div class="register_box">
    <form class="edit-form" method="post" action="m_update.php?id=<?= $e_params['m_edit']['id'] ?>">
      <ul>
        <div class="flex">
        <li>ニックネーム：</li>
        <li>
          <?php if(!empty($e_params['m_edit']['nick_name'])) echo ($e_params['m_edit']['nick_name']); ?>
        </li>
        </div>
        <div class="flex">
        <li>投稿日：</li>
        <li>
          <?php if(!empty($e_params['m_edit']['created'])) echo ($e_params['m_edit']['created']); ?>
        </li>
        </div>
        <!-- <li>
          <input type="hidden" name="id" value="<?php if (!empty($params_e['edit']['id'])) echo ($params_e['edit']['id']); ?>">
        </li> -->
        <!-- 更新日 -->
        <input type="hidden" name="updated" value="<?= date('Y-m-d'); ?>">

        <ul>
          <li class="toukou">投稿内容</li>
          <li><textarea name="body"><?php if(!empty($e_params['m_edit']['body'])) echo ($e_params['m_edit']['body']); ?></textarea></li>
        </ul>
        <li>
          <button class="submit" type="submit" onclick="return confirm('変更を完了してもよろしいですか')">送信</button>
        </li>
      </ul>
    </form>
    <a href="index.php">投稿一覧に戻る </a>
  </div>
</body>

  <?php
  unset($_SESSION['error']);
  ?>
