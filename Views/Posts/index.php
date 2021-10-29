<?php
  require_once(ROOT_PATH.'Controllers/PostController.php');
  $post = new PostController();
  $params = $post->index();
  $m_params = $post->mgmt();
  // print_r($post['id']);
  // session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>PHP応用</title>
  <link rel="stylesheet" type="text/css" href="/css/post.css">
</head>
<body>
  <div class="logout">
  <a href='login_form.php'>ログアウト</a>
  </div>
  <h1>新型コロナウイルスワクチン副反応投稿サイト</h1>
  <section>
  <?php if ($_SESSION['role'] == 0): ?>
  <h2>投稿一覧</h2>
  <table class="table1">
  <tr>
    <!-- <th>No</th> -->
    <th class="f">管理者</th>
    <th class="d">投稿日</th>
    <th class="e">更新日</th>
    <th class="g">投稿内容</th>
  </tr>
  <?php foreach($m_params['m_posts'] as $m_post): ?>
  <tr>
    <!-- <td><?=$m_post['id'] ?></td> -->
    <td class="cc"><?=$m_post['nick_name'] ?></td>
    <td class="cc"><?=$m_post['created'] ?></td>
    <td class="cc"><?=$m_post['updated'] ?></td>
    <td><?=$m_post['body'] ?></td>
    <td><a href='/Posts/m_edit.php?id=<?= $m_post['id'] ?>'>編集</a></td>
    <td><a href='/Posts/delete.php?id=<?= $m_post['id'] ?>' onclick="return confirm('削除してもよろしいですか。')">削除</a></td>
  </tr>
  <?php endforeach; ?>
  </table>

    <table class="table2">
    <tr>
      <!-- <th>No</th> -->
      <th class="a">ニックネーム</th>
      <th class="b">性別</th>
      <th class="c">年齢</th>
      <th class="f">都道府県</th>
      <th class="d">投稿日</th>
      <th class="e">更新日</th>
      <th class="g">投稿内容</th>
    </tr>
    <?php foreach($params['posts'] as $post): ?>
    <tr>
      <!-- <td><?=$post['id'] ?></td> -->
      <td class="cc"><?=$post['nick_name'] ?></td>
      <td class="cc"><?php if ($post['gender'] == 0) {
        echo "男性";
      }else {
        echo "女性";
      } ?>
      </td>
      <td class="cc"><?=$post['age'] ?></td>
      <td class="cc"><?=$post['pref_name'] ?></td>
      <td class="cc"><?=$post['created'] ?></td>
      <td class="cc"><?=$post['updated'] ?></td>
      <td><?=$post['body'] ?></td>
      <td><a href='/Posts/edit.php?id=<?= $post['id'] ?>'>編集</a></td>
      <td><a href='/Posts/delete.php?id=<?= $post['id'] ?>' onclick="return confirm('削除してもよろしいですか。')">削除</a></td>

    </tr>
    <?php
      // $_SESSION['id'] = $post['id'];
      $_SESSION['nick_name'] = $post['nick_name'];
      $_SESSION['gender'] = $post['gender'];
      $_SESSION['age'] = $post['age'];
      $_SESSION['created'] = $post['created'];

     ?>
    <?php endforeach; ?>
    </table>

    <div class="paging">
      <?php
      for ($i = 0;$i <= $params['pages']; $i++) {
        if(isset($_GET['page']) && $_GET['page'] == $i) {
          echo $i + 1;
        } else {
          echo "<a href='?page=".$i."'>".($i + 1)."</a>";
        }
      }
      ?>
    </div>

  <?php elseif($_SESSION['role'] == 1): ?>
    <h2>投稿一覧</h2>
    <table class="table1">
    <tr>
      <!-- <th>No</th> -->
      <th class="f">管理者</th>
      <th class="d">投稿日</th>
      <th class="e">更新日</th>
      <th class="g">投稿内容</th>
    </tr>
    <?php foreach($m_params['m_posts'] as $m_post): ?>
    <tr>
      <!-- <td><?=$m_post['id'] ?></td> -->
      <td class="cc"><?=$m_post['nick_name'] ?></td>
      <td class="cc"><?=$m_post['created'] ?></td>
      <td class="cc"><?=$m_post['updated'] ?></td>
      <td><?=$m_post['body'] ?></td>
    <?php endforeach; ?>
    </table>

      <table class="table2">
      <tr>
        <!-- <th>No</th> -->
        <th>ニックネーム</th>
        <th>性別</th>
        <th>年齢</th>
        <th>投稿日</th>
        <th>更新日</th>
        <th>都道府県</th>
        <th>投稿内容</th>
      </tr>
      <?php foreach($params['posts'] as $post): ?>
      <tr>
        <!-- <td><?=$post['id'] ?></td> -->
        <td class="cc"><?=$post['nick_name'] ?></td>
        <td class="cc"><?php if ($post['gender'] == 0) {
          echo "男性";
        }else {
          echo "女性";
        } ?>
        </td>
        <td class="cc"><?=$post['age'] ?></td>
        <td class="cc"><?=$post['created'] ?></td>
        <td class="cc"><?=$post['updated'] ?></td>
        <td class="cc"><?=$post['pref_name'] ?></td>
        <td><?=$post['body'] ?></td>
      </tr>
      <?php
        // $_SESSION['id'] = $post['id'];
        $_SESSION['nick_name'] = $post['nick_name'];
        $_SESSION['gender'] = $post['gender'];
        $_SESSION['age'] = $post['age'];
        $_SESSION['created'] = $post['created'];
        $_SESSION['body'] = $post['body'];

       ?>
      <?php endforeach; ?>
      </table>

      <div class="paging">
        <?php
        for ($i = 0;$i <= $params['pages']; $i++) {
          if(isset($_GET['page']) && $_GET['page'] == $i) {
            echo $i + 1;
          } else {
            echo "<a href='?page=".$i."'>".($i + 1)."</a>";
          }
        }
        ?>
      </div>

  <?php endif; ?>

  <h2>投稿する</h2>
  <div class="contact_box">
  <form action="form.php" method="post">
      <h3>投稿内容をご記入の上投稿ボタンを押してください</h3>

  <div class="errormsg">
    <?php
    if(!empty($_SESSION['error'])) {
      foreach($_SESSION['error'] as $error) {
        echo $error;
        echo "<br>";
      }
    }
    ?>
  </div>
      <ul>
        <!-- 投稿日 -->
        <li><input type="hidden" name="created" id="created" value="<?= date('Y-m-d');?>"></li>
      </ul>

      <ul>
        <li class="toukou">投稿内容</li>
        <li><textarea name="body" id="body" ></textarea></li>
      </ul>
      <ul>
        <li>
          <button class="submit" type="submit" onclick="return confirm('投稿しますか?')">投稿</button>
        </li>
      </ul>

      </div>

    </form>
  </div>


  </section>
  </body>
</html>
<?php
  // $_SESSION['id'] = array();
  // session_destroy();
?>
