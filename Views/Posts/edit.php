<?php
require_once(ROOT_PATH.'Controllers/PostController.php');
$post = new PostController();
$params_e = $post->edit();
// $create = new PostController();
// $params_c = $create->params_created();
// print_r($params_c);
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
  <h2>投稿編集</h2>
    <div class="register_box">
    <form class="edit-form" method="post" action="update.php?id=<?= $params_e['edit']['id'] ?>">
      <ul>
        <div class="flex">
        <li>ニックネーム：</li>
        <li>
          <?php if(!empty($params_e['edit']['nick_name'])) echo ($params_e['edit']['nick_name']); ?>
        </li>
        </div>
        <div class="flex">
        <li>性別：</li>
        <li>
          <?php if(!empty($params_e['edit']['gender'] == 0 )) echo "男性";
            else {
              echo "女性";
            }
          ?>
        </li>
        </div>
        <div class="flex">
        <li>年齢：</li>
        <li>
          <?php if(!empty($params_e['edit']['age'])) echo ($params_e['edit']['age']); ?>
        </li>
        </div>
        <div class="flex">
        <li>都道府県：</li>
        <li>
          <?php if(!empty($params_e['edit']['pref_name'])) echo ($params_e['edit']['pref_name']); ?>
        </li>
        </div>
        <div class="flex">
        <li>投稿日：</li>
        <li>
          <?php if(!empty($params_e['edit']['created'])) echo ($params_e['edit']['created']); ?>
        </li>
        </div>
        <!-- <li>
          <input type="hidden" name="id" value="<?php if (!empty($params_e['edit']['id'])) echo ($params_e['edit']['id']); ?>">
        </li> -->

          <!-- 更新日 -->
            <input type="hidden" name="updated" value="<?= date('Y-m-d'); ?>">

            <ul>
              <li class="toukou">投稿内容</li>
              <li><textarea name="body"><?php if(!empty($params_e['edit']['body'])) echo ($params_e['edit']['body']); ?></textarea></li>
            </ul>
        <!-- <li>
          <label for="body">投稿内容</label>
          <input type="text" name="body" value="<?php if(!empty($params_e['edit']['body'])) echo ($params_e['edit']['body']); ?>">
        </li> -->

        <li>
          <button class="submit" type="submit" onclick="return confirm('編集を完了してもよろしいですか')">送信</button>
        </li>
      </ul>
    </form>
    <a href="index.php">投稿一覧に戻る </a>
  </div>
</body>

  <?php
  unset($_SESSION['error']);
  ?>
