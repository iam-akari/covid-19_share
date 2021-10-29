<?php
  require_once(ROOT_PATH .'/Models/Db.php');

  class Post extends Db {
    public function __construct($dbh = null){
      //parent::メソッド名
      //→親クラスで定義したメソッドを呼び出したいときに使用（オーバーライド）
      parent::__construct($dbh);
    }

  public function findAll($page = 0):Array {
    $sql = 'SELECT u.id as id,u.nick_name as nick_name,u.gender as gender,u.age as age,u_posts.id as u_id,u_posts.created as created,u_posts.updated as updated,pref.name as pref_name,u_posts.body as body';
    $sql .= ' FROM ((users as u';
    $sql .= ' INNER JOIN user_posts as u_posts ON u.id = u_posts.users_id)';
    $sql .= ' LEFT JOIN prefectures as pref ON u.pref_id = pref.id)';
    $sql .= ' WHERE del_flg = 0';
    $sql .= ' ORDER BY u_posts.created DESC';
    $sql .= ' LIMIT 5 OFFSET '.(5 * $page);
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function m_findAll():Array {
    $sql = 'SELECT u.id as id,u.nick_name as nick_name,m_posts.created as created,m_posts.updated as updated,m_posts.body as body';
    $sql .= ' FROM users as u';
    $sql .= ' INNER JOIN mgmt_posts as m_posts ON u.id = m_posts.users_id';
    $sql .= ' WHERE del_flg = 0';
    $sql .= ' ORDER BY m_posts.created DESC';
    // $sql .= ' LIMIT 20 OFFSET '.(20 * $page);
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function u_edit($id=0) {
    $sql = 'SELECT u.id as id,u.nick_name as nick_name,u.gender as gender,u.age as age,u_posts.created as created,u_posts.created as created,u_posts.updated as updated,pref.name as pref_name,u_posts.body as body';
    $sql .= ' FROM ((users as u';
    $sql .= ' INNER JOIN user_posts as u_posts ON u.id = u_posts.users_id)';
    $sql .= ' LEFT JOIN prefectures as pref ON u.pref_id = pref.id)';
    $sql .= ' WHERE u.id = :id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function m_edit($id=0) {
    $sql = 'SELECT u.id as id,u.nick_name as nick_name,m_posts.created as created,m_posts.updated as updated,m_posts.body as body';
    $sql .= ' FROM (users as u';
    $sql .= ' INNER JOIN mgmt_posts as m_posts ON u.id = m_posts.users_id)';
    $sql .= ' WHERE u.id = :id';
    $sth = $this->dbh->prepare($sql);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function countAll():Int {
    $sql = 'SELECT count(*) AS count FROM user_posts';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $count = $sth->fetchColumn();
    return $count;
  }

  public function update($id = 0) {
     $sql = "UPDATE users u, user_posts u_posts SET u_posts.updated = '" . $_POST['updated'] . "', u_posts.body = '" . $_POST['body'] . "'";
     $sql .= ' WHERE u.id = :id AND u.id = u_posts.users_id' ;
     $sth = $this->dbh->prepare($sql);
     $sth->bindParam(':id', $id, PDO::PARAM_INT);
     $sth->execute();
   }

   public function m_update($id = 0) {
      $sql = "UPDATE users u, mgmt_posts m_posts SET m_posts.updated = '" . $_POST['updated'] . "', m_posts.body = '" . $_POST['body'] . "'";
      $sql .= ' WHERE u.id = :id AND u.id = m_posts.users_id' ;
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();
    }

   public function deleteById($id = 0){
       // UPDATE テーブル名 SET カラム名=値 WHERE (条件);
       $sql = 'UPDATE users SET del_flg = 1 WHERE id = :id';
       $sth = $this->dbh->prepare($sql);
       $sth->bindParam(':id',$id,PDO::PARAM_INT);
       $sth->execute();
   }

   public function usersUpdate() {
      $sql_up = 'UPDATE users SET users.updated =';
      $sql_up .= '(SELECT user_posts.updated FROM user_posts WHERE users.id = user_posts.users_id AND users.del_flg = 0)';
      $sth = $this->dbh->prepare($sql_up);
      $sth->execute();
    }

   public function create() {
     $created = $_POST['created'];
     $body = nl2br(htmlspecialchars($_POST['body']));
     $users_id = $_SESSION['id'];
     $sql = "INSERT INTO user_posts (created,body,users_id) VALUES (:created, :body, :users_id)";
     $sth = $this->dbh->prepare($sql);
     $params = array(':created' => $created, ':body' => $body, ':users_id' => $users_id);
     $sth->execute($params);
   }

   public function m_create() {
     $created = $_POST['created'];
     $body = nl2br(htmlspecialchars($_POST['body']));
     $users_id = $_SESSION['id'];
     $sql = "INSERT INTO mgmt_posts (created,body,users_id) VALUES (:created, :body, :users_id)";
     $sth = $this->dbh->prepare($sql);
     $m_params = array(':created' => $created, ':body' => $body, ':users_id' => $users_id);
     $sth->execute($m_params);
   }

  }
?>
