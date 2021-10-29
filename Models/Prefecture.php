<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Pref extends Db {
  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }

  public function findPrefectures():Array {
    $sql = 'SELECT * FROM prefectures';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    $_SESSION['pref_id'] = $result['id'];
  }

}
?>
