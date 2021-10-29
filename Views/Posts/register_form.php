<?php
require_once(ROOT_PATH .'Controllers/PostController.php');
// $countries = new PlayerController();
// $params_c = $countries->edit_country();
$prefectures = new PostController();
$params_p = $prefectures->edit_pref();
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
  <h2>新規登録</h2>
  <div class="register_box">
  <form action="register.php" method="post">
    <ul>
      <!-- <li>
        <input type="hidden" name="id" value="<?php if (!empty($params_e['edit']['id'])) echo ($params_e['edit']['id']); ?>">
      </li> -->
      <li>
        <label for="nick_name">ニックネーム：</label>
        <input type="nick_name" name="nick_name" required>
      </li>
      <li>
        <label for="age">年齢：</label>
        <select name="age">
          <?php for ($i=12; $i<=100; $i++) : ?>
          <option value="<?= $i ?>"><?= $i.'歳' ?></option>
          <?php endfor; ?>
        </select>
      </li>
      <li>
        <label for="pref_name">都道府県：</label>
        <select name="pref_name">
        <?php foreach($params_p['prefectures'] as $prefecture): ?>
          <option value=<?= $prefecture['id']?> ><?=$prefecture['name'] ?></option>
        <?php endforeach; ?>
        </select>
      </li>
      <!-- <li>
        <label for="role">権限：</label>
        <select name="role">
          <option value="1">一般</option>
          <option value="0">管理者</option>
        </select>
      </li> -->
      <input type="hidden" name="role" value="1">

      <li>
        <label for="gender">性別：</label>
        <select name="gender">
          <option value="0">男性</option>
          <option value="1">女性</option>
        </select>
      </li>
      <li>
        <label for="email">メールアドレス：</label>
        <input type="email" name="email" required>
      </li>
      <li>
        <label for="password">パスワード：</label>
        <input type="password" name="password" required>
      </li>
      <li>
        <button class="button" type="submit">新規登録</button>
      </li>
    </ul>
  </form>
  <a href="login_form.php">ログインはこちら</a>
</div>
</body>
